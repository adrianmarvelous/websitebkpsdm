<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pembinaan extends Controller
{
    public function detail($slug=null)
    {
    	if(!$slug) :
    		abort('404');
    	else:
            // switch($slug){
            //     case 'etika-bermedsos':
            //         $video = 'etika bermedsos.mp4';
            //         $judul = 'Etika Bermedsos';
            //         break;
            //     case 'anti-narkoba':
            //         $video = 'anti narkoba.mp4';
            //         $judul = 'Anti Narkoba';
            //         break;
            //     case 'dasar-hukum-jam-kerja':
            //         $video = 'Dasar Hukum Jam Kerja ASN di Lingkungan Pemerintah Kota Surabaya.mp4';
            //         $judul = 'Dasar Hukum Jam Kerja ASN di Lingkungan Pemerintah Kota Surabaya';
            //         break;
            //     case 'gratifikasi':
            //         $video = 'gratifikasi.mp4';
            //         $judul = 'Tolak Gratifikasi';
            //         break;
            //     case 'surabaya-shoping-festival':
            //         $video = 'ssf.mp4';
            //         $judul = 'Surabaya Shopping Festival';
            //         break;
            //     case 'pedoman-pakaian-dinas':
            //         $video = 'Pedoman Pakaian Dinas Pemkot Surabaya.mp4';
            //         $judul = 'Pedoman Pakaian Dinas';
            //         break;
            // }
            
    		// return view('web.pembinaan.detail_animasi', ['animasi' => $video,'judul' => $judul]);
            $animasi = DB::table('animasi')
                            ->where('slug',$slug)
                            ->first();
            
    		return view('web.pembinaan.detail_animasi', ['animasi' => $animasi]);
        endif;
    }
}
