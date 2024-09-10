@extends('web.index')


@section('content')


<section>
      <div class="container  pt-13">
        <div class="row">
          
          <div class="col-12 col-md-12 col-lg-12 ">
            
            <!-- Card -->
            <div class="card shadow ">
            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
              <div class="card-body">
                
                <!-- List group -->
                  
                    
                    <!-- Text -->
                    <div class="mr-auto">
                        <div class="container">
                          <form method="post" class="form" id="form">
                          <h1>Pertanyaan Terkait PPPK Pemerintah Kota Surabaya 2023</h1>
                          <div style="display: flex;flex-direction:column;">
                            <a href="https://sscasn.bkn.go.id/" style="color: black"><i class="fa fa-globe"></i> Website SSASN</a>
                            <a><i class="fa fa-phone"></i> (031) 5466484</a>
                            <a><i class="fa fa-instagram"></i> bkpsdmsurabaya</a>
                            <a href=""  style="color: black"><i class="fa fa-whatsapp"></i> +62-822-4411-1345</a>
                            <br>
                            {{-- <p class="label-qna">Nama Lengkap</p>
                            <input class="form-control" name="namalengkap" id="namalengkap" />
                            <br>
                            <label class="form-label label-qna">Pertanyaan</label>
                            <textarea rows="7" name="komentar" id="komentar" class="form-control"></textarea>
                            @php
                            $angka1 = mt_rand(1,10) ?? null;
                            $angka2 = mt_rand(1,10) ?? null;
  
                            session()->put('angka1', $angka1);
                            session()->put('angka2', $angka2);
                            @endphp
                            <div class="row form-group">
                                <label class="form-label"> 
                                    <h4 ><strong class="text-success" id="teks_penjumlahan">{{$angka1}} + {{$angka2}}</strong></h4>
                                    <a id="refresh_capcay" href="javascript:void(0)">Refresh Kode</a>
                                </label>
                                <input autocomplete="off" class="form-control" type="text" name="answer" id="answer" required="" placeholder="Jawaban Pertanyaan Keamanan">
                            </div>
                            <div class="row form-group">
                                <input type="hidden" name="kategori" value="PPPK">
                                <button id="submitform" name="submitform" class="btn btn-lg btn-success">Kirim Komentar</button>
                            </div> --}}
                          </div>
                          </form>
                        </div>
                    </div>

              </div>
            </div>


          </div>
        </div> 
        
      <div class="container mb-6 pt-5">
        @forelse($komentar as $comment)
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12 ">
            
            <!-- Card -->
            <div class="card shadow mb-2">
            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
              {{-- <div class="card-body">
                  <div class=""><strong>Pengirim : {{$comment->nickname}}</strong></div>
                  <br>
                  <div class="alert alert-secondary">
                    <strong>Pertanyaan :</strong> <br>
                    {{$comment->comment}}
                    <p></p>
                    @if($comment->respon_admin!='')
                    <strong>Tanggapan :</strong> <br>
                    {{$comment->respon_admin}}
                    @endif
                  </div>
              </div> --}}
            </div>
          </div>
        </div>
        @empty
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12 ">
            
            <!-- Card -->
            <div class="card shadow mb-2">
            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
              <div class="card-body">
                  Belum ada komentar untuk postingan ini
              </div>
            </div>
          </div>
        </div>
        @endforelse
      </div> 



    </section>



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
            url:"{{ route("post_comment") }}",
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
                            title: "Berhasil Menyimpan Data !",
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

                    refresh_capcay();
                    
                }
            },
            error: function(data){
                swal.fire("Telah terjadi kesalahan pada sistem", data.message, "error");
                $("#submitform").removeAttr('disabled');
                $("#submitform span").text('Simpan');
            }
        });
    });

});

function refresh_capcay()
{
  $.ajax({
      url:"{{ route("refresh_capcay") }}",
      method:"POST",
      headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
      dataType: 'json',
      processData: false,
      contentType: false,
      success:function(data)
      {
          $('#angka1').val(data.angka1);
          $('#angka2').val(data.angka2);
          $('#answer').val('');
          $('#teks_penjumlahan').html(data.angka1 +' + '+ data.angka2);
      }
  });
}

$("#refresh_capcay").click(function(){
    refresh_capcay();
});
</script>


@endsection

