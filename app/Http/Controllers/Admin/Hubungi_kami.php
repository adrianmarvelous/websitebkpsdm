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

class Hubungi_kami extends Controller
{
    public function edit()
    {
    		$old_data = \App\Models\Hubungi_kami::first();

	    	return view('admin.hubungi_kami.edit', [
	    		'judul' => 'Hubungi Kami',
	    		'old_data' => $old_data,
	    	]);


    	abort(404);
    }


    public function update(Request $request)
    {
        $messages = [
            'narasi.required' => 'harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'narasi' => ['required',new SafeInput],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'narasi' => $errors->first('narasi'),
            ]
            ]);
        }


        DB::beginTransaction();
        $object = \App\Models\Hubungi_kami::first();
        if($object){

	        $object->narasi = contul($request->narasi);
	        $object->updated_at = now();

	        try{

	            $object->save();
	            DB::commit();
	            return response()->json([
	                'redirect' => route('dashboard.hubungi-kami'),
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
}
