<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Artikel extends Controller
{
    public function populer()
    {
        $populer = DB::table('artikel')
                        ->where('kategori','populer')
                        ->where('status','1')
                        ->get();
        $kategori = 'Populer';

        return view('admin.artikel.index', compact('populer','kategori'));
    }
    public function ilmiah()
    {
        $populer = DB::table('artikel')
                        ->where('kategori','ilmiah')
                        ->where('status','1')
                        ->get();
        $kategori = 'Ilmiah';

        return view('admin.artikel.index', compact('populer','kategori'));
    }
    public function opini()
    {
        $populer = DB::table('artikel')
                        ->where('kategori','opini')
                        ->where('status','1')
                        ->get();
        $kategori = 'Opini';

        return view('admin.artikel.index', compact('populer','kategori'));
    }
    public function pengajuan()
    {
        $populer = DB::table('artikel')
                        ->where('status','<=','0')
                        ->get();
        $kategori = 'pengajuan';

        return view('admin.artikel.index', compact('populer','kategori'));
    }
    public function add()
    {
        return view('admin.artikel.add');
    }
    public function save(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");

        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $directory = 'assets/artikel/';
        
        $file->move($directory,$nama_file);

        $tgl = $request->tanggal." ".date("h:i:s");

        DB::table('artikel')->insert([
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'unit_kerja' => $request->unit_kerja,
            'email' => $request->email,
            'telp' => $request->telp,
            'tanggal' => $tgl,
            'deskripsi' => $request->deskripsi,
            'file' => $nama_file,
            'status' => $request->status
        ]);
        
        return redirect('dashboard/artikel/'.$request->kategori);
    }

    public function detail($id)
    {
        $detail = DB::table('artikel')
                        ->where('id',$id)
                        ->get();

        return view('admin.artikel.detail', compact('detail'));
    }
    public function edit($id)
    {
        $detail = DB::table('artikel')
                        ->where('id',$id)
                        ->get();

        return view('admin.artikel.edit', compact('detail'));
    }

    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        
        $tgl = $request->tanggal." ".date("h:i:s");
        
        if($request->file == ""){
            DB::table('artikel')->where('id',$request->id)
            ->update([
                'kategori' => $request->kategori,
                'judul' => $request->judul,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'unit_kerja' => $request->unit_kerja,
                'email' => $request->email,
                'telp' => $request->telp,
                'deskripsi' => $request->deskripsi,
                'tanggal' => $tgl,
                'status' => $request->status
            ]);
        }else{
            
            $file_baru = $request->file('file');
            $nama_file = time()."_".$file_baru->getClientOriginalName();
            $directory = 'assets/artikel/';

            $file_baru->move($directory,$nama_file);

            $file_path = 'assets/artikel/'.$request->file_lama;
            File::delete($file_path);

            DB::table('artikel')->where('id',$request->id)
            ->update([
                'kategori' => $request->kategori,
                'judul' => $request->judul,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'unit_kerja' => $request->unit_kerja,
                'email' => $request->email,
                'telp' => $request->telp,
                'deskripsi' => $request->deskripsi,
                'tanggal' => $tgl,
                'file' => $nama_file,
                'status' => $request->status
            ]);
        }

        return redirect('dashboard/artikel/'.$request->kategori);
        
    }

    public function delete($id)
    {
        $data = DB::table('artikel')
                        ->where('id',$id)
                        ->get();

        $file = $data[0]->file;
        $kategori = $data[0]->kategori;

        $file_path = 'assets/artikel/'.$file;
        File::delete($file_path);

        DB::table('artikel')->where('id',$id)->delete();

        return redirect('dashboard/artikel/'.$kategori);
    }
}
