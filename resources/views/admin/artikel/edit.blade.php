@extends('admin.index')



@section('content')


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tambah Artikel</li>
                </ol>
            </div>
            <h4 class="page-title">Tambah Artikel</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    
                    @foreach ($detail as $data)
                    <div class="tab-pane show active" id="horizontal-form-preview">
                        <form id="form" class="form-horizontal" method="post" action="{{route('dashboard.artikel.update')}}" enctype="multipart/form-data">
                            {{csrf_field()}}


                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Kategori</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="kategori" id="">
                                        <option style="text-transform: capitalize" value="{{$data->kategori}}">{{$data->kategori}}</option>
                                        <option value="populer">Populer</option>
                                        <option value="ilmiah">Ilmiah</option>
                                        <option value="opini">Opini</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Judul</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="judul" value="{{$data->judul}}">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Nama</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="nama" value="{{$data->nama}}">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Jabatan</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="jabatan" value="{{$data->jabatan}}">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Unit Kerja</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="unit_kerja" value="{{$data->unit_kerja}}">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">E-mail</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="email" value="{{$data->email}}">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Telp</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="telp" value="{{$data->telp}}">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="narasi" class="col-md-3 col-form-label">Deskripsi</label>
                                <div class="col-md-9">
                                    <textarea id="narasi" name="deskripsi" class="summernote-basic">{!! $data->deskripsi !!}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="narasi" class="col-md-3 col-form-label">Tanggal</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="date" name="tanggal" value="{{date('Y-m-d',strtotime($data->tanggal))}}">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="narasi" class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="status" id="">
                                        <option value="{{$data->status}}">
                                            @if ($data->status == 1)
                                                Approve
                                            @else
                                                Tidak Approve
                                            @endif
                                        </option>
                                        <option value="1">Approve</option>
                                        <option value="0">Tidak Approve</option>
                                        <option value="-1">Tolak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="foto_utama" class="col-md-3 col-form-label">FIle Lama</label>
                                <div class="col-md-3">
                                    <a class="btn btn-info" href="{{asset('assets/artikel/'.$data->file)}}" target="_blank">View</a>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="foto_utama" class="col-md-3 col-form-label">FIle</label>
                                <div class="col-md-3">
                                    <input type="file" class="form-control" id="foto_utama" name="file" accept="application/pdf">
                                </div>
                            </div>
                            
                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-md-9">
                                    <input type="hidden" name="file_lama" value="{{$data->file}}">
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <button type="submit" id="submitform" class="btn btn-info  "><i class="uil-location-arrow"></i> <span>Simpan</span></button>
                                </div>
                            </div>
                        </form>
                        <p></p>
                    </div>

                    @endforeach

                </div> <!-- end tab-content-->

            </div>  <!-- end card-body -->
        </div>  <!-- end card -->
    </div>  <!-- end col -->

</div>
<!-- end row -->



@endsection



@section('custom_js')


@endsection