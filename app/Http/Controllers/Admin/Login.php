<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Login extends Controller
{
    public function index(Request $request)
    {
    	if ($request->session()->get('logged_in')) {
            return redirect()->route('dashboard.index');
        }

        $angka1 = mt_rand(1,10);
        $angka2 = mt_rand(1,10);

        session()->put('angka1', $angka1);
        session()->put('angka2', $angka2);
        // dd(Hash::make('masbojes'));

    	return view('admin.auth.login', [
    		'angka1' => $angka1,
    		'angka2' => $angka2,
    	]);
    }


    public function form_login_action(Request $request)
    {
        // Secret Key ini kita ambil dari halaman Google reCaptcha
        // Sesuai pada catatan saya di STEP 1 nomor 6
        $secret_key = "6LfL87UoAAAAANEEiaJLy9kDkdc5KXwTuDQ_AQq4";
    
        // Disini kita akan melakukan komunkasi dengan google recpatcha
        // dengan mengirimkan scret key dan hasil dari response recaptcha nya
        $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
        $response = json_decode($verify);
        
    if($response->success){ // Jika proses validasi captcha google berhasil
        $messages = [
            'username.required' => 'masukkan Username',
            'password.required' => 'masukkan password',
            // 'answer.required' => 'masukkan kode keamanan',
        ];

        $validator = Validator::make($request->all(), [
            'username' => ['required','string'],
            'password' => ['required','string'],
            // 'answer' => ['required','numeric'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return \Response::json([
                'error' => [
                    'username' => $errors->first('username'),
                    'password' => $errors->first('password'),
                    // 'answer' => $errors->first('answer'),
                ]
            ]);
        }

        // if( (session('angka1') + session('angka2')) != ($request->answer) )
        // // if( ($request->angka1 + $request->angka2) != ($request->answer) )
        // {
        // 	$angka1 = mt_rand(1,10);
        // 	$angka2 = mt_rand(1,10);
        //     session()->put('angka1', $angka1);
        //     session()->put('angka2', $angka2);

        // 	$errors = $validator->errors();
        //     return \Response::json([
        //         'error' => [
        //             'answer' => "Jawaban kode keamanan salah !",
        //         ]
        //     ]);
        // }

        /* cek keberadaan user */

        $user = User::where('aktif', '1')->where('username', '=', htmlentities($request->username, ENT_QUOTES, 'UTF-8'))
            	->first();

                // dd($user);

        /** jika user ditemukan */
        if ($user != null) {
            $cek_hash = Hash::check($request->password, $user->password);
            if ($cek_hash === FALSE) {
                return \Response::json([
                    'error'  => [
                    	'username' => 'Mohon maaf, username atau password Anda salah'
                    ],
                ]);
            } else if ($cek_hash === TRUE) {
                $request->session()->put('logged_in', 'true');
                $request->session()->put('logged_in.id', $user->id);
                $request->session()->put('logged_in.name', $user->name);
                $request->session()->put('logged_in.username', $user->username);
                $request->session()->put('logged_in.role', $user->role);
                $request->session()->put('logged_in.hak_akses', \App\Models\M_role::findOrFail($user->role)->role);
                $request->session()->regenerate();

                // If user attempted to access specific URL before logging in
                if (\Session::has('pre_login_url')) {
                    $url = \Session::get('pre_login_url');
                    \Session::forget('pre_login_url');
                    return \Response::json([
                        'redirect' => $url,
                        'status'  => 'success'
                    ]);
                } else {
                    // dd(session('logged_in'));
                    return \Response::json([
                        'redirect' => route('dashboard.index'),
                        'status'  => 'success'
                    ]);
                    
                }
            }
        /** jika user tidak ditemukan */
        } else {
            return \Response::json([
                'error'  => [
                	'username' => 'Mohon maaf, username atau password Anda salah'
                ],
            ]);
        }

        return \Response::json(['error'=>$validator->errors()->all()]);
    }
    }


    function refresh_capcay()
    {
    	$angka1 = mt_rand(1,10);
        $angka2 = mt_rand(1,10);
        session()->put('angka1', $angka1);
        session()->put('angka2', $angka2);

    	return \Response::json([
    		'angka1' => $angka1,
    		'angka2' => $angka2,
    	]);
    }	

    public function logout(Request $request)
    {
        $request->session()->forget('logged_in');
        return redirect()->route('dashboard.login');
    }
}
