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

class KontenStatisWeb extends Controller
{
    public function index()
    {
    	return view('admin.konten_statis_web.index', [
    		'judul' => 'Konten Statis'
    	]);
    }


    public function datatable()
    {
    	\DB::enablequerylog();
        $res = \App\Models\M_konten_web::orderByDesc('parent','id')->get();
        // TPermohonan::where('id_user','=', session()->get('logged_in.id_user'))
        // ->with('m_ijin')->orderBy('created_at','desc')->get();
        // dd(\DB::getquerylog());
        return datatables()->of($res)
            ->addIndexColumn()
            ->addColumn('judul', function ($q) {
                return ($q && $q->judul_konten != null) ? $q->judul_konten : null;
            })
            ->addColumn('aktif', function ($q) {
                return ($q->aktif=='1') ? '<a href="#" class="text-success">Aktif</a>' : '<a href="#" class="text-danger">Tidak Aktif</a>';
            })
            ->addColumn('parent', function ($q) {
                return ($q && !is_null($q->judul_konten)) ? $q->judul_konten : null;
            	if($q->parent != null){
            		$nama_parent = \App\Models\M_konten_web::find($q->parent)->judul_konten;
            	}else{
            		$nama_parent = null;	
            	}

                return $nama_parent;
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
            			'action' => route('dashboard.konten-statis-web.edit',['id' => $q->id]),
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
    	$parents = \App\Models\M_konten_web::select('id','judul_konten')->orderBy('id')->get();
    	return view('admin.konten_statis_web.add', [
    		'judul' => 'Konten Statis',
    		'parents' => $parents
    	]);
    }


    public function save(Request $request)
    {
        $messages = [
            'judul_konten.required' => 'harus diisi',
            // 'narasi.required' => 'harus diisi',
            'aktif.required' => 'harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'judul_konten' => ['required',new SafeInput],
            // 'narasi' => ['required',],
            'aktif' => ['required',new SafeInput],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'judul_konten' => $errors->first('judul_konten'),
                // 'narasi' => $errors->first('narasi'),
                'aktif' => $errors->first('aktif'),
            ]
            ]);
        }


        DB::beginTransaction();
        $id = \App\Models\M_konten_web::MaxId();
        $object = new \App\Models\M_konten_web;
        $object->id = $id;
        $object->judul_konten = contul($request->judul_konten);
        $object->narasi = contul($request->narasi);
        $object->slug = contul(Str::slug($request->judul_konten.' '.time()));
        $object->aktif = contul(Str::slug($request->aktif));
        if($request->parent!=''){
        	$object->parent = contul($request->parent);
        }

