<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoPenting extends Controller
{

	public function index()
	{
		$all = \App\Models\InfoPenting::byAktif()->orderByDesc('created_at')->paginate(20);
		// dd(\DB::getquerylog());
		return view('web.info_penting.index', [
    		'all' 	=> $all,
    	]);
	}


    public function detail($slug=null)
    {
    	if(!$slug) :
    		abort('404');
    	else:
    		\DB::enablequerylog();
    		$load_content = \App\Models\InfoPenting::byAktif()->bySlug($slug)->firstOrFail();
            $load_comment = $load_content->komentar;
    		// dd(\DB::getquerylog());
    		return view('web.info_penting.detail_info_penting', [
	    		'load_content' 	=> $load_content,
                'attachment'    => $load_content->lampiran_info_penting,
	    		'komentar' 	    => $load_comment,
	    	]);

    	endif;
    }
}
