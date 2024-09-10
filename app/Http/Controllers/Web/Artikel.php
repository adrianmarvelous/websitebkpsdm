<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Artikel extends Controller
{
    public function index()
    {
        return view('web.artikel.index');
    }

    public function populer()
    {
        $data = DB::table('artikel')
                    ->where('kategori','populer')
                    ->where('status','1')
                    ->paginate(20);
        $kategori = 'populer';

        return view('web.artikel.list', compact('data','kategori'));
    }
    public function ilmiah()
    {
        $data = DB::table('artikel')
                    ->where('kategori','ilmiah')
                    ->where('status','1')
                    ->paginate(20);
        $kategori = 'ilmiah';

        return view('web.artikel.list', compact('data','kategori'));
    }
    public function opini()
    {
        $data = DB::table('artikel')
                    ->where('kategori','opini')
                    ->where('status','1')
                    ->paginate(20);
        $kategori = 'opini';

        return view('web.artikel.list', compact('data','kategori'));
    }
    public function detail($id)
    {
        $data = DB::table('artikel')
                        ->where('id',$id)
                        ->get();
        $kategori = $data[0]->kategori;
        return view('web.artikel.detail', compact('data','kategori'));
    }

    public function pengajuan()
    {
        return view('web.artikel.pengajuan');
    }

    public function save(Request $request)
    {

        date_default_timezone_set("Asia/Bangkok");

        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $directory = 'assets/artikel/';
        
        $file->move($directory,$nama_file);
        
        $tgl_skg = date('Y-m-d H:i:s');

        DB::table('artikel')->insert([
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'tanggal' => $tgl_skg,
            'deskripsi' => $request->deskripsi,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'unit_kerja' => $request->unit_kerja,
            'email' => $request->email,
            'telp' => $request->telp,
            'file' => $nama_file,
            'status' => '0'
        ]);
        
        $status = "Artikel Berhasil di Submit";

        return redirect()->route('index')->with(['status' => $status]);
    }
}
