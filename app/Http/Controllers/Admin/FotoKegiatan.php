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

class FotoKegiatan extends Controller
{
    public function index()
    {
    	return view('admin.foto_kegiatan.index', [
    		'judul' => 'Foto Kegiatan'
    	]);
    }


    public function datatable()
    {
    	\DB::enablequerylog();
        $res = \App\Models\Foto_kegiatan::orderByDesc('created_at')->get();
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
            			'action' => route('dashboard.foto-kegiatan.edit',['id' => $q->id]),
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
    	return view('admin.foto_kegiatan.add', [
    		'judul' => 'Foto Kegiatan'
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
        $id = \App\Models\Foto_kegiatan::MaxId();
        $object = new \App\Models\Foto_kegiatan;
        $object->id = $id;
        $object->judul = contul($request->judul);
        $object->narasi = contul($request->narasi);
        $object->slug = contul(Str::slug($request->judul.' '.time()));
        $object->aktif = contul(Str::slug($request->aktif));

        try{
            $object->save();
            DB::commit();
            return response()->json([
                'redirect' => route('dashboard.foto-kegiatan.edit', ['id' =>  $id]),
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
    		$old_data = \App\Models\Foto_kegiatan::findOrFail($id);

    		$lampiran = \App\Models\Lampiran_foto_kegiatan::where('id_foto_kegiatan', $id)->get();

	    	return view('admin.foto_kegiatan.edit', [
	    		'judul' => 'Foto Kegiatan',
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
        $object = \App\Models\Foto_kegiatan::find($request->id);
        if($object){

	        $object->judul = contul($request->judul);
	        $object->narasi = contul($request->narasi);
	        $object->slug = contul(Str::slug($request->judul.' '.time()));
	        $object->aktif = contul(Str::slug($request->aktif));
	        $object->updated_at = now();

	        try{

	            $object->save();
	            DB::commit();
	            return response()->json([
	                'redirect' => route('dashboard.foto-kegiatan.edit', ['id' =>  $request->id]),
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
            'tipe.required' => 'harus dipilih',
            // 'file_lampiran.required' => 'harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'deskripsi' => ['required',new SafeInput],
            'tipe' => ['required',new SafeInput],
            // 'file_lampiran' => ['required',],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'deskripsi' => $errors->first('deskripsi'),
                'tipe' => $errors->first('tipe'),
                // 'file_lampiran' => $errors->first('file_lampiran'),
            ]
            ]);
        }


        DB::beginTransaction();
        $object = new \App\Models\Lampiran_foto_kegiatan;

        $object->id = \App\Models\Lampiran_foto_kegiatan::MaxId();
        $object->deskripsi = contul($request->deskripsi);
        $object->tipe = contul($request->tipe);
        $object->id_foto_kegiatan = contul($request->id);

        try{

            $folder = 'foto_kegiatan';
            $file = $request->file('file_lampiran');
            $file_thumb = $request->file('file_thumbnail');
            

            if ($request->has('file_lampiran')) {
                $extension = $request->file_lampiran->getClientOriginalExtension();

                // $filename = time() . '_' . $request->file_lampiran->getClientOriginalName();
                $filename = time() . '_lampiran.' . $extension;
                

                if($request->tipe=='video'){
                    $allowedExtensions = ['webm', 'mp4'];
    
                    if (in_array($request->file('file_lampiran')->getClientOriginalExtension(), $allowedExtensions))
                    {
                        /*Pesan Error Validasi*/
                        $messages = [
                            "file_lampiran.required"  => "Silahkan memilih File / Dokumen terlebih dahulu !",
                            "file_lampiran.mimes"  => "Format video harus : webm atau mp4 !",
                            "file_thumbnail.required"  => "Silahkan memilih File thumbnail video !",
                            "file_thumbnail.image"  => "Format file thumbnail tidak didukung !",
                            // "file_lampiran.mimes"  => "Format file tidak didukung ! (harus ber-ekstensi *.webm atau *.mp4 )",
                        ];

                        /*Proses Validasi Input*/
                        $validator = Validator::make($request->all(), [
                            'file_lampiran' => 'required|mimes:webm,mp4',
                            'file_thumbnail' => 'required|image',
                        ], $messages);
                    }else{
                        DB::rollback();
                        return response()->json([
                            'redirect' => null,
                            'message' => 'Format Yang Di Upload Salah',
                            'status'  => 'error_server',
                        ]);
                    }

                }else if($request->tipe=='foto'){
                    $allowedExtensions = ['jpg', 'jpeg','png'];
    
                    if (in_array($request->file('file_lampiran')->getClientOriginalExtension(), $allowedExtensions))
                        {

                        /*Pesan Error Validasi*/
                        $messages = [
                            "file_lampiran.required"  => "Silahkan memilih File / Dokumen terlebih dahulu !",
                            "file_lampiran.image"  => "Format foto tidak didukung !",
                        ];

                        /*Proses Validasi Input*/
                        $validator = Validator::make($request->all(), [
                            'file_lampiran' => 'required|image',
                        ], $messages);
                    }else{
                        DB::rollback();
                        return response()->json([
                            'redirect' => null,
                            'message' => 'Format yang di upload salah',
                            'status'  => 'error_server',
                        ]);
                    }

                }

                /*Jika Validasi Gagal*/
                if ($validator->fails()) {
                    $errors = $validator->errors();

                    if($request->tipe=='foto'){
                        return \Response::json([
                            "error" => [
                                'file_lampiran'    => $errors->first('file_lampiran'),
                            ]
                        ]);
                    }else if($request->tipe=='video'){
                        return \Response::json([
                            "error" => [
                                'file_lampiran'    => $errors->first('file_lampiran'),
                                'file_thumbnail'    => $errors->first('file_thumbnail'),
                            ]
                        ]);
                    }
                }

                // $path = Storage::disk('public')->putFileAs('foto_kegiatan', $file, $filename);

                //=========================UPLOAD AND RESIZE IMAGE =============================
                

                if($request->tipe=='foto'){
                    $path = $folder.'/'.$filename;
                    $image = $request->file('file_lampiran');
                    // $input['imagename'] = time().'.'.$request->file_lampiran->getClientOriginalName();
                    $input['imagename'] = time().'_lampiran.'.$request->file_lampiran->getClientOriginalExtension();
                 
                    $destinationPath = storage_path('/app/public/'.$folder);
                    $img = Image::make($image->path());
                    $img->resize(800, 600)->save($destinationPath.'/'.$input['imagename']);
                    $object->file_lampiran = $folder.'/'.$input['imagename'];
                }
                else if($request->tipe=='video'){
                    $input['thumbnail'] = time().'.'.$request->file_thumbnail->getClientOriginalName();
                 
                    $destinationPath = storage_path('/app/public/'.$folder);
                    $img = Image::make($file_thumb->path());
                    $img->resize(800, 600)->save($destinationPath.'/'.$input['thumbnail']);
                    $object->file_thumbnail = $folder.'/'.$input['thumbnail'];

                    
                    $path = Storage::disk('public')->putFileAs('foto_kegiatan', $file, $filename);
                    $object->file_thumbnail = $folder.'/'.$input['thumbnail'];
                    $object->file_lampiran = $path;
                }

	            
            }else{
                return \Response::json([
                    "error" => [
                        'file_lampiran'    => 'anda belum memilih file untuk diupload',
                    ]
                ]);

            }

            $object->save();
            DB::commit();
            return response()->json([
                'redirect' => route('dashboard.foto-kegiatan.edit', ['id' =>  $request->id]),
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
    	$find = \App\Models\Lampiran_foto_kegiatan::find($request->id_lampiran);
    	DB::beginTransaction();
    	try{
    		if($find == null){
	    		return response()->json([
	                'message' => 'Data tidak ditemukan !',
	                'status'  => 'error',
	            ]);
	    	}
            Storage::delete('public/'.$find->file_lampiran);
	    	Storage::delete('public/'.$find->file_thumbnail);
	    	$find->delete();
	    	DB::commit();
	    	return response()->json([
	            'redirect' => route('dashboard.foto-kegiatan.edit', ['id' =>  $request->id_foto_kegiatan]),
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
    	$find = \App\Models\Foto_kegiatan::find($request->data_id);
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

    		$lampiran = \App\Models\Lampiran_foto_kegiatan::where('id_foto_kegiatan',$request->data_id);
    		foreach ($lampiran->get() as $key) {
                Storage::delete('public/'.$key->file_lampiran);
    			Storage::delete('public/'.$key->file_thumbnail);
    		}
    		$lampiran->delete();

            $comment = \App\Models\Komentar::where('id_kategori',$request->data_id)
            ->where('kategori', 'FOTO_KEGIATAN')->delete();

    		DB::commit();
    		return response()->json([
	            'redirect' => route('dashboard.foto-kegiatan'),
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
