<?php

namespace App\Http\Controllers\Sigendis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sigendis extends Controller
{
    //
    
    public function index()
    {
    	return view('gedung_diklat.index', [
    		// 'categories' => $categories
    	]);
    }
}
