<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Rules\SafeInput;

class sop extends Controller
{
    public function index()
    {
        $sop = DB::table('sop')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.slide_show.sop.index', compact('sop'));
    }

    public function add()
    {
    	return view('admin.slide_show.sop.add');
    }

    public function save(Request $request)
    {
        $messages = [
            'judul.required' => 'harus diisi',
            'aktif.required' => 'harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'judul' => ['required',new SafeInput],
            'aktif' => ['required',new SafeInput],
            'file' => ['required', 'mimes:pdf']
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'judul' => $errors->first('judul'),
                'aktif' => $errors->first('aktif'),
                'file' => $errors->first('file')
            ]
            ]);
        }

        $request->judul;
        $request->aktif;
        $file = $request->file('file');
        $nama_file = 'SOP_' . time() . '.pdf';
        $directory = 'assets/slide_show/sop';

        $file->move($directory,$nama_file);

        date_default_timezone_set("Asia/Bangkok");
        $date_now = date('Y-m-d H:i:s');
        DB::table('sop')->insert([
            'judul' => $request->judul,
            'file' => $nama_file,
            'created_at' => $date_now,
            'aktif' => $request->aktif,
        ]);

        return redirect('dashboard/sop');
    }

    public function edit($id)
    {
        $sop = Db::table('sop')->where('id',$id)->get();
        return view('admin.slide_show.sop.edit',['sop' => $sop]);
    }
    public function update(Request $request)
    {
        $messages = [
            'judul.required' => 'harus diisi',
            'aktif.required' => 'harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'judul' => ['required',new SafeInput],
            'aktif' => ['required',new SafeInput],
            'file' => ['required', 'mimes:pdf']
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'judul' => $errors->first('judul'),
                'aktif' => $errors->first('aktif'),
                'file' => $errors->first('file')
            ]
            ]);
        }
        $sop = Db::table('sop')->where('id',$request->id)->get();
        
        $file = $sop[0]->file;
        $filePath = 'assets/slide_show/sop/'.$file;

        date_default_timezone_set("Asia/Bangkok");
        $date_now = date('Y-m-d H:i:s');

        if($request->file == ""){
            DB::table('sop')->where('id',$request->id)->update([
                'judul' => $request->judul,
                'created_at' => $date_now,
                'aktif' => $request->aktif,
            ]);
        }else{
            $file_baru = $request->file('file');
            $nama_file = 'SOP_' . time() . '.pdf';
            $directory = 'assets/slide_show/sop';

            $file_baru->move($directory,$nama_file);

            DB::table('sop')->where('id',$request->id)->update([
                'judul' => $request->judul,
                'file' => $nama_file,
                'created_at' => $date_now,
                'aktif' => $request->aktif,
            ]);

            
            File::delete($filePath);
        }
        return redirect('dashboard/sop');
    }

    public function hapus($id)
    {
        $sop = Db::table('sop')->where('id',$id)->get();

        $file = $sop[0]->file;
        $filePath = 'assets/slide_show/sop/'.$file;

        File::delete($filePath);
        
        DB::table('sop')->where('id',$id)->delete();
        return redirect('dashboard/sop');
    }

    public function slide_show()
    {
        $sop = DB::table('sop')->get();
        return view('admin.slide_show.sop.slide_show', compact('sop'));
    }
    public function index_slide_show()
    {
        $sop = DB::table('sop')->get();
        return view('admin.slide_show.sop.index_slide_show', compact('sop'));
    }
}
