<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class maklumat extends Controller
{
    //
    public function maklumat()
    {
        return view('web.maklumat.view');
    }
    public function skm()
    {
        return view('web.maklumat.skm');
    }
}
