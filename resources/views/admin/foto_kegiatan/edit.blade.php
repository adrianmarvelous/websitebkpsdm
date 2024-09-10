@extends('admin.index')



@section('content')


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{$judul}}</li>
                </ol>
            </div>
            <h4 class="page-title">{{$judul}}</h4>
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
                        <form id="form" class="form-horizontal" method="post" action="{{route('dashboard.foto-kegiatan.update')}}">



                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Judul Album</label>
                                <div class="col-md-9">
                                    <input type="hidden" value="{{$old_data->id}}" name="id">
                                    <input type="text" autocomplete="off" class="form-control" value="{{sanitizeString($old_data->judul)}}" id="judul" name="judul">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="narasi" class="col-md-3 col-form-label">Deskripsi tentang album</label>
                                <div class="col-md-9">
                                    <textarea id="narasi" name="narasi" class="summernote-basic">{{sanitizeString($old_data->narasi)}}</textarea>
                                </div>
                            </div>


                            <div class="form-group row mb-3">
                                <label for="aktif" class="col-md-3 col-form-label">Tampilkan</label>
                                <div class="col-md-2">
                                    <select class="form-control" name="aktif" id="aktif">
                                        <option value="1" {{($old_data->aktif=='1') ? 'selected' : ''}} >YA</option>
                                        <option value="0" {{($old_data->aktif!='1') ? 'selected' : ''}}>TIDAK</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-md-9">
                                    <button type="submit" id="submitform" class="btn btn-info  "><i class="uil-location-arrow"></i> <span>Simpan</span></button> 
                                    <a class="btn btn-light" href="{{route('dashboard.foto-kegiatan')}}"><i class="uil-backward"></i> Kembali</a>
                                </div>
                            </div>
                        </form>
                        <p></p>
                    </div>


                </div> <!-- end tab-content-->

            </div>  <!-- end card-body -->
        </div>  <!-- end card -->













        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    

                    <div class="tab-pane show active" id="horizontal-form-preview">
                        <form id="form_lampiran" class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('dashboard.foto-kegiatan.upload')}}">
                            <h4 class="text-success">Upload Foto / Video ke Album ini</h4>
                            <input type="hidden" value="{{$old_data->id}}" name="id" id="id_foto_kegiatan">

                            <div class="form-group row mb-3">
                                <label for="deskripsi" class="col-md-3 col-form-label">Tentang Foto / Video ini</label>
                                <div class="col-md-9">
                                    <input type="text" autocomplete="off" class="form-control" id="deskripsi" name="deskripsi">
                                </div>
                            </div>


                            <div class="form-group row mb-3">
                                <label for="tipe" class="col-md-3 col-form-label">Tipe File</label>
                                <div class="col-md-2">
                                    <select class="form-control" name="tipe" id="tipe">
                                        <option value=""  >-- pilih --</option>
                                        <option value="foto">Foto</option>
                                        <option value="video" >Video</option>
                                    </select>
                                </div>
                            </div>

                        

                            <div class="form-group row mb-3">
                                <label for="file_lampiran" class="col-md-3 col-form-label">File Foto / Video <br><span class="text-danger">(sesuai pilihan tipe file di atas)</span></label>
                                <div class="col-md-3">
                                    <input type="file" required="" class="form-control" id="file_lampiran" name="file_lampiran" accept="image/jpeg, image/jpg, image/png, video/mp4">
                                </div>
                            </div>

                            <div id="div_file_thumbnail" style="display: none;" class="form-group row mb-3">
                                <label for="file_thumbnail" class="col-md-3 col-form-label">File Thumbnail Video <br><span class="text-danger">(harus berupa gambar)</span></label>
                                <div class="col-md-3">
                                    <input type="file" required="" class="form-control" id="file_thumbnail" name="file_thumbnail" accept="image/jpeg, image/jpg, image/png">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="" class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">
                                    <div class="alert alert-info"> Untuk video, batas maksimal upload adalah 8MB dengan ekstensi *.webm atau *.mp4</div>
                                </div>
                            </div>
                        
                            
                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-md-9">
                                    <button type="submit" id="submitupload" class="btn btn-success"><i class="uil-location-arrow"></i> <span>Upload Lampiran</span></button> 
                                </div>
                            </div>
                        </form>
                        <p></p>
                    </div>


                </div> <!-- end tab-content-->

            </div>  <!-- end card-body -->
        </div>  <!-- end card -->




        <div class="card">
            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane show active" id="horizontal-form-preview">

                        <h4 class="text-success">Isi Album Kegiatan</h4>

                        <table class="table table-info table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Deskripsi</th>
                                    <th>Dibuat</th>
                                    <th>Tipe Berkas</th>
                                    <th>Preview</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @forelse ($lampiran as $row)
                                    <tr>
                                        <td>{{$i++}}.</td>
                                        <td>{{$row->deskripsi}}</td>
                                        <td>{{date('d-m-Y H:i:s',strtotime($row->created_at))}}</td>
                                        <td>{{$row->tipe}}</td>
                                        <td><a target="_blank" href="{{asset('storage/'.$row->file_lampiran)}}" class="btn btn-sm btn-success">lihat file</a></td>
                                        <td><a href="#" onclick="delete_lampiran('{{$row->id}}')" class="btn btn-sm btn-danger">hapus</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>  <!-- end col -->

