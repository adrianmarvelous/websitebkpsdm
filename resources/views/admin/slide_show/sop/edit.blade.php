@extends('admin.index')



@section('content')


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tambah SOP Baru</li>
                </ol>
            </div>
            <h4 class="page-title">Tambah SOP Baru</h4>
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
                        <form id="form" class="form-horizontal" method="post" action="{{route('dashboard.sop.update')}}" enctype="multipart/form-data">
                            {{csrf_field()}}

                            @foreach ($sop as $item)
                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Judul SOP</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="judul" name="judul" value="{{$item->judul}}">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="foto_utama" class="col-md-3 col-form-label">File SOP Baru</label>
                                <div class="col-md-3">
                                    <input type="file" class="form-control" id="foto_utama" name="file" accept="aplication.pdf">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="foto_utama" class="col-md-3 col-form-label">File SOP Lama</label>
                                <div class="col-md-3">
                                    <a class="btn btn-primary" href="{{asset('assets/slide_show/sop/'.$item->file)}}" target="_blank">View</a>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="aktif" class="col-md-3 col-form-label">Tampilkan</label>
                                <div class="col-md-2">
                                    <select class="form-control" name="aktif" id="aktif">
                                        <option value="1" {{($item->aktif=='1') ? 'selected' : ''}} >YA</option>
                                        <option value="0" {{($item->aktif!='1') ? 'selected' : ''}}>TIDAK</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-md-9">
                                    <button type="submit" id="submitform" class="btn btn-info  "><i class="uil-location-arrow"></i> <span>Simpan</span></button> 
                                    <a class="btn btn-light" href=""><i class="uil-backward"></i> Kembali</a>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$item->id}}">
                            @endforeach
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