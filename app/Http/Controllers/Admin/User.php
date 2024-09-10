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

class User extends Controller
{
    public function index()
    {
    	return view('admin.user.index', [
    		'judul' => 'User'
    	]);
    }


    public function datatable()
    {
    	\DB::enablequerylog();
        $res = \App\Models\User::orderByDesc('id')->get();
        return datatables()->of($res)
            ->addIndexColumn()
            ->addColumn('name', function ($q) {
                return ($q && $q->name != null) ? $q->name : null;
            })
            ->addColumn('username', function ($q) {
                return ($q && $q->username != null) ? $q->username : null;
            })
            ->addColumn('hak_akses', function ($q) {
            	$akses = \App\Models\M_role::find($q->role);
                return ($akses && $akses->role != null) ? $akses->role : null;
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
            			'action' => route('dashboard.user.edit',['id' => $q->id]),
            		],
            		[
            			'teks' => 'hapus',
            			'color' => 'danger',
            			'onclick' => 'hapus_data('.$q->id.')',
            			'action' => 'javascript:void(0);',
            		],

            	];

                if(session()->get('logged_in')['id'] != $q->id){

                return view('admin.tombol_action')
                    ->with([
                    	'id'  => $q->id,
                    	'menu'  => $menu,
                    ])
                    ->render();
                }
            })
            ->rawColumns(['aktif','action'])
            ->make(true);
    }

    public function add()
    {
    	$role = \App\Models\M_role::orderBy('role')->get();
    	return view('admin.user.add', [
    		'judul' => 'User',
    		'role'  => $role
    	]);
    }


    public function save(Request $request)
    {
        $messages = [
            'name.required' => 'Nama Lengkap wajib diisi',
            'role.required' => 'Hak akses wajib dipilih',
            'password.required' => 'Password wajib diisi',
            'username.min' => 'Username setidaknya berisi minimal 6 karakter huruf dan angka (tanpa karakter spesial)',
            'username.required' => 'Username wajib diisi',
            'username.alpha_num' => 'Username hanya dapat diisi karakter huruf dan angka (tanpa karakter spesial)',
            
        ];

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100',new SafeInput],
            'role' => ['required',new SafeInput],
            'password' => ['required', 'strong_password'],
            'username' => ['required', 'string', 'min:6', 'alpha_num',new SafeInput],
            
        ], $messages);

        // Add the custom validation rule for strong password
        $validator->addExtension('strong_password', function ($attribute, $value, $parameters, $validator) {
            // Define your password strength rules here
            $uppercase = preg_match('@[A-Z]@', $value);
            $lowercase = preg_match('@[a-z]@', $value);
            $number    = preg_match('@[0-9]@', $value);
            $specialChars = preg_match('@[^\w]@', $value);

            return $uppercase && $lowercase && $number && $specialChars && strlen($value) >= 12;
        });


        if ($validator->fails()) {

            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'name' => $errors->first('name'),
                    'username' => $errors->first('username'),
                    'role' => $errors->first('role'),
                    'password' => $errors->first('password'),
                    
                ]
            ]);
        }


        //IF SUCCESS
        DB::beginTransaction();

        $duplikat_user = \App\Models\User::where('username',$request->username)->count();
        if($duplikat_user > 0){
            return response()->json([
                'error' => [
                    'username' => 'Username '. $request->username. ' sudah digunakan',
                ]
            ]);
        }

     
        $find = new \App\Models\User;
        $find->id = \App\Models\User::MaxId();
        $find->username = $request->username;
        $find->password = Hash::make($request->password);
        $find->name = $request->name;
        $find->role = $request->role;
      

        try{
            $find->save();
            DB::commit();
            return response()->json([
                'redirect' => route('dashboard.user'),
                'status'  => 'success',
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'redirect' => $e->getMessage(),
                'status'  => 'server_error',
            ]);

        }
    }

    public function edit($id)
    {
    	if($id !='' && is_numeric($id)){
    		$old_data = \App\Models\User::findOrFail($id);


    		$role = \App\Models\M_role::orderBy('role')->get();

	    	return view('admin.user.edit', [
	    		'judul' => 'User',
	    		'old_data' => $old_data,
				'role' => $role
	    	]);

    	}

    	abort(404);
    }


    public function update(Request $request)
    {
        $messages = [
            'name.required' => 'Nama Lengkap wajib diisi',
            'role.required' => 'Hak akses wajib dipilih',
            'password.min' => 'Password harus diisi setidaknya 6 karakter huruf dan angka (tanpa spasi dan karakter spesial) ',
            'password.alpha_num' => 'Password harus diisi setidaknya 6 karakter huruf dan angka (tanpa spasi dan karakter spesial) ',
            'username.min' => 'Username setidaknya berisi minimal 6 karakter huruf dan angka (tanpa karakter spesial)',
            'username.required' => 'Username wajib diisi',
            'username.alpha_num' => 'Username hanya dapat diisi karakter huruf dan angka (tanpa karakter spesial)',
            
        ];

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100',new SafeInput],
            'role' => ['required',new SafeInput],
            'password' => ['nullable', 'min:6', 'alpha_num'],
            'username' => ['required', 'string', 'min:6', 'alpha_num',new SafeInput],
            
        ], $messages);



        if ($validator->fails()) {

            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'name' => $errors->first('name'),
                    'username' => $errors->first('username'),
                    'role' => $errors->first('role'),
                    'password' => $errors->first('password'),
                    
                ]
            ]);
        }

        $duplikat_user = \App\Models\User::where('username',$request->username)
        ->whereNotIn('id',[$request->id])
        ->count();
        if($duplikat_user > 0){
            return response()->json([
                'error' => [
                    'username' => 'Username '. $request->username. ' sudah digunakan',
                ]
            ]);
        }

        DB::beginTransaction();
        $find = \App\Models\User::find($request->id);
        if($find){

        	if($request->has('password')){
		        $find->password = Hash::make($request->password);
        	}
	        $find->username = $request->username;
	        $find->name = $request->name;
	        $find->role = $request->role;
	        $find->aktif = $request->aktif;
	        $find->updated_at = now();

	        try{

	            $find->save();
	            DB::commit();
	            return response()->json([
	                'redirect' => route('dashboard.user'),
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

        }else{
        	return response()->json([
                'redirect' => null,
                'message' => 'Parameter missing !',
                'status'  => 'error_server',
            ]);
        }
        
    }




    function hapus(Request $request)
    {
    	$find = \App\Models\User::find($request->data_id);
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
	            'redirect' => route('dashboard.user'),
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
