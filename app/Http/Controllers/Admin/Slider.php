<?php

namespace App\Http\Controllers\Admin;

use DB;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use App\Rules\SafeInput;

class Slider extends Controller
{
    public function index()
    {
    	return view('admin.slider.index', [
    		'judul' => 'Slider'
    	]);
    }


    public function datatable()
    {
    	\DB::enablequerylog();
        $res = \App\Models\M_slider::orderByDesc('created_at')->get();
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
            			'action' => route('dashboard.slider.edit',['id' => $q->id]),
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
    	return view('admin.slider.add', [
    		'judul' => 'Slider'
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
        $id = \App\Models\M_slider::MaxId();
        $object = new \App\Models\M_slider;
        $object->id = $id;
        $object->judul = contul($request->judul);
        $object->aktif = contul(Str::slug($request->aktif));

        try{

            $folder = 'slider';
            $file = $request->file('foto');
            

            if ($request->has('foto')) {
            	// $filename = time() . '_' . $request->foto->getClientOriginalName();
            	$filename = time() . '_slider.' . $request->foto->getClientOriginalExtension();
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

                $path = $folder.'/'.$filename;
                $image = $request->file('foto');
                // $input['imagename'] = time().'.'.$request->foto->getClientOriginalName();
                $input['imagename'] = time().'_slider.'.$request->foto->getClientOriginalExtension();
             
                $destinationPath = storage_path('/app/public/'.$folder);
                $img = Image::make($image->path());
                $img->resize(928, 620)->save($destinationPath.'/'.$input['imagename']);
                
                $object->foto = 'slider/'.$input['imagename'];

            }

            

            $object->save();
            DB::commit();
            return response()->json([
                'redirect' => route('dashboard.slider'),
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
    		$old_data = \App\Models\M_slider::findOrFail($id);

    		$lampiran = \App\Models\Lampiran_info_penting::where('id_info_penting', $id)->get();

	    	return view('admin.slider.edit', [
	    		'judul' => 'Slider',
	    		'old_data' => $old_data,
	    		'lampiran' => $lampiran,
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
        $object = \App\Models\M_slider::find($request->id);
        if($object){

	        $object->judul = contul($request->judul);
	        $object->aktif = contul(Str::slug($request->aktif));
	        $object->updated_at = now();

	        try{

	            $folder = 'slider';
	            $file = $request->file('foto');
	            

	            if ($request->has('foto')) {
	            	// $filename = time() . '_' . $request->foto->getClientOriginalName();
	            	$filename = time() . '_silder.' . $request->foto->getClientOriginalExtension();
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

                    $path = $folder.'/'.$filename;
                    $image = $request->file('foto');
                    // $input['imagename'] = time().'.'.$request->foto->getClientOriginalName();
                    $input['imagename'] = time().'_slider.'.$request->foto->getClientOriginalExtension();
                 
                    $destinationPath = storage_path('/app/public/'.$folder);
                    $img = Image::make($image->path());
                    $img->resize(928, 620)->save($destinationPath.'/'.$input['imagename']);
                    Storage::delete('public/'.$object->foto);
                    $object->foto = 'slider/'.$input['imagename'];


	            }

	            

	            $object->save();
	            DB::commit();
	            return response()->json([
	                'redirect' => route('dashboard.slider.edit', ['id' =>  $request->id]),
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
    	$find = \App\Models\M_slider::find($request->data_id);
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
	            'redirect' => route('dashboard.slider'),
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
