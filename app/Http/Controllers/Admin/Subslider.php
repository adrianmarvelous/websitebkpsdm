<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use App\Rules\SafeInput;

class Subslider extends Controller
{
    public function index()
    {
    	return view('admin.subslider.index', [
    		'judul' => 'Sub Slider'
    	]);
    }


    public function datatable()
    {
    	\DB::enablequerylog();
        $res = \App\Models\Subslider::orderByDesc('created_at')->get();
        return datatables()->of($res)
            ->addIndexColumn()
            ->addColumn('judul', function ($q) {
                return $q->judul;
            })
            ->addColumn('aktif', function ($q) {
                return ($q->aktif=='1') ? '<a href="#" class="text-success">Aktif</a>' : '<a href="#" class="text-danger">Tidak Aktif</a>';
            })
            ->addColumn('created_at', function ($q) {
                return date('d-m-Y H:i:s',strtotime($q->created_at));
            })
            ->addColumn('action', function ($q) {
            	$menu = [
            		[
            			'teks' => 'edit',
            			'color' => 'warning',
            			'onclick' => null,
            			'action' => route('dashboard.subslider.edit',['id' => $q->id]),
            		],
            		[
            			'teks' => 'hapus',
            			'color' => 'danger',
            			'onclick' => 'hapus_data('.$q->id.')',
            			'action' => 'javascript:void(0);',
            		],

            	];

                return  view('admin.tombol_action')
	                    ->with([
	                    	'id'  => $q->id,
	                    	'menu'  => $menu,
	                    ])
	                    ->render();
            })
            ->rawColumns(['aktif','action'])
            ->make(true);
    }

    public function add()
    {
    	return view('admin.subslider.add', [
    		'judul' => 'Sub Slider'
    	]);
    }


