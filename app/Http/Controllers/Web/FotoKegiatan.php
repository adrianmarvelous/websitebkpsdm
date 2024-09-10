<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FotoKegiatan extends Controller
{
    public function index()
	{
		$all = \App\Models\Foto_kegiatan::byAktif()->orderByDesc('created_at')->paginate(18);
		// $sampul = $all->isi_album->first();
		// dd(\DB::getquerylog());
		return view('web.foto_kegiatan.index', [
    		'all' 	=> $all,
    		// 'sampul'=> $sampul,
    	]);
	}


    public function detail($slug=null)
    {
    	if(!$slug) :
    		abort('404');
    	else:
    		$load_content = \App\Models\Foto_kegiatan::byAktif()->bySlug($slug)->firstOrFail();
            $load_comment = $load_content->komentar;
    		return view('web.foto_kegiatan.detail', [
	    		'load_content' 	        => $load_content,
                'attachment'            => $load_content->isi_album,
	    		'attachment_foto' 	    => $load_content->isi_album->where('tipe', 'foto'),
                'komentar'              => $load_comment,
	    	]);

    	endif;
    }
}
