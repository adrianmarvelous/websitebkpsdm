<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Link_contact extends Controller
{
    public function index()
    {
    	$content = \App\Models\Hubungi_kami::byAktif()->firstOrFail();
    	$load_comment = \App\Models\Komentar::byAktif()->where('kategori', 'PPPK')->get();
    	return view('web.pengumuman.link_contact', [
    		'content' 		=> $content,
    		'komentar' 		=> $load_comment,
    	]);
    }
}