</div>
<!-- end row -->



@endsection



@section('custom_js')


<script>
$('#tipe').change(function(){
    if($('#tipe').val()== 'foto'){
        $('#div_file_thumbnail').slideUp('slow');
    }
    if($('#tipe').val()== 'video'){
        $('#div_file_thumbnail').slideDown('slow');
    }
});

function delete_lampiran(id)
{
    var id = id;
    var id_foto_kegiatan = $('#id_foto_kegiatan').val();
    swal.fire({
        title: 'Hapus File ?',
        text: 'Apakah Anda yakin menghapus file ini ?',
        icon: 'warning',
        showCancelButton: !0,
        confirmButtonText: 'Ya !',
        cancelButtonText: 'Batal',
        reverseButtons: !0
    }).then(function (e) {
        if(e.value){
            $.ajax({
            url:'{{route('dashboard.foto-kegiatan.hapus_lampiran')}}',
            method:'post',
            headers: { 'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content') },
            data:{id_foto_kegiatan:id_foto_kegiatan,id_lampiran:id},
            success:function(data)
                {
                    swal.fire({
                        title: "Sukses",
                        text: data.message,
                        icon: "success"
                    }).then(function() {
                        location.href = data.redirect;
                    });
                }
            });
        }else{
            return false;
        }
    })
}


//Aksi simpan & update form
$(document).ready(function(){
    $("#submitform").click(function(){
        $(".text-danger").remove();
        event.preventDefault();
        var data = new FormData($('#form')[0]);
        $("#submitform").attr('disabled', true);
        $("#submitform span").text('Mohon tunggu...');

        $.ajax({
            url:"{{ route("dashboard.foto-kegiatan.update") }}",
            method:"POST",
            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            success:function(data)
            {
                if($.isEmptyObject(data.error)){

                    if(data.status == "error_server"){
                        $("#submitform").removeAttr('disabled');
                        $("#submitform span").text('Simpan');
                        swal.fire("Terjadi kesalahan server !", data.message, "error");
                    }
                    
                    if(data.status == "success"){
                        $("#submitform").removeAttr('disabled');
                        $("#submitform span").text('Simpan');
                        $("form").each(function() { this.reset() });
                        swal.fire({
                            title: "Sukses",
                            text: data.message,
                            icon: "success"
                        }).then(function() {
                            location.href = data.redirect;
                        });
                    }

                }else{
                    swal.fire("Terjadi kesalahan input!", "cek kembali inputan anda", "warning");
                    $("#submitform").removeAttr('disabled');
                    $("#submitform span").text('Simpan');
                    $.each(data.error, function(key, value) {
                        var element = $("#" + key);
                        element.closest("div.form-control")
                        .removeClass("text-danger")
                        .addClass(value.length > 0 ? "text-danger" : "")
                        .find("#error_" + key).remove();
                        element.after("<div id=error_"+ key + " class=text-danger>" + value + "</div>");
                    });
                }
            },
            error: function(){
                swal.fire("Telah terjadi kesalahan pada sistem", "Mohon refresh halaman browser Anda", "error");
                $("#submitform").removeAttr('disabled');
                $("#submitform span").text('Simpan');
            }
        });
    });



    $("#submitupload").click(function(){
        $(".text-danger").remove();
        event.preventDefault();
        var data = new FormData($('#form_lampiran')[0]);
        $("#submitupload").attr('disabled', true);
        $("#submitupload span").text('Mohon tunggu...');

        $.ajax({
            url:"{{ route("dashboard.foto-kegiatan.upload") }}",
            method:"POST",
            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            success:function(data)
            {
                if($.isEmptyObject(data.error)){

                    if(data.status == "error_server"){
                        $("#submitupload").removeAttr('disabled');
                        $("#submitupload span").text('Simpan');
                        swal.fire("Terjadi kesalahan server !", data.message, "error");
                    }
                    
                    if(data.status == "success"){
                        $("#submitupload").removeAttr('disabled');
                        $("#submitupload span").text('Simpan');
                        $("#form_lampiran").each(function() { this.reset() });
                        swal.fire({
                            title: "Sukses",
                            text: data.message,
                            icon: "success"
                        }).then(function() {
                            location.href = data.redirect;
                        });
                    }

                }else{
                    swal.fire("Terjadi kesalahan input!", "cek kembali inputan anda", "warning");
                    $("#submitupload").removeAttr('disabled');
                    $("#submitupload span").text('Simpan');
                    $.each(data.error, function(key, value) {
                        var element = $("#" + key);
                        element.closest("div.form-control")
                        .removeClass("text-danger")
                        .addClass(value.length > 0 ? "text-danger" : "")
                        .find("#error_" + key).remove();
                        element.after("<div id=error_"+ key + " class=text-danger>" + value + "</div>");
                    });
                }
            },
            error: function(){
                swal.fire("Telah terjadi kesalahan pada sistem", "Mohon refresh halaman browser Anda", "error");
                $("#submitupload").removeAttr('disabled');
                $("#submitupload span").text('Simpan');
            }
        });
    });

});
</script>


@endsection