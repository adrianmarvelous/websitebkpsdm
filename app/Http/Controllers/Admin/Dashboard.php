<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Dashboard extends Controller
{
    public function index()
    {
    	return view('admin.index', [
    		// 'categories' => $categories
    	]);
    }


    public function profil_saya()
    {
    	$data_user = \App\Models\User::find(session('logged_in')['id']);
    	if($data_user){

    		return view('admin.user.profil_saya', [
	    		'judul' => 'Profil Saya',
	    		'old_data' => $data_user
	    	]);
    	}

		redirect()->route('dashboard.login');
    }

    public function update_profil_saya(Request $request)
    {
    	$messages = [
            'name.required' => 'Nama Lengkap wajib diisi',
            'password.min' => 'Password harus diisi setidaknya 6 karakter huruf dan angka (tanpa spasi dan karakter spesial) ',
            'password.alpha_num' => 'Password harus diisi setidaknya 6 karakter huruf dan angka (tanpa spasi dan karakter spesial) ',
            'username.min' => 'Username setidaknya berisi minimal 6 karakter huruf dan angka (tanpa karakter spesial)',
            'username.required' => 'Username wajib diisi',
            'username.alpha_num' => 'Username hanya dapat diisi karakter huruf dan angka (tanpa karakter spesial)',
        ];

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100',],
            'password' => ['nullable', 'min:6', 'alpha_num'],
            'username' => ['required', 'string', 'min:6', 'alpha_num'],
        ], $messages);

        if ($validator->fails()) {

            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'name' => $errors->first('name'),
                    'username' => $errors->first('username'),
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
	        $find->updated_at = now();

	        try{

	            $find->save();
	            DB::commit();
	            return response()->json([
	                'redirect' => route('dashboard.profil_saya'),
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
}
