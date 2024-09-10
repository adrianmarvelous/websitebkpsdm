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
                        <form id="form" class="form-horizontal" method="post" action="{{route('dashboard.slider.update')}}">



                            <div class="form-group row mb-3">
                                <label for="judul" class="col-md-3 col-form-label">Caption / Keterangan</label>
                                <div class="col-md-9">
                                    <input type="hidden" value="{{$old_data->id}}" name="id">
                                    <input type="text" autocomplete="off" class="form-control" value="{{sanitizeString($old_data->judul)}}" id="judul" name="judul">
                                </div>
                            </div>


                            <div class="form-group row mb-3">
                                <label for="foto" class="col-md-3 col-form-label">Foto Utama</label>
                                <div class="col-md-4">
                                    <input type="file" class="form-control" id="foto" name="foto">
                                    <span class="text-danger">Foto disarankan memiliki resolusi panjang : 928 x tinggi: 620 (pixel)</span>
                                </div>
                            </div>
                            @if($old_data->foto)
                            <div class="form-group row mb-3">
                                <label for="foto" class="col-md-3 col-form-label"></label>
                                <div class="col-md-3">
                                    <img width="100%" src="{{asset('storage/'.$old_data->foto)}}" />
                                </div>
                            </div>
                            @endif

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
                                    <a class="btn btn-light" href="{{route('dashboard.slider')}}"><i class="uil-backward"></i> Kembali</a>
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


<script>


//Aksi simpan & update form
$(document).ready(function(){
    $("#submitform").click(function(){
        $(".text-danger").remove();
        event.preventDefault();
        var data = new FormData($('#form')[0]);
        $("#submitform").attr('disabled', true);
        $("#submitform span").text('Mohon tunggu...');

        $.ajax({
            url:"{{ route("dashboard.slider.update") }}",
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




});
</script>


@endsection