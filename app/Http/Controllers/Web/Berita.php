<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Berita extends Controller
{
    public function index()
	{
		$all = \App\Models\Berita::byAktif()->orderByDesc('created_at')->paginate(20);
		return view('web.berita.index', [
    		'all' 	=> $all,
    	]);
	}


    public function detail($slug=null)
    {
    	if(!$slug) :
    		abort('404');
    	else:
    		\DB::enablequerylog();
    		$load_content = \App\Models\Berita::byAktif()->bySlug($slug)->firstOrFail();
    		// dd(\DB::getquerylog());
    		return view('web.berita.detail_berita', [
	    		'load_content' 	=> $load_content,
                'attachment'    => $load_content->lampiran_berita,
	    	]);

    	endif;
    }
}
