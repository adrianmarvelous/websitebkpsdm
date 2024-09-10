<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Home extends Controller
{
    public function index()
    {
    	return view('web.index', [
    		// 'categories' => $categories
    	]);
    }
    public function index_v1()
    {
    	return view('web.index_v1', [
    		// 'categories' => $categories
    	]);
    }
    public function coming_soon()
    {
        return view('web.coming_soon');
    }

    public function pembinaan(){
        return view('web.pembinaan.index');
    }

    public function asn_netral()
    {
    	return view('web.pembinaan.asn_netral');
    }
    public function bermedsos()
    {
    	return view('web.pembinaan.medsos');
    }
    public function gratifikasi()
    {
    	return view('web.pembinaan.gratifikasi');
    }
    public function antinarkoba()
    {
    	return view('web.pembinaan.antinarkoba');
    }
    public function kode_etik()
    {
    	return view('web.pembinaan.kode_etik');
    }
    public function jam_kerja()
    {
    	return view('web.pembinaan.jam_kerja');
    }
    public function jam_kerja_1()
    {
    	return view('web.pembinaan.jam_kerja_1');
    }
    public function pengumuman_1(){
        return view('web.pengumuman.pengumuman_1');
    }
    public function pengumuman_penerimaan(){
        return view('web.pengumuman.pengumuman_penerimaan');
    }
    public function qna_pppk(){
        return view('web.pengumuman.link_contact');
    }
    public function under_construction(){
        return view('web.under_construction');
    }

    public function hasil_seleksi_administrasi()
    {
        return view('web.pengumuman.hasil_seleksi_administrasi');
    }
    public function jadwal_seleksi()
    {
        return view('web.pengumuman.jadwal_seleksi');
    }
    public function hasil_akhir_pppk()
    {
        return view('web.pengumuman.hasil_akhir_pppk');
    }
    public function hasil_akhir_pppk_guru()
    {
        return view('web.pengumuman.hasil_akhir_pppk_guru');
    }
    public function info_cpns()
    {
        return view('web.cpns_pppk.cpns');
    }
    public function jadwal_cpns()
    {
        return view('web.cpns_pppk.jadwal');
    }
    public function press_release_cpns()
    {
        return view('web.cpns_pppk.press_release_cpns');
    }

    public function cari(Request $request)
    {
    	$keyword = \Str::slug($request->keywords);
    	$final = str_replace('-', ' ', $keyword);

    	if($keyword != ''){
    		return response()->json([
                'redirect' => route('result', ['key' => $keyword]),
                'status'   => 'success',
            ]);
    	}else{
    		return response()->json([
                'error' => 'keyword harus diisi !',
            ]);
    	}
    }

    public function result($key = null)
    {
        // $pecah = explode('.', Route::currentRouteName());
        // $key = last($pecah);

        // $keyword = \Str::slug($request->keywords);
        $final = str_replace('-', ' ', $key);

        if($key != ''){

            if(preg_match('/^[a-z0-9 .\-]+$/i', $final))
            {
                /**
                 * KATEGORI INFO PENTING
                 */

                \DB::enablequerylog();
                $q_cari_info = \App\Models\InfoPenting::where('narasi', 'like', '%'.$final.'%')
                ->orWhere('judul', 'like', '%'.$final.'%')
                ->where('aktif', '1')
                ->orderByDesc('created_at')
                ->paginate(55);

                /**
                 * KATEGORI FOTO KEGIATAN
                 */
                $q_cari_foto = \App\Models\Foto_kegiatan::where('narasi', 'like', '%'.$final.'%')
                ->orWhere('judul', 'like', '%'.$final.'%')
                ->where('aktif', '1')
                ->orderByDesc('created_at')
                ->paginate(55);


                /**
                 * KATEGORI BERITA
                 */
                $q_cari_berita = \App\Models\Berita::where('narasi', 'like', '%'.$final.'%')
                ->orWhere('judul', 'like', '%'.$final.'%')
                ->where('aktif', '1')
                ->orderByDesc('created_at')
                ->paginate(55);

                return view('web.cari', [
                     'judul' => 'Hasil Pencarian di Web',
                     'result' => $q_cari_info,
                     'foto' => $q_cari_foto,
                     'berita' => $q_cari_berita,
                     'keyword' => $final ?? null,
                ]);
            }else{
                abort(404);
            }

            
            return view('web.cari', [
                'judul' => 'Hasil Pencarian di Web',
                'result' => null,
                'foto' => null,
                'keyword' => $final ?? null,
            ]);

        }else{
            return view('web.cari', [
                'judul' => 'Hasil Pencarian di Web',
                'result' => null,
                'foto' => null,
                'keyword' => null,
            ]);
        }
    }



    public function post_comment(Request $request)
    {
    	$messages = [
            'namalengkap.required' => 'masukkan nama Anda',
            'komentar.required' => 'masukkan komentar',
            'answer.required' => 'masukkan kode keamanan',
            'answer.numeric' => 'masukkan kode keamanan berupa angka',
        ];

        $validator = Validator::make($request->all(), [
            'namalengkap' => ['required','string'],
            'komentar' => ['required','string'],
            'answer' => ['required','numeric'],
            'kategori' => ['required','string'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return \Response::json([
                'error' => [
                    'namalengkap' => $errors->first('namalengkap'),
                    'komentar' => $errors->first('komentar'),
                    'answer' => $errors->first('answer'),
                    'kategori' => $errors->first('answer'),
                    'kategori' => $errors->first('kategori'),
                ]
            ]);
        }

        if( (session('angka1') + session('angka2')) != ($request->answer) )
        {
        	$angka1 = mt_rand(1,10);
        	$angka2 = mt_rand(1,10);
            session()->put('angka1', $angka1);
            session()->put('angka2', $angka2);
            return \Response::json([
                'error' => [
                    'answer' => "Jawaban kode keamanan salah !",
                ]
            ]);
        }

        \DB::beginTransaction();
        // $content_id = \Crypt::decrypt($request->content_id);
        // $kategori = \Crypt::decrypt($request->category_id);
        $id = \App\Models\Komentar::MaxId();
        $object = new \App\Models\Komentar;
        $object->id = $id;
        $object->nickname = contul($request->namalengkap);
        $object->comment = contul($request->komentar);
        $object->kategori = contul($request->kategori);
        // $object->kategori = contul($kategori);
        // $object->id_kategori = contul($content_id);
        $object->aktif = '0';

        try{
        	$object->save();
        	return \Response::json([
                'redirect' => url()->previous(),
                'status'  => 'success',
                'message'  => 'Komentar berhasil ditambahkan, menunggu untuk dipublikasi oleh Admin kami',
            ]);
            

        }catch(\Exception $e){
        	return \Response::json([
                'redirect' => null,
                'status'  => 'server_error',
                'message'  => $e->getMessage()
            ]);
        }

        
    }

    public function refresh_capcay()
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
}
