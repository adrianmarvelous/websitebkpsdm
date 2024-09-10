<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InfoCpns extends Controller
{
    public function post($slug)
    {

        switch ($slug) {
            case 'jadwal_cpns':
                $title = 'Jadwal Seleksi CPNS Pemerintah Kota Surabaya TA 2024';
                $images = array(
                                'jadwal 1.jpeg',
                                'jadwal 2.jpeg',
                                'jadwal 3.jpeg',
                                'jadwal 4.jpeg',
                                'jadwal 5.jpeg',
                                'jadwal 6.jpeg',
                            );
                break;
            case 'press_release_cpns':
                $title = 'Press Release CPNS TA 2024';
                $images = array(
                                'press release 1.jpeg',
                                'press release 2.jpeg',
                                'press release 3.jpeg',
                                'press release 4.jpeg',
                                'press release 5.jpeg',
                                'press release 6.jpeg',
                            );
                break;
            
            default:
                # code...
                break;
        }

        return view('web.cpns_pppk.post',compact('slug','title','images'));
    }
}
