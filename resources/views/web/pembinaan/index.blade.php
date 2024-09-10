@extends('web.index')


@section('content')


<section>
      <div class="container pt-12 mb-5">
        <div class="row">
          
          <div class="col-12 col-md-12 col-lg-12 ">
            <div class="jdl-head-search">Informasi Pembinaan Pegawai</div>
            @php
                $array_judul = array('ASN Bijak Bermedsos','Gratifikasi','Suroboyo Wani Lawan Narkoba','Kode Etik dan Kode Perilaku'/*,'Dasar Hukum Jam Kerja'*/,'Dasar Hukum Jam Kerja');
                $array_link = array('bermedsos','gratifikasi','antinarkoba','kode_etik'/*,'jam_kerja'*/,'jam_kerja_1');
                $array_source = array('bermedsos.mp4','gratifikasi.mp4','anti narkoba.mp4','kode etik dan perilaku.jpeg'/*,'Dasar Hukum Jam Kerja ASN di Lingkungan Pemerintah Kota Surabaya.mp4'*/,'aturan jam kerja pemkot surabaya.mp4');
                $jumlah = count($array_judul);
            @endphp
            @for ($i = 0; $i < $jumlah; $i++)
            <a href="{{$array_link[$i]}}">
            <!-- Card -->
            <div class="card shadow-lg mb-2">
            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
             
              <div class="card-body">
                
                    <!-- Text -->
                    <div class="mr-auto">
              
                      
                        <div class="row">
                            <div class="col-md-3">
                                @if ($array_judul[$i] == 'Kode Etik dan Kode Perilaku')
                                    <img src="{{asset('assets/pembinaan/'.$array_source[$i])}}" width="300">
                                @else
                                    <video width="300" playsinline autoplay muted loop onmouseover="this.play()" onmouseout="this.pause()" id="video">
                                        <source src="{{asset('assets/pembinaan/'.$array_source[$i])}}" type="video/mp4">
                                    </video>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <h3 style="font-weight: bold">{{$array_judul[$i]}}</h3>
                                <small></small>
                            </div>
                        </div>
                     


                    </div>
                      
              </div>

            </div>
            </a>
            @endfor

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>



@endsection