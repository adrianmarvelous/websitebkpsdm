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

class Komentar extends Controller
{
    public function index()
    {
    	return view('admin.komentar.index', [
    		'judul' => 'Komentar'
    	]);
    }


    public function datatable()
    {
    	\DB::enablequerylog();
        $res = \App\Models\Komentar::orderByDesc('created_at')->get();
        // TPermohonan::where('id_user','=', session()->get('logged_in.id_user'))
        // ->with('m_ijin')->orderBy('created_at','desc')->get();
        // dd(\DB::getquerylog());
        return datatables()->of($res)
            ->addIndexColumn()
            ->addColumn('nickname', function ($q) {
                return $q->nickname;
            })
            ->addColumn('aktif', function ($q) {
                return ($q->aktif=='1') ? '<a href="#" class="text-success">Aktif</a>' : '<a href="#" class="text-danger">Tidak Aktif</a>';
            })
            // ->addColumn('kategori', function ($q) {
            //     return str_replace('_', ' ', $q->kategori);
            // })
            // ->addColumn('judul', function ($q) {
            // 	if($q->kategori == 'INFO_PENTING'){
            // 		$get_judul = \App\Models\InfoPenting::find($q->id_kategori);
            // 	}elseif ($q->kategori == 'FOTO_KEGIATAN') {
            // 		$get_judul = \App\Models\Foto_kegiatan::find($q->id_kategori);
            // 	}

            // 	if($get_judul){
            // 		$judul = $get_judul->judul;
            // 	}else{
            // 		$judul = '-';
            // 	}
            //     return $judul;
            // })
            ->addColumn('created_at', function ($q) {
                return date('d-m-Y H:i:s',strtotime($q->created_at));
            })
            ->addColumn('tanggapan', function ($q) {
                return $q->respon_admin ? '<span class="text-success">Sudah ada</span>' : '<span class="text-danger">Belum ada</span>';
            })
            ->addColumn('action', function ($q) {
            	$menu = [
            		[
            			'teks' => 'edit',
            			'color' => 'warning',
            			'onclick' => null,
            			'action' => route('dashboard.komentar.edit',['id' => $q->id]),
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
            ->rawColumns(['aktif','tanggapan','action'])
            ->make(true);
    }

 

    public function edit($id)
    {
    	if($id !='' && is_numeric($id)){
    		$old_data = \App\Models\Komentar::findOrFail($id);
    		// if($old_data->kategori == 'INFO_PENTING'){
      //   		$get_judul = \App\Models\InfoPenting::find($old_data->id_kategori);
      //   	}elseif ($old_data->kategori == 'FOTO_KEGIATAN') {
      //   		$get_judul = \App\Models\Foto_kegiatan::find($old_data->id_kategori);
      //   	}

      //   	if($get_judul){
      //   		$judul = $get_judul->judul;
      //   	}else{
      //   		$judul = '-';
      //   	}


	    	return view('admin.komentar.edit', [
	    		'judul' => 'Tanggapi Komentar',
	    		'old_data' => $old_data,
	    		'judul_posting' => null,
	    	]);

    	}

    	abort(404);
    }


    public function update(Request $request)
    {
        $messages = [
            'nickname.required' => 'harus diisi',
            'comment.required' => 'harus diisi',
            'aktif.required' => 'harus dipilih',
        ];

        $validator = Validator::make($request->all(), [
            'nickname' => ['required',new SafeInput],
            'comment' => ['required',new SafeInput],
            'aktif' => ['required',new SafeInput],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'nickname' => $errors->first('nickname'),
                'comment' => $errors->first('comment'),
                'aktif' => $errors->first('aktif'),
            ]
            ]);
        }


        DB::beginTransaction();
        $object = \App\Models\Komentar::find($request->id);
        if($object){

	        $object->nickname = contul($request->nickname);
	        $object->comment = contul($request->comment);
	        $object->respon_admin = contul($request->respon_admin);
	        $object->aktif = contul($request->aktif);
	        $object->updated_at = now();

	        try{

	            $object->save();
	            DB::commit();
	            return response()->json([
	                'redirect' => route('dashboard.komentar'),
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
    	$find = \App\Models\Komentar::find($request->data_id);
    	DB::beginTransaction();
    	try{
    		if($find == null){
    			return response()->json([
	                'message' => 'Data tidak ditemukan !',
	                'status'  => 'error',
	            ]);
    		}
    		$find->delete();

    		
    		DB::commit();
    		return response()->json([
	            'redirect' => route('dashboard.komentar'),
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