        try{

            $folder = 'konten_statis_web';
            $file = $request->file('foto');
            

            if ($request->has('foto')) {
                $allowedExtensions = ['jpg', 'jpeg','png'];

                if (in_array($request->file('foto')->getClientOriginalExtension(), $allowedExtensions))
                {
                    // $filename = time() . '_' . $request->foto->getClientOriginalName();
                    $filename = time() . '_konten_statis.' . $request->foto->getClientOriginalExtension();
                    /*Pesan Error Validasi*/
                    $messages = [
                        "foto.required"  => "Silahkan memilih File / Dokumen terlebih dahulu !",
                        "foto.image"     => "Ekstensi file harus berupa gambar !",
                        "foto.size"     => "Ukuran gambar tidak boleh melebihi 1 MB !",
                    ];

                    /*Proses Validasi Input*/
                    $validator = Validator::make($request->all(), [
                        'foto' => 'file',
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
                    $input['imagename'] = time().'_konten_statis.'.$request->foto->getClientOriginalExtension();
                
                    $destinationPath = storage_path('/app/public/'.$folder);
                    // $img = Image::make($image->path());
                    $file->move($destinationPath, $filename);
                    // $img->resize(800, 600)->save($destinationPath.'/'.$input['imagename']);
                    // $img->save($destinationPath.'/'.$input['imagename']);
                    // Storage::delete('public/'.$object->foto);
                    $object->foto = 'konten_statis_web/'.$input['imagename'];
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
                'redirect' => route('dashboard.konten-statis-web.edit', ['id' =>  $id]),
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
    		$old_data = \App\Models\M_konten_web::findOrFail($id);

    		$lampiran = \App\Models\Lampiran_konten_web::where('id_konten', $id)->get();

    		$parents = \App\Models\M_konten_web::select('id','judul_konten')->orderBy('id')->get();

	    	return view('admin.konten_statis_web.edit', [
	    		'judul' => 'Konten Statis',
	    		'old_data' => $old_data,
	    		'lampiran' => $lampiran,
				'parents' => $parents
	    	]);

    	}

    	abort(404);
    }


    public function update(Request $request)
    {
        $messages = [
            'judul_konten.required' => 'harus diisi',
            // 'narasi.required' => 'harus diisi',
            'aktif.required' => 'harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'judul_konten' => ['required',new SafeInput],
            // 'narasi' => ['required',],
            'aktif' => ['required',new SafeInput],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'judul_konten' => $errors->first('judul_konten'),
                // 'narasi' => $errors->first('narasi'),
                'aktif' => $errors->first('aktif'),
            ]
            ]);
        }


        DB::beginTransaction();
        $object = \App\Models\M_konten_web::find($request->id);
        if($object){

	        $object->judul_konten = contul($request->judul_konten);
	        $object->narasi = contul($request->narasi);
	        $object->slug = contul(Str::slug($request->judul.' '.time()));
	        $object->aktif = contul($request->aktif);
	        $object->parent = contul($request->parent);
	        $object->updated_at = now();

	        try{

	            $folder = 'konten_statis_web';
	            $file = $request->file('foto');
	            

	            if ($request->has('foto')) {
                $allowedExtensions = ['jpg', 'jpeg','png','mp4'];

                if (in_array($request->file('foto')->getClientOriginalExtension(), $allowedExtensions))
                {
	            	// $filename = time() . '_' . $request->foto->getClientOriginalName();
	            	$filename = time() . '_konten_statis.' . $request->foto->getClientOriginalExtension();
	            	/*Pesan Error Validasi*/
		            $messages = [
		                "foto.required"  => "Silahkan memilih File / Dokumen terlebih dahulu !",
		                "foto.image"     => "Ekstensi file harus berupa gambar !",
		                "foto.size"     => "Ukuran gambar tidak boleh melebihi 1 MB !",
		            ];

		            /*Proses Validasi Input*/
		            $validator = Validator::make($request->all(), [
		                'foto' => 'file',
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
		            
	                // $path = Storage::disk('public')->putFileAs($folder, $file, $filename);

                    $path = $folder.'/'.$filename;
                    $image = $request->file('foto');
                    // $input['imagename'] = time().'.'.$request->foto->getClientOriginalName();
                    $input['imagename'] = time().'_konten_statis.'.$request->foto->getClientOriginalExtension();
                 
                    $destinationPath = storage_path('/app/public/'.$folder);
                    // $img = Image::make($image->path());
                    $file->move($destinationPath, $filename);
                    // $img->resize(800, 600)->save($destinationPath.'/'.$input['imagename']);
                    // $img->save($destinationPath.'/'.$input['imagename']);
                    Storage::delete('public/'.$object->foto);
                    $object->foto = 'konten_statis_web/'.$input['imagename'];
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
	                'redirect' => route('dashboard.konten-statis-web.edit', ['id' =>  $request->id]),
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
            'judul_lampiran.required' => 'harus diisi',
            'file_lampiran.required' => 'harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'judul_lampiran' => ['required',],
            'file_lampiran' => ['required',],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'judul_lampiran' => $errors->first('judul_lampiran'),
                'file_lampiran' => $errors->first('file_lampiran'),
            ]
            ]);
        }


        DB::beginTransaction();
        $object = new \App\Models\Lampiran_konten_web;

        $object->id = \App\Models\Lampiran_konten_web::MaxId();
        $object->judul_lampiran = contul($request->judul_lampiran);
        $object->id_konten = contul($request->id);

        try{

            $folder = 'konten_statis_web';
            $file = $request->file('file_lampiran');
            

            if ($request->has('file_lampiran')) {
                $allowedExtensions = ['pdf'];

                if (in_array($request->file('file_lampiran')->getClientOriginalExtension(), $allowedExtensions))
                {
            	// $filename = time() . '_' . $request->file_lampiran->getClientOriginalName();
            	$filename = time() . '_lampiran.' . $request->file_lampiran->getClientOriginalExtension();
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
                'redirect' => route('dashboard.konten-statis-web.edit', ['id' =>  $request->id]),
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
    	$find = \App\Models\Lampiran_konten_web::find($request->id_lampiran);
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
	            'redirect' => route('dashboard.konten-statis-web.edit', ['id' =>  $request->id_konten]),
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
    	$find = \App\Models\M_konten_web::find($request->data_id);
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

    		$lampiran = \App\Models\Lampiran_konten_web::where('id_konten',$request->data_id);
    		foreach ($lampiran->get() as $key) {
    			Storage::delete('public/'.$key->file_lampiran);
    		}
    		$lampiran->delete();

    		DB::commit();
    		return response()->json([
	            'redirect' => route('dashboard.konten-statis-web'),
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
