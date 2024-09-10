@extends('admin.index')



@section('content')


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Detail Artikel</li>
                </ol>
            </div>
            <h4 class="page-title">Detail Artikel</h4>
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


                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Kategori</label>
                                <div class="col-md-9">
                                    <p style="text-transform: capitalize">{{$data->kategori}}</p>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Judul</label>
                                <div class="col-md-9">
                                    <p>{{$data->judul}}</p>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Nama</label>
                                <div class="col-md-9">
                                    <p>{{$data->nama}}</p>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Jabatan</label>
                                <div class="col-md-9">
                                    <p>{{$data->jabatan}}</p>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Unit Kerja</label>
                                <div class="col-md-9">
                                    <p>{{$data->unit_kerja}}</p>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">E-mail</label>
                                <div class="col-md-9">
                                    <p>{{$data->email}}</p>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Telp</label>
                                <div class="col-md-9">
                                    <p>{{$data->telp}}</p>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="narasi" class="col-md-3 col-form-label">Deskripsi</label>
                                <div class="col-md-9">
                                    <p>{!! $data->deskripsi !!}</p>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="narasi" class="col-md-3 col-form-label">Tanggal</label>
                                <div class="col-md-9">
                                    <p>{{tanggal_hari('D, j M Y',$data->tanggal)}}</p>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="foto_utama" class="col-md-3 col-form-label">FIle</label>
                                <div class="col-md-3">
                                    <a class="btn btn-primary" href="{{asset('assets/artikel/'.$data->file)}}" target="_blank">View</a>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="foto_utama" class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-3">
                                        @if ($data->status == '1')
                                            <p style="color:green">Publish</p>
                                        @else
                                            <p style="color: red">Belum Publish</p>
                                        @endif
                                </div>
                            </div>

                            <div style="display: flex;justify-content:space-between">
                                <a href="/dashboard/artikel/edit/{{$data->id}}" class="btn btn-info  "><i class="uil-location-arrow"></i> <span>Edit</span></a>
                                <a class="btn btn-danger" href="/dashboard/artikel/delete/{{$data->id}}">Hapus</a>
                            </div>
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