<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Rules\SafeInput;

class AnimasiHome extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animasi = DB::table('animasi')
                        ->orderBy('created_at','desc')
                        ->get();

        return view('admin.animasi.index',['animasi' => $animasi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.animasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', new SafeInput],
            'file' => ['required','mimes:mp4','max:20480', new SafeInput],
            'aktif' => ['required', new SafeInput],
        ]);

        $judul = $validated['judul'];
        $slug = contul(Str::slug($validated['judul'] . ' ' . time()));
        $created_at = date('Y-m-d H:i:s'); // Use Carbon's now() method to get current timestamp

        // Get the uploaded file
        $file = $request->file('file');
        $nama_file = $judul . ' - ' . time() . '.' . 'mp4'; // Generate unique file name

        // Move the uploaded file to storage
        $file->storeAs('public/animasi', $nama_file);

        DB::table('animasi')->insert([
            'judul' => $judul,
            'slug' => $slug,
            'file' => $nama_file,
            'created_at' => $created_at,
            'aktif' => $validated['aktif']
        ]);

        return redirect()->route('dashboard.animasi.index')->with('success', 'Data uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animasi = DB::table('animasi')
                        ->where('id',$id)
                        ->first();

        return view('admin.animasi.create',['animasi' => $animasi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => ['required', new SafeInput],
            'file' => ['nullable','mimes:mp4','max:20480', new SafeInput],
            'aktif' => ['required', new SafeInput]
        ]);

        $slug = contul(Str::slug($validated['judul'] . ' ' . time()));
        $updated_at =  date('Y-m-d H:i:s');

        if(!isset($validated['file'])){
            DB::table('animasi')->where('id',$id)->update([
                'judul' => $validated['judul'],
                'aktif' => $validated['aktif'],
                'slug' => $slug,
                'updated_at' => $updated_at,
            ]);
        }else{

            $file_lama = DB::table('animasi')->where('id',$id)->value('file');
            // Delete the file
            Storage::delete('public/animasi/' . $file_lama);

            // Get the uploaded file
            $file = $request->file('file');
            $nama_file = $validated['judul'] . ' - ' . time() . '.' . 'mp4'; // Generate unique file name

            // Move the uploaded file to storage
            $file->storeAs('public/animasi', $nama_file);

            DB::table('animasi')->where('id',$id)->update([
                'judul' => $validated['judul'],
                'aktif' => $validated['aktif'],
                'slug' => $slug,
                'file' => $nama_file,
                'updated_at' => $updated_at,
            ]);
        }

        return redirect()->route('dashboard.animasi.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file_lama = DB::table('animasi')->where('id',$id)->value('file');
        // Delete the file
        Storage::delete('public/animasi/' . $file_lama);


        DB::table('animasi')->where('id', $id)->delete();
        return redirect()->route('dashboard.animasi.index')->with('success', 'Data deleted successfully.');
    }
}
