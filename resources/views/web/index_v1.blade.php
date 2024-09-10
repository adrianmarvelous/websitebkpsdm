
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/css/theme.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/custom.css">


    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/fonts2/feather.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/aos.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/choices.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/flickity-fade.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/flickity.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/vs2015.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/jarallax.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/quill.core.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/owlcarousel/owl.carousel.min.css" />


    <link rel="stylesheet" href="{{asset('assets')}}/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
    <script src="https://kit.fontawesome.com/89a80b9459.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


    

    <title>Badan Kepegawaian dan Diklat Kota Surabaya</title>

    <!-- css.gg -->
    <link href="https://css.gg/css" rel="stylesheet" />

    <!-- UNPKG -->
    <link href="https://unpkg.com/css.gg/icons/icons.css" rel="stylesheet" />

    <!-- JSDelivr -->
    <link
      href="https://cdn.jsdelivr.net/npm/css.gg/icons/icons.css"
      rel="stylesheet"
    />

    <!-- <style>
      @media (min-width: 1200px){
      .container, .container-lg, .container-md, .container-sm, .container-xl {
          max-width: 1140px;
      }
      @php
      $aktif_sub_slider = \App\Models\Subslider::where('aktif', '1')->first();
      @endphp
      .img-surabaya {
          background: url({{asset('storage/'.$aktif_sub_slider->foto)}});
          background-repeat: no-repeat;
          background-position: center;
          background-size: cover;
      }
    }
    </style> 

    @yield('custom_css') -->

  

  </head>
  <body>

  

    <!-- NAVBAR
    ================================================== -->
    <nav class="navbar navbar-expand-lg navbar-light shadow fixed-top menu-atas">
      <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand" href="{{route('index_web')}}">
          <img src="{{asset('assets/icons/home/logo bkpsdm.png')}}" width="200" />
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarCollapse">

          <!-- Toggler -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fe fe-x"></i>
          </button>

    

          <!-- Navigation -->
          <ul class="navbar-nav px-5">

            @php
            /* TAMPILKAN MENU STATIS */
            $categories = \App\Models\M_konten_web::Recursive()->get();
            @endphp

            @foreach ($categories as $category)
                <li class="nav-item dropdown">
                    <a class="nav-link" id="navbar_{{$category->id}}" href="{{ $category->slug ? route('statis', ['slug' => $category->slug]) : 'javascript:void(0);' }}" aria-haspopup="true" aria-expanded="false">{{ $category->judul_konten }}</a>
                    @if(count($category->childrenCategories) > 0)
                        <ul class="dropdown-menu" aria-labelledby="navbarAccount">
                          @foreach ($category->childrenCategories as $childCategory)
                              @include('web.child_category', ['child_category' => $childCategory])
                          @endforeach
                        </ul>
                    @endif

                </li>
            @endforeach



            @php
            /* TAMPILKAN MENU MASTER CONTENT */
            $menu_web = \App\Models\M_menu_web::Recursive()->get();
            @endphp

            @foreach ($menu_web as $category_web)

                <li class="nav-item dropdown">
                    <a class="nav-link" id="navbar_{{$category_web->id}}" href="{{ $category_web->slug ? route($category_web->slug.'.index') : 'javascript:void(0);' }}" aria-haspopup="true" aria-expanded="false">{{ $category_web->nama_menu }}</a>
                        @if(count($category_web->childrenCategories) > 0)
                        <ul class="dropdown-menu" aria-labelledby="navbarAccount">
                          @foreach ($category_web->childrenCategories as $childCategoryWeb)
                              @include('web.child_category_web', ['child_category_web' => $childCategoryWeb])
                          @endforeach
                        </ul>
                        @endif
                </li>

            @endforeach
              <li>
              <a class="nav-link" id="navbar_{{$category_web->id}}" href="/sigendis/index.php" aria-haspopup="true" aria-expanded="false">Gedung Diklat</a>
              </li>
              <li>
              <a class="nav-link" id="navbar_{{$category_web->id}}" href="/artikel" aria-haspopup="true" aria-expanded="false">Artikel</a>
              </li>
              <li>
              <a class="nav-link" id="navbar_{{$category_web->id}}" href="/sop" aria-haspopup="true" aria-expanded="false">SOP & Standart Pelayanan</a>
              </li>
              <li>
              <a class="nav-link" id="navbar_{{$category_web->id}}" href="https://drive.google.com/drive/folders/1gcGfHJxCevSoaE5GkAJvaY-ACOTl9cGj" aria-haspopup="true" aria-expanded="false" target="_blank">Materi Workshop</a>
              </li>

            
            
          </ul>

         <!--  <a class="navbar-btn btn btn-sm btn-primary lift ml-auto" href="https://themes.getbootstrap.com/product/landkit/" target="_blank">
            Buy now
          </a> -->

          <form class="ml-auto" id="searchform" method="post">
              <div class="input-group">
                  <input type="text" required autocomplete="off" value="{{$keyword ?? null}}" class="form-control dropdown-toggle" placeholder="Pencarian cepat" id="keywords" name="keywords">
                  <span class="mdi mdi-magnify search-icon"></span>
                  <div class="input-group-append">
                      <button title="cari di web ini" id="searchnow" class="btn btn-warning" type="submit">
                        <svg class="bi" width="21" height="21" fill="#007bff">
                          <use xlink:href="{{asset('assets')}}/icons/bootstrap-icons.svg#search"/>
                        </svg>
                      </button>
                  </div>
              </div>
          </form>

        </div>

      </div>
    </nav>


    <!-- WELCOME
    ================================================== -->
    @php
    if(Route::current()->getName() == 'index_web'){
    @endphp
    <section class="" id="welcome">
        
        @include('web.slider')

    </section>
    @php } @endphp

    @yield('content')

    <!-- UNIFIED
    ================================================== -->
    {{-- <section class="pt-6 pl-7">
      <div class="container">
        <div class="row">
          <div class="col-11 col-md-11 col-lg-11">

            <h1 class="font-weight-bold kategori-title">
              <strong>INFO PEMBINAAN</strong>
            </h1>
            <p>Informasi Pembinaan Pegawai</p>

          </div>
          <div class="col-1 col-md-1 col-lg-1"><a href="" class="btn btn-outline-dark mr-auto">Selengkapnya</a></div>
        </div> 
      </div> 
    </section>

    <div style="display:flex;justify-content:space-around;flex-wrap:wrap">
      <div>
        <a href="/bermedsos" onmouseover="document.getElementById('video').play()" onmouseout="document.getElementById('video').pause()">
          <video width="320" height="240" playsinline autoplay muted loop onmouseover="this.play()" onmouseout="this.pause()" id="video">
            <source src="{{asset('assets/pembinaan/bermedsos.mp4')}}" type="video/mp4">
          </video>
        </a>
      </div>
      <div>
        <a href="/gratifikasi" onmouseover="document.getElementById('video').play()" onmouseout="document.getElementById('video').pause()">
          <video width="320" height="240" playsinline autoplay muted loop onmouseover="this.play()" onmouseout="this.pause()" id="video">
            <source src="{{asset('assets/pembinaan/gratifikasi.mp4')}}" type="video/mp4">
          </video>
        </a>
      </div>
      <div>
        <a href="/antinarkoba" onmouseover="document.getElementById('video').play()" onmouseout="document.getElementById('video').pause()">
          <video width="320" height="240" playsinline autoplay muted loop onmouseover="this.play()" onmouseout="this.pause()" id="video">
            <source src="{{asset('assets/pembinaan/anti narkoba.mp4')}}" type="video/mp4">
          </video>
        </a>
      </div>
      <div>
        <a href="/kode_etik">
          <img src="{{asset('assets/pembinaan/kode etik dan perilaku.jpeg')}}" width="300">
        </a>
      </div>
      <div>
        <a href="/jam_kerja" onmouseover="document.getElementById('video').play()" onmouseout="document.getElementById('video').pause()">
          <video width="320" height="240" playsinline autoplay muted loop onmouseover="this.play()" onmouseout="this.pause()" id="video">
            <source src="{{asset('assets/pembinaan/Dasar Hukum Jam Kerja ASN di Lingkungan Pemerintah Kota Surabaya.mp4')}}" type="video/mp4">
          </video>
        </a>
      </div>
    </div> --}}


    <!--<div class="owl-carousel" id="owl1">
      <div class="">
        <a href="">
                <img  src="{{asset('assets/gedung_diklat/foto_kegiatan/7162647_WhatsApp Image 2022-12-09 at 4.18.03 PM (2).jpeg')}}" >
            <div class="custom_overlay">
              <span class="custom_overlay_inner">
                <h4></h4>
                <small class="tanggal"></small>
              </span>
            </div>
        </a>
      </div>
    </div>-->
  
    @php
    if(Route::current()->getName() == 'index_web'){
    @endphp
    {{-- <div class="info-penting" id="targetSection"> --}}
    <div class="info-penting">
      <p class="title animate__animated animate__heartBeat animate__infinite">Info Penting</p>
      <!--<p class="desc">Info Penting Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Pemerintah Kota Surabaya</p>-->
        <!-- <div class="sumber-guru"> -->
          <!-- <p style="text-align: center;width:500px;font-size:32px">Yuk, Bijak Bermedsos</p>  -->
          <a href="/bermedsos" onmouseover="document.getElementById('video').play()" onmouseout="document.getElementById('video1').pause()">
            <video class="video-bermedsos" style="width: 80vw;" playsinline autoplay muted loop onmouseover="this.play()" onmouseout="this.pause()" id="video1">
              <source src="{{asset('assets/pembinaan/etika bermedsos.mp4')}}" type="video/mp4">
            </video>
          </a>
          <a href="/asn_netral" onmouseover="document.getElementById('video').play()" onmouseout="document.getElementById('video2').pause()">
            <video class="video-bermedsos" style="width: 80vw;" playsinline autoplay loop onmouseover="this.play()" onmouseout="this.pause()" id="video2">
              <source src="{{asset('assets/maklumat/asn netral.mp4')}}" type="video/mp4">
            </video>
          </a>
        <!-- </div> -->
      <div class="pengumuman-guru-container">

        <!-- <div href="">
          <div class="sumber-guru" >
            <p class="judul-hasil" style="text-align: center;">Seleksi Calon PPPK Pemerintah Kota Surabaya 2023</p>
            <div>
            
          <div class="card-pengumuman-container">
            @php
                $judul_pengumuman = array('Dasar Hukum ' . "\n" . ' Rekrutmen PPPK 2023',
                                          'Jadwal Pelaksanaan Seleksi CASN 2023',
                                          'Pengumuman Penerimaan PPPK 2023',
                                          'Kontak ' . "\n" . ' PPPK');
                $link_pengumuman = array('pengumuman_1',
                                          'assets/pppk2023/S-9386-Penyesuaian Jadwal Seleksi CASN 2023 (DS)_231009_221605.pdf',
                                          'pengumuman_penerimaan',
                                          'qna_pppk');
                $logo_pengumuman = array('assets/icons/home/regulation.png',
                                          'assets/icons/home/schedule.png',
                                          'assets/icons/home/anouncement.png',
                                          'assets/icons/home/contact us.png');
                $jumlah_pengumuman = count($judul_pengumuman);
            @endphp
            @for ($i = 0; $i < $jumlah_pengumuman; $i++)
              <a href="{{$link_pengumuman[$i]}}">
                <div class="card-pengumuman">
                  <img class="home-icon" src="{{$logo_pengumuman[$i]}}" alt="">
                  <p class="card-title-pengumuman">{{$judul_pengumuman[$i]}}</p>
                </div>
              </a>
            @endfor
          </div>
            </div>
          </div> 
        </div> -->
        
        @php
        $info_penting = \App\Models\InfoPenting::byAktif()->orderBy('created_at', 'desc')->get();
        @endphp

        @foreach($info_penting as $info)
            <a href="{{ route('info-penting.detail', ['slug' => $info->slug]) }}">
                <div class="sumber-guru">
                    <p class="judul-hasil" style="text-align: center;">{{ $info->judul }}</p>
                    <img class="pengumuman-guru" src="{{ asset('storage/' . $info->foto) }}">
                </div>
            </a>
        @endforeach


        <!-- <a href="/hasil_akhir_pppk  ">
          <div class="sumber-guru">
            <p class="judul-hasil" style="text-align: center;">Hasil Seleksi Kompetensi PPPK Teknis dan NAKES 2023</p>
            <img class="pengumuman-guru" src="{{asset('assets/icons/home/hasil seleksi pppk 2023.jpeg')}}">
          </div> 
        </a>

        <a href="/hasil_akhir_pppk_guru  ">
          <div class="sumber-guru">
            <p class="judul-hasil" style="text-align: center;">Hasil Seleksi Kompetensi PPPK Guru 2023</p>
            <img class="pengumuman-guru" src="{{asset('assets/icons/home/pengumuman hasil pppk guru.jpeg')}}">
          </div> 
        </a> -->

        <!--<a href="{{asset('assets/pppk2023/2881_PPK Pusat dan Daerah_Materi Pokok SKT dengan CAT PPPK 2023.pdf')}}">
          <div class="sumber-guru" >
            <p class="judul-hasil" style="text-align: center;">Materi Pokok Soal Kompetensi Teknis <br>PPPK Tahun 2023</p>
            <img class="pengumuman-guru" src="{{asset('assets/icons/home/materi pokok.jpeg')}}">
          </div> 
        </a>

        <a href="/jadwal_seleksi  ">
          <div class="sumber-guru">
            <p class="judul-hasil" style="text-align: center;">Jadwal Seleksi PPPK TA 2023  Pemerintah Kota Surabaya</p>
            <img class="pengumuman-guru" src="{{asset('assets/icons/home/jadwal seleksi.png')}}">
          </div> 
        </a>

        <a href="{{asset('assets/pppk2023/pengumuman perubahan jadwal.pdf')}}">
          <div class="sumber-guru">
            <p class="judul-hasil" style="text-align: center;">Pengumuman</p>
            <img class="pengumuman-guru" src="{{asset('assets/icons/home/perngumuman perubahan jadwal.jpeg')}}">
          </div> 
        </a>-->

        <!--<a href="/hasil_seleksi_administrasi  ">
          <div class="sumber-guru">
            <p class="judul-hasil" style="text-align: center;">Pengumuman Hasil Pasca Sanggah <br> Seleksi Administrasi PPPK TA 2023</p>
            <img class="pengumuman-guru" src="{{asset('assets/icons/home/pasca sanggah.jpeg')}}">
          </div> 
        </a>-->

        <!--<a href="{{asset('assets/pppk2023/S-9386-Penyesuaian Jadwal Seleksi CASN 2023 (DS)_231009_221605.pdf')}}">
          <div class="sumber-guru"><p>Penyesuaian Jadwal Seleksi</p></div>
        </a>-->
      </div>
      <!-- <div class="info-penting-card-container">
        <div class="pengumunan">
          <p class="pengumuman-title">Seleksi Calon PPPK Pemerintah Kota Surabaya 2023</p>

          <div class="card-pengumuman-container">
            @php
                $judul_pengumuman = array('Dasar Hukum ' . "\n" . ' Rekrutmen PPPK 2023',
                                          'Jadwal Pelaksanaan Seleksi CASN 2023',
                                          'Pengumuman Penerimaan PPPK 2023',
                                          'Kontak ' . "\n" . ' PPPK');
                $link_pengumuman = array('pengumuman_1',
                                          'assets/pppk2023/S-9386-Penyesuaian Jadwal Seleksi CASN 2023 (DS)_231009_221605.pdf',
                                          'pengumuman_penerimaan',
                                          'qna_pppk');
                $logo_pengumuman = array('assets/icons/home/regulation.png',
                                          'assets/icons/home/schedule.png',
                                          'assets/icons/home/anouncement.png',
                                          'assets/icons/home/contact us.png');
                $jumlah_pengumuman = count($judul_pengumuman);
            @endphp
            @for ($i = 0; $i < $jumlah_pengumuman; $i++)
              <a href="{{$link_pengumuman[$i]}}">
                <div class="card-pengumuman">
                  <img class="home-icon" src="{{$logo_pengumuman[$i]}}" alt="">
                  <p class="card-title-pengumuman">{{$judul_pengumuman[$i]}}</p>
                </div>
              </a>
            @endfor
          </div>
        </div>
        <div class="pengumuman-lain">
          <p class="title-pengumuman-lain">Madura Food Festival</p>
          <video class="video-home" playsinline autoplay muted loop onmouseover="this.play()" onmouseout="this.pause()" id="video">
            <source src="{{asset('assets/icons/home/madura food festival.mp4')}}" type="video/mp4">
          </video>
          <img class="gambar-pengumuman-lain" src="{{asset('assets/icons/home/madura food festival.jpeg')}}" alt="">
        </div>
        
      <div> -->
      </div>
      </div>
    </div>

    <section class="icon-home">
      <div class="w3-content w3-display-container" style="display: flex;justify-content:center">
        @php
            $komik = [];
            $jumlah_komik = 35;

            for ($i = 1; $i <= $jumlah_komik; $i++) {
                $komik[] = "assets/images/tipu tipu digital/TIPUTIPU DIGITAL-{$i}.jpg";
            }
            $count_komik = count($komik);
        @endphp
        @for ($i = 0; $i < $count_komik; $i++)
          <img class="mySlides" style="width:400px;height:600px" src="{{$komik[$i]}}">
        @endfor
        <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
        <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
      </div>
    
      <p class="title-container">Layanan Badan Kepegawaian dan Kepegawaian Sumber Daya Manusia</p>
      <div class="icon-container">
        @php
            $icon_layanan = array('assets/icons/home/consultation.png',
                                  'assets/icons/home/services.png',
                                  'assets/icons/home/study.png',
                                  'assets/icons/home/information (2).png',
                                  'assets/icons/home/qna.png',
                                  'assets/icons/home/gedun diklat.png',
                                  'assets/icons/home/arsip.png');
            $link_layanan = array('/pembinaan',
                                  'under_construction',
                                  'under_construction',
                                  'under_construction',
                                  'under_construction',
                                  '/gedung_diklat/index.php',
                                  'info-penting');
            $judul_layanan = array('PEMBINAAN','LAYANAN KEPEGAWAIAN','PENGEMBANGAN KOMPETENSI','INFORMASI PENTING','QUESTION & ANSWER','INFORMASI GEDUNG DIKLAT','ARSIP INFO PENTING');
            $jumlah_layanan = count($icon_layanan);
        @endphp
        @for ($i = 0; $i < $jumlah_layanan; $i++)
        <a href="{{$link_layanan[$i]}}">
          <div class="card-icon animate__animated animate__fadeInDown">
            <img class="home-icon" src="{{$icon_layanan[$i]}}" alt="">
            <p class="card-judul">{{$judul_layanan[$i]}}</p>
          </div>
        </a>
        @endfor
      </div>
      <div class="berakhlak-container" >
        <img class="berakhlak-gambar" src="{{asset('assets/home/ASN BERKAHLAK Brosur.jpg')}}" alt="">
        <img class="berakhlak-gambar" src="{{asset('assets/home/POSE ASN NETRAL 2.png')}}" alt="">
      </div>
    </section>
    <section class="institusi-tautan" >
      <div>
        <p class="title-institusi-tautan">Intintusi Terkait</p>
        <div class="card-institusi-tautan">
          @php
              $logo_institusi = array('assets/icons/home/bkn.png',
                                      'assets/icons/home/kemenpan.png',
                                      'assets/icons/home/kemendagri.png',
                                      'assets/icons/home/kasn.png',
                                      'assets/icons/home/jatim 2.png',
                                      'assets/icons/home/BKDJATIM.png',
                                      'assets/icons/home/bpsdm-removebg-preview.png');
              $link_institusi = array('https://www.bkn.go.id/',
                                      'https://menpan.go.id/site/',
                                      'https://www.kemendagri.go.id/',
                                      'https://www.kasn.go.id/',
                                      'https://jatimprov.go.id/',
                                      'https://bkd.jatimprov.go.id',
                                      'https://bpsdm.jatimprov.go.id/');
              $jumlah_institusi = count($logo_institusi);
          @endphp

          @for ($i = 0; $i < $jumlah_institusi; $i++)
            <div class="card-institusi">
              <a href="{{$link_institusi[$i]}}">
                <img class="icon-institusi" src="{{asset($logo_institusi[$i])}}">
              </a>
            </div>
          @endfor

        </div>
      </div>
      <div>
        <p class="title-institusi-tautan">Tautan Terkait</p>
        <div class="card-institusi-tautan">
          @php
              $logo_tautan = array('assets/icons/home/sscasn.png',
                                    'assets/icons/home/redwhistle.png',
                                    'assets/icons/home/sswalfa.jpg',
                                    'assets/icons/home/ppid.png');
              $link_tautan = array('https://sscasn.bkn.go.id/',
                                    'https://wbs.surabaya.go.id/',
                                    'https://sswalfa.surabaya.go.id/',
                                    'https://ppid.surabaya.go.id/');
              $jumlah_logo_tautan = count($logo_tautan);
          @endphp
          @for ($i = 0; $i < $jumlah_logo_tautan; $i++)
            <div class="card-institusi">
              <a href="{{$link_tautan[$i]}}">
                <img class="icon-institusi" src="{{$logo_tautan[$i]}}">
              </a>
            </div>
          @endfor
        </div>
      </div>
    </section>
     @php
   }
     @endphp
{{-- 
    @php
    if(Route::current()->getName() == 'index_web'){
    @endphp

    <!-- INFO PENTING
    ================================================== -->
    <section class="pt-6 pl-7">
      <div class="container">
        <div class="row">
          <div class="col-11 col-md-11 col-lg-11">

            <!-- Heading -->
            <h1 class="font-weight-bold kategori-title">
              <strong>INFO PENTING</strong>
            </h1>
            <p>Menyajikan informasi dari BKPSDM Kota Surabaya dan agenda terdekat di Instansi Dinas</p>

          </div>
          <div class="col-1 col-md-1 col-lg-1"><a href="{{route('info-penting.index')}}" class="btn btn-outline-dark mr-auto">Selengkapnya</a></div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>



    <div class="owl-carousel" id="owl1">
    @php
    $info_penting = \App\Models\InfoPenting::byAktif()->orderBy('created_at', 'desc')->take(15)->get();
    if(count($info_penting) > 4){
    foreach($info_penting as $info){
    @endphp
      <div class="custom_overlay_wrapper">
        <a href="{{route('info-penting.detail', ['slug' => $info->slug])}}">
            @if($info->foto)
                <img  src="{{asset('storage/'.$info->foto)}}" />
            @else
                <img  src="{{asset('assets/images/no-image-available.png')}}" >
            @endif
            <div class="custom_overlay">
              <span class="custom_overlay_inner">
                <h4>{{$info->judul}}</h4>
                <small class="tanggal">{{tanggal_indo($info->created_at)}}</small>
              </span>
            </div>
        </a>
      </div>
    @php } } @endphp
    </div>



    @php } @endphp


    @php
    if(Route::current()->getName() == 'index_web'){
    @endphp
    <!-- KEGIATAN
    ================================================== -->
    <section class="pt-6 pl-7">
      <div class="container">
        <div class="row">
          <div class="col-11 col-md-11 col-lg-11">

            <!-- Heading -->
            <h1 class="font-weight-bold kategori-title">
              <strong>KEGIATAN</strong>
            </h1>
            <p>Menyajikan informasi dari BKPSDM Kota Surabaya yang disajikan dalam bentuk foto dan video</p>

          </div>

          <div class="col-1 col-md-1 col-lg-1"><a href="{{route('foto-kegiatan.index')}}" class="btn btn-outline-dark mr-auto">Selengkapnya</a></div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>

    <!-- KEGIATAN GALERI (CAROUSEL)
    ================================================== -->
    <div class="owl-carousel"  id="owl2">
      @php
      $info_penting = \App\Models\Foto_kegiatan::byAktif()->orderBy('created_at', 'desc')->take(10)->get();
      if(count($info_penting) > 4){
      foreach($info_penting as $info){
      @endphp
      <div class="custom_overlay_wrapper">
        <a href="{{route('foto-kegiatan.detail', ['slug' => $info->slug])}}">
            @if($info->id)
                <img width="100%" src="{{asset('storage/'.$info->isi_album->first()->file_lampiran)}}" />
            @else
                <img width="800px" src="{{asset('assets/images/no-image-available.png')}}" >
            @endif
            <div class="custom_overlay">
              <span class="custom_overlay_inner">
                <h4>{{$info->judul}}</h4>
                <small class="tanggal">{{tanggal_indo($info->created_at)}}</small>
              </span>
            </div>
        </a>
      </div>

      @php } } @endphp
    </div>
      

    @php } @endphp







    @php
    if(Route::current()->getName() == 'index_web'){
    @endphp

    <!-- BERITA
    ================================================== -->
    <section class="pt-6 pl-7">
      <div class="container">
        <div class="row">
          <div class="col-11 col-md-11 col-lg-11">

            <!-- Heading -->
            <h1 class="font-weight-bold kategori-title">
              <strong>BERITA TERKINI</strong>
            </h1>
            <p>Berita terkini seputar Kepegawaian Daerah</p>

          </div>
          <div class="col-1 col-md-1 col-lg-1"><a href="{{route('berita.index')}}" class="btn btn-outline-dark mr-auto">Selengkapnya</a></div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>


    

    <!-- BERITA (CAROUSEL)
    ================================================== -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-12">
            
            <!-- BERITA -->
            <div class="flickity-viewport-visible pt-2 pb-3" data-flickity='{"cellAlign": "left", "autoPlay": 4000,  "imagesLoaded": true, "pageDots": false, "prevNextButtons": false, "contain": true}'>
              

              @php
              $berita = \App\Models\Berita::byAktif()->orderBy('created_at', 'desc')->take(20)->get();
              if(count($berita) > 4){
              foreach($berita as $info){
              @endphp
              <div class="col-12 col-md-5 col-lg-3">
                
                <div class="card card-border shadow-light-lg lift lift-lg" style="border-top-color: #35265E;">
                  <div class="card-body text-center">

                    <div class="img-fluid mb-5 svg-shim mx-auto">
                      <a href="{{route('berita.detail', ['slug' => $info->slug])}}">
                      @if($info->foto)
                          <img width="100%" src="{{asset('storage/'.$info->foto)}}" />
                      @else
                          <img src="{{asset('assets/images/no-image-available.png')}}" width="100%">
                      @endif
                      </a>
                      <br>
                      <small>{{tanggal_indo($info->created_at)}}</small>
                      <br>
                      <a href="{{route('berita.detail', ['slug' => $info->slug])}}"><strong>{{$info->judul}}</strong></a>

                    </div>

                    <a class="btn btn-outline-danger btn-block" href="{{route('berita.detail', ['slug' => $info->slug])}}">Selengkapnya</a>
                    
                  </div>
                </div>

              </div>

              @php } } @endphp
              




            </div>

          </div>
        </div> <!-- / .row -->



      </div> <!-- / .container -->
    </section>
    @php } @endphp --}}

    


    <!-- FOOTER
    ================================================== -->
    @php
        $Rcounter_digit = 5;
        $Rcounter_dpath = "/visitors";
        $Rcounter_fpath = public_path("assets/php-visitor-counter-master/visits.txt");

        // Check if directory and file exists, if not then create it.
        if (!file_exists($Rcounter_fpath)) {
          if (!is_dir($Rcounter_dpath)) {
            mkdir($Rcounter_dpath, 0700);
          }
          $Rcounter_fso = fopen($Rcounter_fpath,"w");
          flock($Rcounter_fso, 2);
          fputs($Rcounter_fso, 0);
          flock($Rcounter_fso, 3);
          fclose($Rcounter_fso);
        }
        $Rcounter_fso = fopen($Rcounter_fpath,"r+");
        $Rcounter_count = fgets($Rcounter_fso, 4096);
        session_start();
        if (!isset($HTTP_SESSION_VARS["Rcounter_DataCounter"])) {
          fseek($Rcounter_fso, 0);
          flock($Rcounter_fso, 2);
          fputs($Rcounter_fso, $Rcounter_count+1);
          flock($Rcounter_fso, 3);
          fclose($Rcounter_fso);
          $Rcounter_count++;
          $Rcounter_DataCounter = $Rcounter_count;
        }
        $Rcounter_numlength = strlen((string) $Rcounter_count);
        if ($Rcounter_numlength < $Rcounter_digit) {
          $Rcounter_lead = (int) $Rcounter_digit - $Rcounter_numlength;
          for ($i=0; $i<$Rcounter_lead; $i++) {
            $Rcounter_count = "0" . $Rcounter_count;  }}
    @endphp
    <section class="bg-dark">
      <footer class="py-8 py-md-4 bg-dark border-gray-800-50">
        <div class="container">
          <div class="row">
            
            <div class="col-12 col-md-12 col-lg-12">
              {{-- <p class="text-uppercase text-gray-200" style="margin-bottom: 0px;">Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kota Surabaya &copy; 2020</p> --}}
              <div class="footer">
                <div class="footer-kontak">
                  <a class="title-footer">BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</a>
                  <a class="content-footer">LT. III R.24, JL Jimerto, No 25-27, Ketabang, Surabaya, Jawa Timur 60272 | Telp (031) 5466484</a>
                  <a class="content-footer">Jumlah Pengunjung <i class="fa fa-user"></i> {{$Rcounter_count}}</a>
                  <div class="footer-icon-container">
                    <a href="https://www.instagram.com/bkpsdmsurabaya/">
                      <div class="footer-icon">
                        <i class="fa fa-instagram"></i>
                      </div>
                    </a>
                    <a href="https://www.youtube.com/@bkpsdmsurabaya">
                      <div class="footer-icon" style="--col:red">
                        <i class="fa fa-youtube"></i>
                      </div>
                    </a>
                    <a href="https://wa.me/6282121121521">
                      <div class="footer-icon" style="--col:green">
                        <i class="fa fa-whatsapp"></i>
                      </div>
                    </a>
                  </div>
                  {{-- <a class="content-footer"><i class="fa fa-phone-square"></i> (031) 5466484</a>
                  <a class="content-footer"><i class="fa fa-mobile"></i> +62-821-2112-1521</a>
                  <a class="content-footer" href="https://www.youtube.com/@bkpsdmsurabaya"><i class="fa fa-youtube"></i> Bkpsdm Surabaya</a>
                  <a class="content-footer" href="https://www.instagram.com/bkpsdmsurabaya/"><i class="fa fa-instagram"></i> bkpsdmsurabaya</a> --}}
                </div>
              </div>
              {{-- <p style="color: white;text-align:center">2020 &copy; BKPSDM Pemerintah Kota Surabaya - Copyright All Right Reserved</p> --}}
              <!-- <h6 class="font-weight-bold text-uppercase text-gray-700">
                Services
              </h6>

              <ul class="list-unstyled text-muted mb-6 mb-md-8 mb-lg-0">
                <li class="mb-3">
                  <a href="#!" class="text-reset">
                    Documentation
                  </a>
                </li>
                <li class="mb-3">
                  <a href="#!" class="text-reset">
                    Changelog
                  </a>
                </li>
                <li class="mb-3">
                  <a href="#!" class="text-reset">
                    Pagebuilder
                  </a>
                </li>
                <li>
                  <a href="#!" class="text-reset">
                    UI Kit
                  </a>
                </li>
              </ul> -->

            </div>
            
            
          </div> <!-- / .row -->
        </div> <!-- / .container -->
      </footer>
    </section>

    

    <!-- JAVASCRIPT
    ================================================== -->
    <script>
      window.onload = function() {
          // Scroll to the target section
          var targetSection = document.getElementById("targetSection");
          if (targetSection) {
              targetSection.scrollIntoView({ behavior: 'smooth' }); // Add smooth scrolling effect
          }
      };

      var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
  </script>
    <!-- Libs JS -->
    <script src="{{asset('assets')}}/js/jquery.min.js"></script>
    <script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets')}}/js/jquery.fancybox.min.js"></script>
    <script src="{{asset('assets')}}/js/aos.js"></script>
    <script src="{{asset('assets')}}/js/choices.min.js"></script>
    <script src="{{asset('assets')}}/js/countUp.min.js"></script>
    <script src="{{asset('assets')}}/js/dropzone.min.js"></script>
    <script src="{{asset('assets')}}/js/flickity.pkgd.min.js"></script>
    {{--<script src="{{asset('assets')}}/js/flickity-fade.js"></script>
    <script src="{{asset('assets')}}/js/highlight.pack.min.js"></script>
    <script src="{{asset('assets')}}/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{asset('assets')}}/js/isotope.pkgd.min.js"></script>
    <script src="{{asset('assets')}}/js/jarallax.min.js"></script>
    <script src="{{asset('assets')}}/js/jarallax-video.min.js"></script>
    <script src="{{asset('assets')}}/js/jarallax-element.min.js"></script>--}}
    <script src="{{asset('assets')}}/js/quill.min.js"></script>
    <script src="{{asset('assets')}}/js/smooth-scroll.min.js"></script>
    <script src="{{asset('assets')}}/js/typed.min.js"></script>
    <script src="{{asset('assets')}}/admin/plugins/swal/sweetalert2@10.js"></script>
    <script src="{{asset('assets')}}/plugins/mousefollow/jquery.mousefollow.js"></script>
    <script src="{{asset('assets')}}/plugins/owlcarousel/owl.carousel.min.js"></script>

     <script>

      $('#owl1').children().each( function( index ) {
        $(this).attr( 'data-position', index ); // NB: .attr() instead of .data()
      });

      $('#owl2').children().each( function( index ) {
        $(this).attr( 'data-position', index ); // NB: .attr() instead of .data()
      });

      $('#owl3').children().each( function( index ) {
        $(this).attr( 'data-position', index ); // NB: .attr() instead of .data()
      });

      $(document).ready(function(){
          $('#owl1').owlCarousel({
              center: true,
              loop: true,
              items: 4
          });
          $('#owl2').owlCarousel({
              center: true,
              loop: true,
              items: 4
          });
          $('#owl3').owlCarousel({
              center: true,
              loop: true,
              items: 4
          });
      })

      $('#owl1').on('mouseover', '.owl-item>div', function() {
        var $speed = 3000;  // in ms
        $('#owl1').trigger('to.owl.carousel', [$(this).data( 'position' ), $speed] );
      });

      $('#owl2').on('mouseover', '.owl-item>div', function() {
        var $speed = 3000;  // in ms
        $('#owl2').trigger('to.owl.carousel', [$(this).data( 'position' ), $speed] );
      });


      $('#owl3').on('mouseover', '.owl-item>div', function() {
        var $speed = 3000;  // in ms
        $('#owl3').trigger('to.owl.carousel', [$(this).data( 'position' ), $speed] );
      });


      $('#searchform').submit(function(event) {
        $(".text-danger").remove();
        event.preventDefault();
        var data = new FormData($('#searchform')[0]);
        $("#searchnow").attr('disabled', true);

        $.ajax({
            url:"{{ route("cari") }}",
            method:"post",
            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            success:function(data)
            {
                if(data.status == "success"){
                    $("#searchnow").removeAttr('disabled');
                    $("form").each(function() { this.reset() });
                    location.href = data.redirect;
                }
            },
            error: function(data){
                swal.fire("Telah terjadi kesalahan pada sistem", data.message, "error");
                $("#searchnow").removeAttr('disabled');
            }
        });
    });
      // });
    </script>


    <!-- Theme JS -->
    <script src="{{asset('assets')}}/js/theme.min.js"></script>
    @yield('custom_js')


    
   
      
  </body>
</html>