<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Statis extends Controller
{
    public function index($slug)
    {
    	if(!$slug) :
    		abort('404');
    	else:
			$query_content = DB::table('lampiran_konten_web')->get();
    		
    		$load_content = \App\Models\M_konten_web::byAktif()->bySlug($slug)->firstOrFail();
    		return view('web.statis.detail_statis', [
	    		'load_content' => $load_content,
				'lampiran' => $query_content,
	    	]);

    	endif;
    }
}
