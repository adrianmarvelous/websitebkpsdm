<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HubungiKami extends Controller
{
    public function index()
    {
    	$content = \App\Models\Hubungi_kami::byAktif()->firstOrFail();
    	$load_comment = \App\Models\Komentar::byAktif()->get();
    	return view('web.hubungi_kami', [
    		'content' 		=> $content,
    		'komentar' 		=> $load_comment,
    	]);
    }



}