    public function save(Request $request)
    {
        $messages = [
            'judul.required' => 'harus diisi',
            'foto.required' => 'harus diisi',
            'aktif.required' => 'harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'judul' => ['required',new SafeInput],
            'foto' => ['required','mimes:jpg,jpeg,png',new SafeInput],
            'aktif' => ['required',new SafeInput],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'judul' => $errors->first('judul'),
                'foto' => $errors->first('foto'),
                'aktif' => $errors->first('aktif'),
            ]
            ]);
        }


        DB::beginTransaction();
        $id = \App\Models\Subslider::MaxId();
        $object = new \App\Models\Subslider;
        $object->id = $id;
        $object->judul = contul($request->judul);
        $object->aktif = contul($request->aktif);


        if($request->aktif == '1'){
            $setDisabled = \App\Models\Subslider::where('aktif','1')->first();
            if($setDisabled){
                $setDisabled->aktif = null;
                $setDisabled->save();
            }
        }

        try{

            $folder = 'subslider';
            $file = $request->file('foto');
            

            if ($request->has('foto')) {
                $allowedExtensions = ['jpg', 'jpeg','png'];

                if (in_array($request->file('file_lampiran')->getClientOriginalExtension(), $allowedExtensions))
                {
					// $filename = time() . '_' . $request->foto->getClientOriginalName();
					$filename = time() . '_sub_slider.' . $request->foto->getClientOriginalExtension();
					/*Pesan Error Validasi*/
					$messages = [
						"foto.required"  => "Silahkan memilih File / Dokumen terlebih dahulu !",
						"foto.image"     => "Ekstensi file harus berupa gambar !",
						"foto.size"     => "Ukuran gambar tidak boleh melebihi 1 MB !",
					];

					/*Proses Validasi Input*/
					$validator = Validator::make($request->all(), [
						'foto' => 'image|required',
					], $messages);

					/*Jika Validasi Gagal*/
					if ($validator->fails()) {
						$errors = $validator->errors();
						return \Response::json([
							"error" => [
								'foto'    => $errors->first('foto'),
							]
						]);
					}

					$path = Storage::disk('public')->putFileAs($folder, $file, $filename);
					$object->foto = $path;
                }else{
                    DB::rollback();
                    return response()->json([
                        'redirect' => null,
                        'message' => 'Format yang di upload salah',
                        'status'  => 'error_server',
                    ]);
                }
            }

            

            $object->save();
            DB::commit();
            return response()->json([
                'redirect' => route('dashboard.subslider'),
                'status'  => 'success',
            ]);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'redirect' => null,
                'message' => $e->getMessage(),
                'status'  => 'error_server',
            ]);
        }
    }

    public function edit($id)
    {
    	if($id !='' && is_numeric($id)){
    		$old_data = \App\Models\Subslider::findOrFail($id);

	    	return view('admin.subslider.edit', [
	    		'judul' => 'Sub Slider',
	    		'old_data' => $old_data,
	    	]);

    	}

    	abort(404);
    }


    public function update(Request $request)
    {
        $messages = [
            'judul.required' => 'harus diisi',
            'aktif.required' => 'harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'judul' => ['required',new SafeInput],
            'aktif' => ['required',new SafeInput],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'judul' => $errors->first('judul'),
                'aktif' => $errors->first('aktif'),
            ]
            ]);
        }


        DB::beginTransaction();
        $object = \App\Models\Subslider::find($request->id);
        if($object){

	        $object->judul = contul($request->judul);
	        $object->aktif = contul($request->aktif);
	        $object->updated_at = now();

            if($request->aktif == '1'){
                $setDisabled = \App\Models\Subslider::where('id', '<>', $request->id)->where('aktif','1')->first();
                if($setDisabled){
                    $setDisabled->aktif = null;
                    $setDisabled->save();
                }
            }

	        try{

	            $folder = 'subslider';
	            $file = $request->file('foto');
	            

	            if ($request->has('foto')) {
	            	// $filename = time() . '_' . $request->foto->getClientOriginalName();
	            	$filename = time() . '_sub_slider.' . $request->foto->getClientOriginalExtension();
	            	/*Pesan Error Validasi*/
		            $messages = [
		                "foto.required"  => "Silahkan memilih File / Dokumen terlebih dahulu !",
		                "foto.image"     => "Ekstensi file harus berupa gambar !",
		                "foto.size"     => "Ukuran gambar tidak boleh melebihi 1 MB !",
		            ];

		            /*Proses Validasi Input*/
		            $validator = Validator::make($request->all(), [
		                'foto' => 'image|required',
		            ], $messages);

		            /*Jika Validasi Gagal*/
		            if ($validator->fails()) {
		                $errors = $validator->errors();
		                return \Response::json([
		                    "error" => [
		                        'foto'    => $errors->first('foto'),
		                    ]
		                ]);
		            }
		            Storage::delete('public/'.$object->foto);
	                $path = Storage::disk('public')->putFileAs($folder, $file, $filename);
		            $object->foto = $path;
	            }

	            

	            $object->save();
	            DB::commit();
	            return response()->json([
	                'redirect' => route('dashboard.subslider'),
	                'status'  => 'success',
	                'message'  => 'Data berhasil di-update !',
	            ]);

	        }catch(\Exception $e){
	            DB::rollback();
	            return response()->json([
	                'redirect' => null,
	                'message' => $e->getMessage(),
	                'status'  => 'error_server',
	            ]);
	        }

        }
        
    }



    function hapus(Request $request)
    {
    	$find = \App\Models\Subslider::find($request->data_id);
    	DB::beginTransaction();
    	try{
    		if($find == null){
    			return response()->json([
	                'message' => 'Data tidak ditemukan !',
	                'status'  => 'error',
	            ]);
    		}
    		Storage::delete('public/'.$find->foto);
    		$find->delete();

    		DB::commit();
    		return response()->json([
	            'redirect' => route('dashboard.subslider'),
	            'message' => 'Berhasil menghapus Data !',
	            'status'  => 'success',
	        ]);

		}catch(\Exception $e){
			DB::rollback();
		    return response()->json([
		        'redirect' => null,
		        'message' => $e->getMessage(),
		        'status'  => 'error_server',
		    ]);
		}
    }
}
