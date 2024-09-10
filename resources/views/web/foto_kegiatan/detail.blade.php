@extends('web.index')


@section('custom_css')
<style>
  .imghover span {
      display:none;
  }
  .imghover:hover span {
    display:block;
    position:fixed;
    overflow:hidden;
  }
</style>
@endsection

@section('content')
<link rel="stylesheet" href="{{asset('assets/plugins/ekko-lightbox')}}/ekko-lightbox.css" />


<section>
      <div class="container pt-13 mb-5">
        <div class="row">
          
          <div class="col-12 col-md-12 col-lg-12 ">
            
            <!-- Card -->
            <div class="card shadow ">
            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
              <div class="card-body">
         
                    <!-- Text -->
                    <div class="mr-auto pt-2 pb-0">
                      {{-- <ul class="breadcrumb">
                        <li><a href="{{route('index_web')}}">HOME</a></li>
                        <li><a href="{{route('foto-kegiatan.index')}}">KEGIATAN</a></li>
                      </ul> --}}
                      <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{route('index_web')}}">HOME</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><a href="{{route('foto-kegiatan.index')}}">FOTO KEGIATAN</a></li>
                        </ol>
                      </nav>


                      <h2 class="font-weight-bold mb-1">
                        {{sanitizeString($load_content->judul) ?? 'Judul belum ada'}}
                      </h2>

                      <small class="text-danger">
<svg class="bi" width="18" height="18" fill="#007bff">
                            <use xlink:href="{{asset('assets')}}/icons/bootstrap-icons.svg#calendar-check"/>
                          </svg>
                        {{tanggal_hari('D, j M Y',$load_content->created_at)}}</small>

                      <!-- Text -->
                      <p style="text-align: justify;" class="font-size-sm mb-0 mt-4">
                        {!!sanitizeString($load_content->narasi) ?? 'Konten untuk halaman ini belum tersedia'!!}
                      </p>
                    </div>
                      
            <p></p>
            <br>
            <br>

            <div class="row mousefollow">
              @php
                  $i=1;
              @endphp
            @forelse($attachment as $row)
              <div class="col-md-4">
                <div class="card mb-1">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-12 ">
                            
                              @if($row->file_lampiran)
                                @if($row->tipe == 'foto')
                                <a class="imghover"  data-imgurl="{{asset('storage/'.$row->file_lampiran)}}" data-toggle="lightbox" data-title="{{$load_content->judul}}" data-footer="{{$row->deskripsi}}" data-gallery="gallery" href="{{asset('storage/'.$row->file_lampiran)}}" >
                                    <img width="100%" title="{{$row->deskripsi}}" height="230" src="{{asset('storage/'.$row->file_lampiran)}}" />
                                    {{--<span id="tooltip-span_{{$row->id}}">
                                      <img title="{{$row->deskripsi}}" src="{{asset('storage/'.$row->file_lampiran)}}" />
                                    </span>--}}
                                </a>
                                @elseif($row->tipe == 'video')
                                <video class=" video-js vjs-default-skin" poster="{{asset('storage/'.$row->file_thumbnail)}}" preload="auto" controls="controls" width="300" height="230" data-setup="" style="cursor: pointer;">
                                  <source src="{{asset('storage/'.$row->file_lampiran)}}" type="video/mp4">
                                </video>
                                @endif
                              @else
                                  <img src="{{asset('assets/images/no-image-available.png')}}" width="100%">
                              @endif
                            
                          </div>
                          <div class="col-md-12">
                            @if ($i == 1)
                              <a href="#">{{sanitizeString($row->deskripsi)}}</a>
                            @endif
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                @php
                    $i++;
                @endphp
            @empty
            <div class="col-md-12">
              <div class="text-danger">Belum ada unggahan foto di dalam album ini</div>
              </div>
            @endforelse



            </div>
            <br>
            <br>
            <br>

            </div>  
            </div>  



          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
      




    </section>

  


@endsection




@section('custom_js')

<script src="{{asset('assets/plugins/ekko-lightbox')}}/ekko-lightbox.min.js"></script>

<script>
  {{--
  @foreach($attachment_foto as $row)
    
    var tooltipSpan_{{$row->id}} = document.getElementById('tooltip-span_{{$row->id}}');
    window.onmousemove = function (e) {
        var x = e.clientX,
            y = e.clientY;
        tooltipSpan_{{$row->id}}.style.top = (y + 20) + 'px';
        tooltipSpan_{{$row->id}}.style.left = (x + 20) + 'px';
    };

  @endforeach
  --}}


    $(function(){
      $('.mousefollow a').each(function(index, el) {
        var imgUrl = $(el).data('imgurl');
        $(el).mousefollow({
          html: '<img src="'+imgUrl+'" alt="">'
        });
      });
    });
</script>


<script>
var boxHovered, boxNumber, selector, targetedBox, adjustX, adjustY;
  $(".popup").hide();//This hides all the pop-ups when page loads
  $(".box").hover(function(){//This executes when you hover ON the box
     boxHovered = $(this).attr("id");//Gets the id of the box such as "box1", "box2"
     targetedBox = "#" + boxHovered;//creates a value of "#box1", "#box2", etc for future use
     boxNumber = boxHovered.substr(3,5);//extracts the # from the id, such as 1, 2, 3
     selector = "#popup"+boxNumber;//creates a value of "#popup1", "#popup2", etc for future use
     $(selector).show();//This reveals the popup inside the hovered box
     moveBox();//This calls on the function below to execute
  },function(){//This executes when you hover OFF the box
     $(selector).hide();//This hides the popup inside the hovered box
  });
  function moveBox(){
    $(targetedBox).bind('mousemove',function(event){//Executes when the mouse MOVES
      adjustX = $(this).find(".popup").outerWidth(true);//gets the width of the targeted popup
      adjustY = $(this).find(".popup").outerHeight(true);//gets the height of the targeted popup
      if(targetedBox == "#box1") {//example of moving popup relative to mouse
        adjustX = $(this).find(".popup").outerWidth(true)-12;//creates a more unique value
        adjustY = $(this).find(".popup").outerHeight(true)-12;
      }
      //event.pageY or evet.pageX = the mouse position relative to the top left of the targeted box
      var my = event.pageY-$(this).offset().top-adjustY;//my = mouse y position with some adjustment relateive to top of box
      var mx = event.pageX-$(this).offset().left-adjustX; //mx = mouse x position with some adjustment relateive to left of box
      $(selector).css({//set the selected popup box coordinates near the mouse as the mouse moves
        "left":mx,
        "top":my
      });
    });
  }


$(document).on("click", '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});

$(".hokya").mouseenter(function() {
    $('#zumzuman').stop().show();
    $('#zumzuman').addClass('overlay');
});

$(".hokya").mouseleave(function() {
  if(!$('#zumzuman').is(':hover')){
    $('#zumzuman').hide();
  };
});

</script>
{{--
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
--}}
@endsection
