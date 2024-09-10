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
                    

                    <div class="tab-pane show active" id="horizontal-form-preview">
                        <form id="form" class="form-horizontal" method="post" action="{{route('dashboard.artikel.save')}}" enctype="multipart/form-data">
                            {{csrf_field()}}


                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Kategori</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="kategori" id="">
                                        <option value="populer">Populer</option>
                                        <option value="ilmiah">Ilmiah</option>
                                        <option value="opini">Opini</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Nama</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="nama" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Jabatan</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="jabatan" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Unit Kerja</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="unit_kerja" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Telp</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="telp" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">E-mail</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="email" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Judul</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="judul" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="narasi" class="col-md-3 col-form-label">Deskripsi</label>
                                <div class="col-md-9">
                                    <textarea id="narasi" name="deskripsi" class="summernote-basic" required></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="narasi" class="col-md-3 col-form-label">Tanggal</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="date" name="tanggal" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="foto_utama" class="col-md-3 col-form-label">File</label>
                                <div class="col-md-3">
                                    <input type="file" class="form-control" id="foto_utama" name="file" accept="application/pdf" required>
                                </div>
                            </div>
                            

                            <div class="form-group row mb-3">
                                <label for="foto_utama" class="col-md-3 col-form-label">Tampilkan</label>
                                <div class="col-md-3">
                                    <select class="form-control" name="status" id="">
                                        <option value="1">IYA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-md-9">
                                    <button type="submit" id="submitform" class="btn btn-info  "><i class="uil-location-arrow"></i> <span>Simpan</span></button>
                                </div>
                            </div>
                        </form>
                        <p></p>
                    </div>


                </div> <!-- end tab-content-->

            </div>  <!-- end card-body -->
        </div>  <!-- end card -->
    </div>  <!-- end col -->

</div>
<!-- end row -->



@endsection



@section('custom_js')


@endsection