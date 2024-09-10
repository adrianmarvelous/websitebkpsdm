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

class InfoPenting extends Controller
{
    public function index()
    {
    	return view('admin.info_penting.index', [
    		'judul' => 'Info Penting'
    	]);
    }


    public function datatable()
    {
    	\DB::enablequerylog();
        $res = \App\Models\InfoPenting::orderByDesc('created_at')->get();
        // TPermohonan::where('id_user','=', session()->get('logged_in.id_user'))
        // ->with('m_ijin')->orderBy('created_at','desc')->get();
        // dd(\DB::getquerylog());
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
            			'action' => route('dashboard.info-penting.edit',['id' => $q->id]),
            		],
            		[
            			'teks' => 'hapus',
            			'color' => 'danger',
            			'onclick' => 'hapus_data('.$q->id.')',
            			'action' => 'javascript:void(0);',
            		],

            	];

                return view('admin.tombol_action')
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
    	return view('admin.info_penting.add', [
    		'judul' => 'Info Penting'
    	]);
    }


    public function save(Request $request)
    {
        $messages = [
            'judul.required' => 'harus diisi',
            'narasi.required' => 'harus diisi',
            'aktif.required' => 'harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'judul' => ['required',new SafeInput],
            'narasi' => ['required',new SafeInput],
            'aktif' => ['required',new SafeInput],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'judul' => $errors->first('judul'),
                'narasi' => $errors->first('narasi'),
                'aktif' => $errors->first('aktif'),
            ]
            ]);
        }


        DB::beginTransaction();
        $id = \App\Models\InfoPenting::MaxId();
        $object = new \App\Models\InfoPenting;
        $object->id = $id;
        $object->judul = contul($request->judul);
        $object->narasi = contul($request->narasi);
        $object->slug = contul(Str::slug($request->judul.' '.time()));
        $object->aktif = contul(Str::slug($request->aktif));

        try{

            $folder = 'info-penting';
            $file = $request->file('foto_utama');
            

            if ($request->has('foto_utama')) {
            	$filename = time() . '_' . $request->foto_utama->getClientOriginalName();
            	/*Pesan Error Validasi*/
	            $messages = [
	                "foto_utama.required"  => "Silahkan memilih File / Dokumen terlebih dahulu !",
	                "foto_utama.image"     => "Ekstensi file harus berupa gambar !",
	                "foto_utama.size"     => "Ukuran gambar tidak boleh melebihi 1 MB !",
	            ];

	            /*Proses Validasi Input*/
	            $validator = Validator::make($request->all(), [
	                'foto_utama' => 'image|mimes:jpeg,png,jpg',
	            ], $messages);

	            /*Jika Validasi Gagal*/
	            if ($validator->fails()) {
	                $errors = $validator->errors();
	                return \Response::json([
	                    "error" => [
	                        'foto_utama'    => $errors->first('foto_utama'),
	                    ]
	                ]);
	            }

                // $path = Storage::disk('public')->putFileAs($folder, $file, $filename);
                $path = $folder.'/'.$filename;

                $image = $request->file('foto_utama');
                
                $input['imagename'] = time().'_info_penting.'.$request->foto_utama->getClientOriginalExtension();
             
                $destinationPath = storage_path('/app/public/'.$folder);
                $img = Image::make($image->path());
                $img->resize(800, 600)->save($destinationPath.'/'.$input['imagename']);
                
	            $object->foto = 'info-penting/'.$input['imagename'];
            }

            

            $object->save();
            DB::commit();
            return response()->json([
                'redirect' => route('dashboard.info-penting.edit', ['id' =>  $id]),
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
    		$old_data = \App\Models\InfoPenting::findOrFail($id);
            // $old_data->narasi = preg_replace('/(?<=<script\b[^>]*>)(.*?)\b(prompt)\b(.*?)(?=<\/script>)/is', '$1$3', $old_data->narasi);

    		$lampiran = \App\Models\Lampiran_info_penting::where('id_info_penting', $id)->get();

	    	return view('admin.info_penting.edit', [
	    		'judul' => 'Info Penting',
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
            'narasi.required' => 'harus diisi',
            'aktif.required' => 'harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'judul' => ['required',new SafeInput],
            'narasi' => ['required',new SafeInput],
            'aktif' => ['required',new SafeInput],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'judul' => $errors->first('judul'),
                'narasi' => $errors->first('narasi'),
                'aktif' => $errors->first('aktif'),
            ]
            ]);
        }


        DB::beginTransaction();
        $object = \App\Models\InfoPenting::find($request->id);
        if($object){

	        $object->judul = contul($request->judul);
	        $object->narasi = contul($request->narasi);
	        $object->slug = contul(Str::slug($request->judul.' '.time()));
	        $object->aktif = contul(Str::slug($request->aktif));
	        $object->updated_at = now();

	        try{

	            $folder = 'info-penting';
	            $file = $request->file('foto_utama');
	            

	            if ($request->has('foto_utama')) {
	            	// $filename = time() . '_' . $request->foto_utama->getClientOriginalName();
	            	$filename = time() . '_foto_utama.' . $request->foto_utama->getClientOriginalExtension();;
	            	/*Pesan Error Validasi*/
		            $messages = [
		                "foto_utama.required"  => "Silahkan memilih File / Dokumen terlebih dahulu !",
		                "foto_utama.image"     => "Ekstensi file harus berupa gambar !",
		                "foto_utama.size"     => "Ukuran gambar tidak boleh melebihi 1 MB !",
		            ];

		            /*Proses Validasi Input*/
		            $validator = Validator::make($request->all(), [
		                'foto_utama' => 'image|file',
		            ], $messages);

		            /*Jika Validasi Gagal*/
		            if ($validator->fails()) {
		                $errors = $validator->errors();
		                return \Response::json([
		                    "error" => [
		                        'foto_utama'    => $errors->first('foto_utama'),
		                    ]
		                ]);
		            }
		            Storage::delete('public/'.$object->foto);
	                $path = $folder.'/'.$filename;

                    $image = $request->file('foto_utama');
                    // $input['imagename'] = time().'.'.$request->foto_utama->getClientOriginalName();
                    $input['imagename'] = time().'_info_penting.jpg';
                 
                    $destinationPath = storage_path('/app/public/'.$folder);
                    $img = Image::make($image->path());
                    $img->resize(800, 600)->save($destinationPath.'/'.$input['imagename']);
                    
                    $object->foto = 'info-penting/'.$input['imagename'];
	            }

	            

	            $object->save();
	            DB::commit();
	            return response()->json([
	                'redirect' => route('dashboard.info-penting.edit', ['id' =>  $request->id]),
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




    public function upload(Request $request)
    {
        $messages = [
            'deskripsi.required' => 'harus diisi',
            'file_lampiran.required' => 'harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'deskripsi' => ['required',new SafeInput],
            'file_lampiran' => ['required',],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'deskripsi' => $errors->first('deskripsi'),
                'file_lampiran' => $errors->first('file_lampiran'),
            ]
            ]);
        }


        DB::beginTransaction();
        $object = new \App\Models\Lampiran_info_penting;

        $object->id = \App\Models\Lampiran_info_penting::MaxId();
        $object->deskripsi = contul($request->deskripsi);
        $object->id_info_penting = contul($request->id);

        try{

            $folder = 'info-penting';
            $file = $request->file('file_lampiran');
            

            if ($request->has('file_lampiran')) {
                $allowedExtensions = ['pdf', 'jpg', 'jpeg','png'];

                if (in_array($request->file('file_lampiran')->getClientOriginalExtension(), $allowedExtensions))
                {
                    // $filename = time() . '_' . $request->file_lampiran->getClientOriginalName();
                    $filename = time() . '_file_lampiran.' .$request->file_lampiran->getClientOriginalExtension();
                    /*Pesan Error Validasi*/
                    $messages = [
                        "file_lampiran.required"  => "Silahkan memilih File / Dokumen terlebih dahulu !",
                        "file_lampiran.file"     => "Ekstensi file tidak valid atau Corrupt !",
                        "file_lampiran.mimes"     => "Ekstensi file tidak sesuai dengan ketentuan !",
                    ];
    
                    /*Proses Validasi Input*/
                    $validator = Validator::make($request->all(), [
                        'file_lampiran' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx',
                    ], $messages);
    
                    /*Jika Validasi Gagal*/
                    if ($validator->fails()) {
                        $errors = $validator->errors();
                        return \Response::json([
                            "error" => [
                                'file_lampiran'    => $errors->first('file_lampiran'),
                            ]
                        ]);
                    }
                    $path = Storage::disk('public')->putFileAs($folder, $file, $filename);
                    $object->file_lampiran = $path;
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
                'redirect' => route('dashboard.info-penting.edit', ['id' =>  $request->id]),
                'status'  => 'success',
                'message'  => 'Lampiran berhasil di upload !',
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


    function hapus_lampiran(Request $request)
    {
    	$find = \App\Models\Lampiran_info_penting::find($request->id_lampiran);
    	DB::beginTransaction();
    	try{
    		if($find == null){
	    		return response()->json([
	                'message' => 'Data tidak ditemukan !',
	                'status'  => 'error',
	            ]);
	    	}
	    	Storage::delete('public/'.$find->file_lampiran);
	    	$find->delete();
	    	DB::commit();
	    	return response()->json([
	            'redirect' => route('dashboard.info-penting.edit', ['id' =>  $request->id_info_penting]),
	            'message' => 'Berhasil menghapus File !',
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

    function hapus(Request $request)
    {
    	$find = \App\Models\InfoPenting::find($request->data_id);
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

    		$lampiran = \App\Models\Lampiran_info_penting::where('id_info_penting',$request->data_id);
    		foreach ($lampiran->get() as $key) {
    			Storage::delete('public/'.$key->file_lampiran);
    		}
    		$lampiran->delete();

            $comment = \App\Models\Komentar::where('id_kategori',$request->data_id)
            ->where('kategori', 'INFO_PENTING')->delete();

    		DB::commit();
    		return response()->json([
	            'redirect' => route('dashboard.info-penting'),
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
