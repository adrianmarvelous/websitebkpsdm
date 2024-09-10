@extends('web.index')


@section('content')


<section>
    <div class="container  py-12">
        <div class="row">
        
            <div class="col-12 col-md-12 col-lg-12 ">
                <div class="jdl-head-search">Pengajuan Artikel</div>
                    <div class="row">
                    <!-- Card -->
                        <div class="col-md-12">
                            <div class="card shadow-lg mb-2">
                            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
                            
                                <div class="card-body">
                                    <form id="form" class="form-horizontal" method="post" action="{{ route('save') }}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                    <div class="row" style="padding:50px">
                                        <table class="table table-striped" style="padding: 100px">
                                        <tr>
                                            <td>Kategori</td>
                                            <td>:</td>
                                            <td>
                                                <select class="form-control" name="kategori" id="">
                                                    <option value="populer">Populer</option>
                                                    <option value="ilmiah">Ilmiah</option>
                                                    <option value="opini">Opini</option>
                                                </select>
                                            </td>
                                        </tr>
                                        @php
                                            $td = array('Nama','Jabatan','Unit Kerja','E-Mail','Telp','Judul Artikel');
                                            $name = array('nama','jabatan','unit_kerja','email','telp','judul');
                                            $jumlah = count($td);
                                        @endphp
                                        @for ($i = 0; $i < $jumlah; $i++)
                                            <tr>
                                                <td style="width:200px">{{$td[$i]}}</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="{{$name[$i]}}">
                                                </td>
                                            </tr>
                                        @endfor
                                            <tr>
                                                <td>Deskripsi</td>
                                                <td>:</td>
                                                <td>
                                                    <textarea name="deskripsi" id="content" class="form-control ckeditor" cols="130" rows="10" style="margin-bottom:20px;"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>File</td>
                                                <td>:</td>
                                                <td><input type="file" name="file" class="form-control" accept="application/pdf"></td>
                                            </tr>
                                        </table>
                                        <div style="display: flex;justify-content:flex-end;width:100%">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>



            </div>
      </div> <!-- / .row -->
    </div> <!-- / .container -->
</section>

@endsection