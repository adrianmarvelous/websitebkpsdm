<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class sop extends Controller
{
    //
    public function index()
    {
        $sop = DB::table('sop')->get();
        return view('web.sop.index', compact('sop'));
    }
    public function slide_show()
    {
        $sop = DB::table('sop')->get();
        return view('web.sop.slide_show', compact('sop'));
    }
}
