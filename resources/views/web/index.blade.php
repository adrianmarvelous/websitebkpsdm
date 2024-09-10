<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- <link rel="stylesheet" href="{{asset('assets')}}/fonts2/feather.css"> --}}
    <link rel="stylesheet" href="{{asset('assets')}}/css/global.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/global_animate.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/micro_animation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/micro_animation.css') }}">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="icon" href="{{asset('assets')}}/images/Logo Kota Surabaya.png" type="image/x-icon"/>

    <title>BKPSDM</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand nav-logo animate__animated animate__fadeInDown" style="display: block"
                href="{{route('index_web')}}">
                <img src="{{ asset('assets/icons/logo bkpsdm bulat.png') }}" width="80" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-text" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    @php
                        use Illuminate\Support\Facades\DB;
                        use App\Models\M_konten_web;
                        // Fetch main menu items
                        $main_menu = m_konten_web::whereNull('parent')->get();
    
                        // Initialize an empty array to store main menu items and their corresponding sub-menu items
                        $main_menu_with_submenus = [];
    
                        // Iterate over each main menu item to fetch its associated sub-menu items
                        foreach ($main_menu as $mainmenu) {
                            // Fetch sub-menu items for the current main menu item
                            $sub_menu = m_konten_web::where('parent', $mainmenu->id)->where('aktif',1)->get();
    
                            // Initialize an empty array to store sub-menu2 items for each sub-menu item
                            $sub_menu2_array = [];
    
                            // Iterate over each sub-menu item to fetch its associated sub-menu2 items
                            foreach ($sub_menu as $submenu) {
                                // Fetch sub-menu2 items for the current sub-menu item
                                $sub_menu2 = m_konten_web::where('parent', $submenu->id)->get();
    
                                // Add the current sub-menu2 items to the sub_menu2_array
                                $sub_menu2_array[$submenu->id] = $sub_menu2;
                            }
    
                            // Add the current main menu item along with its sub-menu items and sub-menu2 items to the array
                            $main_menu_with_submenus[] = [
                                'main_menu' => $mainmenu,
                                'sub_menu' => $sub_menu,
                                'sub_menu2' => $sub_menu2_array,
                            ];
                        }
                        $delay = 0.2; // Initial delay value
                        $delayIncrement = 0.2; // Increment value for each element
                    @endphp
                    @foreach ($main_menu_with_submenus as $menu)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle animate__animated animate__fadeInDown"
                                style="color: #05254d;font-weight:bold;animation-delay: {{ $delay }}s;margin-right:50px"
                                href="{{ $menu['main_menu']->slug ? route('statis', ['slug' => $menu['main_menu']->slug]) : 'javascript:void(0);' }}"
                                id="navbarDropdown{{ $menu['main_menu']->id }}" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ sanitizeString($menu['main_menu']->judul_konten) }}
                            </a>
                            @php
                                $delay += $delayIncrement; // Increase delay for the next element
                            @endphp
                            <ul class="dropdown-menu first-submenu" aria-labelledby="navbarDropdown{{ $menu['main_menu']->id }}">
                                @foreach ($menu['sub_menu'] as $submenu)
                                    <li class="dropdown-submenu" style="padding: 10px">
                                        @if (count($menu['sub_menu2'][$submenu->id]) > 0)
                                            <a class="dropdown-item dropdown-toggle primary-text-color"
                                                href="{{ $submenu->slug ? route('statis', ['slug' => $submenu->slug]) : 'javascript:void(0);' }}"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ sanitizeString($submenu->judul_konten) }}</a>
                                            <ul class="dropdown-menu second-submenu" style="background-color: #05254d">
                                                @foreach ($menu['sub_menu2'][$submenu->id] as $submenu2)
                                                    <li style="padding: 10px"><a
                                                            class="dropdown-item" style="color: white"
                                                            href="{{ $submenu2->slug ? route('statis', ['slug' => $submenu2->slug]) : 'javascript:void(0);' }}"
                                                            onmouseover="this.style.backgroundColor='#024c89'"
                                                            onmouseout="this.style.backgroundColor='#05254d'">
                                                            {{ sanitizeString($submenu2->judul_konten) }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <a class="dropdown-item primary-text-color"
                                                href="{{ $submenu->slug ? route('statis', ['slug' => $submenu->slug]) : 'javascript:void(0);' }}">{{ sanitizeString($submenu->judul_konten) }}</a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeInDown" role="button"
                            style="color: #05254d;font-weight:bold;animation-delay: 0.6s;margin-right:50px" href="{{route('coming_soon')}}">
                            Gedung Diklat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeInDown" role="button"
                            style="color: #05254d;font-weight:bold;animation-delay: 0.8s;margin-right:50px" href="{{route('coming_soon')}}">
                            Artikel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeInDown" role="button"
                            style="color: #05254d;font-weight:bold;animation-delay: 1s;margin-right:50px" href="https://drive.google.com/drive/folders/1gcGfHJxCevSoaE5GkAJvaY-ACOTl9cGj">
                            Materi Workshop
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    
    @if (Route::current()->getName() == 'index_web')

        {{-- @include('web.slider.slider') --}}
        {{-- SLIDER-START --}}
        <div id="carouselExampleCaptions" class="carousel slide carousel-fade  animate__animated animate__fadeIn"
            style="animation-delay: 0.2s" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active image-slider image-slider-up">
                    <video autoplay muted loop  class="d-block w-100">
                        <source src="{{ asset('assets/images/slider/surabaya may fest.mp4') }}" type="video/mp4">
                    </video>
                    <div class="carousel-caption d-md-block">
                        <h1>#SurabayaMayFest #Surabaya731</h1>
                        {{--  <p>Some representative placeholder content for the second slide.</p>  --}}
                    </div>
                    {{--  <div style="position: absolute; top: 80%; left: 50%; transform: translate(-50%, -50%);" class="d-flex justify-content-center">
                        <img src="{{ asset('assets/images/slider/title-otoda.png') }}"  class="img-fluid">
                    </div>                      --}}
                </div>
                <div class="carousel-item image-slider image-slider-up">
                    <img src="{{ asset('assets/images/slider/DJI_0881.jpg') }}" class="d-block w-100">
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div> --}}
                </div>
                <div class="carousel-item image-slider image-slider-up">
                    <img src="{{ asset('assets/images/slider/IMG_2915.jpg') }}" class="d-block w-100">
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div> --}}
                </div>
                <div class="carousel-item image-slider image-slider-up">
                    <img src="{{ asset('assets/images/slider/DSC_9695.jpg') }}" class="d-block w-100">
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div> --}}
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        {{-- SLIDER-END --}}

        <div class="container pt-5 animate__animated animate__fadeInDown">
            <div class="d-flex justify-content-center pb-5">
                <div style="width: 50%;">
                    <img src="{{ asset('assets/images/slider/berakhlak-web-1024x198-1.png') }}" class="img-fluid">
                </div>
            </div>
            
            
            <p class="primary-text-color animate__animated animate__fadeInDown text-decoration-underline" style="color:#ad2425;font-size:32px">Selamat Datang</p>
            <div class="text-justify" style="font-size: 18px;text-align:justify">
                <p>Selamat Datang di website Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Pemerintah Kota Surabaya.</p>
    
                <p>Semoga website ini menjadi sarana media pelayanan informasi kepegawaian bagi Aparatur Sipil Negara di lingkungan Pemerintah Kota Surabaya dan menjadi media untuk menjalin komunikasi yang baik.</p>
                <p>Terimakasih. <br><span style="font-weight:bold"> Ka BKPSDM Surabaya</span></p>
            </div>
        </div>

        <p class="text-center p-5 display-1 primary-text-color animate__animated animate__fadeInDown"
            style="font-weight: bold">INFO PENTING</p>
        <p class="text-center p-5 display-5 primary-text-color animate__animated animate__fadeInDown"
            style="font-weight: bold">Pengadaan CPNS di Lingkungan Pemkot Surabaya TA. 2024</p>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-12 image-container text-center">
                <div class="bg-container mx-auto" style="background-color: #ad2425; width: 80%;">
                    <p class="text-center p-2 display-5" style="font-weight: bold; color: white;">Belum Dibuka</p>
                </div>
                <img src="{{ asset('assets/images/ilustrasi/pppk ilus.png') }}" style="width: 100%;">
                <p class="text-center p-5 display-5 primary-text-color" style="font-weight: bold">PPPK</p>
            </div>
            <div class="col-lg-4 col-sm-12 image-container text-center">
                <a href="/info-penting/pengumuman-seleksi-calon-pegawai-negeri-sipil-cpns-pemerintah-kota-surabaya-tahun-anggaran-2024-1724112752" style="text-decoration:none">
                    <div class="bg-container mx-auto">
                        <button class="button">Dibuka</button>
                        {{-- <p class="text-center p-2 display-5" style="font-weight: bold; color: white;">Dibuka</p> --}}
                    </div>
                    <img src="{{ asset('assets/images/ilustrasi/pns ilus.png') }}" style="width: 100%;">
                    <p class="text-center p-5 display-5 primary-text-color" style="font-weight: bold">CPNS</p>
                </a>
            </div>
        </div>

        
        <div class="container d-flex justify-content-center animate__animated box">
            <div class="container-edit">
                <div class="selamat-datang-card">
                    <div id="carouselExampleCaptions1" class="carousel slide" data-bs-ride="carousel">
                            {{-- <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div> --}}
                        <div class="carousel-inner">
                            @php
                                $infopenting = DB::table('info_penting')
                                                ->where('aktif', 1)
                                                ->orderBy('created_at', 'desc')
                                                ->get();


                            @endphp
                            
                            <div class="carousel-item active image-slider ">
                                <a href="" style="text-decoration: none;color:#05254d">
                                    <div class="info-penting-card d-flex flex-wrap">
                                        <div class="col-lg-12 d-flex justify-content-center">
                                            <img class="img-fluid" src="{{asset('assets/images/hari libur nasional.jpg')}}">
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="carousel-item image-slider ">
                                <a href="" style="text-decoration: none;color:#05254d">
                                    <div class="info-penting-card d-flex flex-wrap">
                                        <div class="col-lg-12 d-flex justify-content-center">
                                            <img class="img-fluid" src="{{asset('assets/images/sby may fest/1.png')}}">
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="carousel-item image-slider ">
                                <a href="" style="text-decoration: none;color:#05254d">
                                    <div class="info-penting-card d-flex flex-wrap">
                                        <div class="col-lg-12 d-flex justify-content-center">
                                            <img class="img-fluid" src="{{asset('assets/images/sby may fest/22.png')}}">
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="carousel-item image-slider ">
                                <a href="" style="text-decoration: none;color:#05254d">
                                    <div class="info-penting-card d-flex flex-wrap">
                                        <div class="col-lg-12 d-flex justify-content-center">
                                            <img class="img-fluid" src="{{asset('assets/images/sby may fest/33.png')}}">
                                        </div>
                                    </div>
                                </a>
                            </div>

                            @foreach ($infopenting as $key => $info_penting)
                            @php
                                $key = $key+1;
                            @endphp
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }} image-slider">
                                    <a href="{{ route('info-penting.detail', ['slug' => $info_penting->slug]) }}" style="text-decoration: none;color:#05254d">
                                        <div class="info-penting-card d-flex flex-wrap">
                                            <div class="col-lg-12 p-2">
                                                <img style="width: 100%;height:auto"
                                                    src="{{ asset('storage/' . $info_penting->foto) }}" alt="">
                                            </div>
                                            {{-- <div class="header-info-penting col-lg-8 p-2">
                                                <h3 class="judul-info-penting" style="font-weight: bold">{{ sanitizeString($info_penting->judul) }}</h3>
                                                <p>{!! sanitizeString($info_penting->narasi) !!}</p>
                                            </div> --}}
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleCaptions1" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleCaptions1" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container d-flex justify-content-center animate__animated box pt-5">
            <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    
                    <div class="carousel-item active image-slider">
                        <a href="" style="text-decoration: none;color:#05254d">
                            <div class="info-penting-card d-flex flex-wrap">
                                <div class="col-lg-12">
                                    <img class="img-fluid" src="{{ asset('assets/images/sby may fest/1.png') }}">
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="carousel-item image-slider">
                        <a href="" style="text-decoration: none;color:#05254d">
                            <div class="info-penting-card d-flex flex-wrap">
                                <div class="col-lg-12 d-flex justify-content-center">
                                    <img class="img-fluid" src="{{asset('assets/images/sby may fest/22.png')}}">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="carousel-item image-slider">
                        <a href="" style="text-decoration: none;color:#05254d">
                            <div class="info-penting-card d-flex flex-wrap">
                                <div class="col-lg-12 d-flex justify-content-center">
                                    <img class="img-fluid" src="{{asset('assets/images/sby may fest/33.png')}}">
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="carousel-control-prev" type="button"
                        data-bs-target="#carouselExampleCaptions3" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button"
                        data-bs-target="#carouselExampleCaptions3" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div> --}}
        
      {{--  <div class="w3-content w3-display-container" style="display: flex;justify-content:center">
      
          <img class="mySlides" style="width:400px;height:600px" src="{{ asset('assets/images/sby may fest/1.png') }}">
          <img class="mySlides" style="width:400px;height:600px" src="{{ asset('assets/images/sby may fest/22.png') }}">
          <img class="mySlides" style="width:400px;height:600px" src="{{ asset('assets/images/sby may fest/33.png') }}">

        <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
        <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
      </div>  --}}

        <div class="video-slider d-flex justify-content-center align-items-center animate__animated box"
            style="background-image: url('{{ asset('assets/images/backgrounds/bg web bkpsdm 2.png') }}')">
            <div class="container p-5">
                <div id="carouselExampleCaptions2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        {{-- @php
                            $animasi = [
                                'Pedoman Pakaian Dinas Pemkot Surabaya.mp4',
                                'ssf.mp4',
                                'etika bermedsos.mp4',
                                'anti narkoba.mp4',
                                'Dasar Hukum Jam Kerja ASN di Lingkungan Pemerintah Kota Surabaya.mp4',
                                'gratifikasi.mp4',
                            ];
                            $slug = [
                                'pedoman-pakaian-dinas',
                                'surabaya-shoping-festival',
                                'etika-bermedsos',
                                'anti-narkoba',
                                'dasar-hukum-jam-kerja',
                                'gratifikasi'
                            ];
                            $judul_animasi = [
                                'Pedoman Pakaian Dinas',
                                'Surabaya Shopping Festival',
                                'Bijak Bersosmed !',
                                'Anti Narkoba',
                                'Dasar Hukum Jam Kerja ASN di Lingkungan Pemerintah Kota Surabaya',
                                'Tolak Gratifikasi !',
                            ];
                            $jumlah_animasi = count($animasi);

                            $animasiData = [];
                            for ($i = 0; $i < count($animasi); $i++) {
                                $animasiData[] = [
                                    'video' => $animasi[$i],
                                    'slug' => $slug[$i],
                                    'judul' => $judul_animasi[$i]
                                ];
                            }
                            
                        @endphp --}}
                        @php
                            $animasi = DB::table('animasi')
                                            ->orderBy('created_at','desc')
                                            ->get();
                        @endphp
                        @foreach ($animasi as $index => $item)
                            <button type="button" data-bs-target="#carouselExampleCaptions2"
                                data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                        {{-- @for ($i = 0; $i < $jumlah_animasi; $i++)
                            <button type="button" data-bs-target="#carouselExampleCaptions2"
                                data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"
                                aria-current="{{ $i === 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $i + 1 }}"></button>
                        @endfor --}}
                    </div>
                    <div class="carousel-inner">
                        @foreach ($animasi as $index => $item)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <a href="{{ route('pembinaan.detail', ['slug' => $item->slug]) }}"
                                    onmouseover="document.getElementById('video{{ $index }}').play()"
                                    onmouseout="document.getElementById('video{{ $index }}').pause()">
                                    <video style="width: 100%; height: 100%" playsinline autoplay muted loop>
                                        <source src="{{ asset('storage/animasi/' . $item->file) }}" type="video/mp4">
                                    </video>
                                </a>
                            </div>
                        @endforeach
                        {{-- @foreach ($animasiData as $index => $video)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <a href="{{ route('pembinaan.detail', ['slug' => $video['slug']]) }}"
                                    onmouseover="document.getElementById('video{{ $index }}').play()"
                                    onmouseout="document.getElementById('video{{ $index }}').pause()">
                                    <video style="width: 100%; height: 100%" playsinline autoplay muted loop>
                                        <source src="{{ asset('storage/animasi/' . $video['video']) }}" type="video/mp4">
                                    </video>
                                </a>
                            </div>
                        @endforeach --}}
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions2"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions2"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
        </div>

        <div class="container pt-5">
            <div class="row justify-content-center">
                <h1 class="text-center">Layanan BKPSDM</h1>
                {{-- <h6 class="text-center">Layanan yang dapat di akses pada Badan Kepegawaian dan Pengembangan Sumber Daya
                    Manusia Kota Surabaya</h6> --}}
                <div class="row flex-wrap justify-content-center mt-5 container-layanan">
                    <div class="card layanan-card col-lg-3 col-sm-12 m-3 pb-3">
                        <div class="card-body justify-content-center text-center">
                            <img src="{{ asset('assets/icons/pembinaan.png') }}" class="img-fluid mx-auto d-block"
                                style="max-width: 100%;" alt="">
                            <h5 class="text-center font-weight-bold">Pembinaan</h5>
                            <br>
                            {{-- <p class="text-center">Pembinaan Pegawai yang di adakan BKPSDM Kota Surabaya</p> --}}
                        </div>
                        <a href="{{route('coming_soon')}}" class="button-dark">Read More</a>
                    </div>
                    <div class="card layanan-card col-lg-3 col-sm-12 m-3 pb-3">
                        <div class="card-body justify-content-center text-center">
                            <img src="{{ asset('assets/icons/layanan.png') }}" class="img-fluid mx-auto d-block"
                                style="max-width: 100%;" alt="">
                            <h5 class="text-center font-weight-bold">Layanan Kepegawaian</h5>
                            <br>
                            {{-- <p class="text-center">Dengan menyediakan info layanan kepegawaian yang dapat di akses
                                melalui
                                website resmi BKPSDM Surabaya</p> --}}
                        </div>
                        <a href="{{route('coming_soon')}}" class="button-dark">Read More</a>
                    </div>
                    <div class="card layanan-card col-lg-3 col-sm-12 m-3 pb-3">
                        <div class="card-body justify-content-center text-center">
                            <img src="{{ asset('assets/icons/pengembangan.png') }}" class="img-fluid mx-auto d-block"
                                style="max-width: 100%;" alt="">
                            <h5 class="text-center font-weight-bold">Pengembangan Kompetensi</h5>
                            <br>
                            {{-- <p class="text-center">Pengembangan kompetensi SN Kota Surabaya</p> --}}
                        </div>
                        <a href="{{route('coming_soon')}}" class="button-dark">Read More</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="container mt-5">
            <div class="row">
                <h1 class="text-center">PUBLIKASI</h1>
                {{-- <h6 class="text-center">Berita terbaru dari segala aspek yang berkaitan dengan Badan Kepegawaian dan
                    Pengembangan Sumber Daya Manusia Kota Surabaya</h6> --}}
            </div>
            {{-- @include('web.slider.slider-berita') --}}
            <div id="myCarousel" class="carousel carousel-1 carousel-2 slide container mb-4"
                data-bs-ride="carousel carousel-1">
                <div class="carousel-inner carousel-inner-1 w-100">
                    @php
                        $berita = DB::table('berita')
                                    ->where('aktif', 1)
                                    ->orderBy('created_at', 'desc')
                                    ->limit(8)
                                    ->get();

                    @endphp
                    @foreach ($berita as $key => $berita_item)
                        <div class="carousel-item carousel-item-1 {{ $key === 0 ? 'active' : '' }}">
                            <div class="col-md-3 p-2">
                                <div class="card p-2 shadow-sm" style="height: 100%">
                                    <img class="img-fluid" src="{{ asset('storage/' . $berita_item->foto) }}" />
                                    <div class="card-body d-flex row">
                                        <h5 class="card-title">
                                            {{ sanitizeString(strlen($berita_item->judul) > 70 ? substr($berita_item->judul, 0, 70) . '...' : $berita_item->judul) }}
                                        </h5>
                                        {{-- <p class="card-text">{{ strlen(html_entity_decode($berita_item->narasi)) > 70 ? substr(html_entity_decode($berita_item->narasi), 0, 70) . '...' : html_entity_decode($berita_item->narasi) }}</p> --}}
                                        <a href="{{ route('berita.detail', ['slug' => $berita_item->slug]) }}" class="button-dark">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="container mt-5 mb-5 p-3 card">
                <div class="row">
                    <h1 class="text-center">GALERI</h1>
                </div>
            <div class="container d-flex flex-wrap justify-content-around">
                @php
                    $foto_kegiatan = DB::table('foto_kegiatan')
                                        ->join('lampiran_foto_kegiatan', function ($join) {
                                            $join->on('lampiran_foto_kegiatan.id_foto_kegiatan', '=', 'foto_kegiatan.id')
                                                ->whereRaw('lampiran_foto_kegiatan.id = (select id from lampiran_foto_kegiatan where id_foto_kegiatan = foto_kegiatan.id limit 1)');
                                        })
                                        ->orderBy('foto_kegiatan.id', 'desc')
                                        ->take(8)
                                        ->get();
                
                @endphp

                @foreach ($foto_kegiatan as $foto)
                <a href="foto-kegiatan/{{$foto->slug}}">
                    <div class="card m-3"
                    style="width: 18rem;transition: transform 0.3s ease-in-out;"
                            onmouseover="this.style.transform='scale(1.1)'" 
                            onmouseout="this.style.transform='scale(1)'"
                    >
                        <div 
                            style="height: 100%; width: 100%; position: absolute; background-color: rgba(0,0,0,0); display:flex; justify-content:flex-end; transition: background-color 0.3s;"
                            onmouseover="this.style.backgroundColor='rgba(0,0,0,0.5)'; this.querySelector('.judul').style.color='white';" 
                            onmouseout="this.style.backgroundColor='rgba(0,0,0,0)'; this.querySelector('.judul').style.color='transparent';"
                        >
                            <div class="p-3" style="position: absolute; bottom: 5px;color: rgba(0,0,0,0)">
                                <p class="judul">{{ $foto->judul }}</p>
                            </div>
                        </div>
    
    
                        <img src="{{ asset('storage/'.$foto->file_lampiran) }}" class="card-img-top" alt="...">
                        {{-- <div class="card-body">
                        <h5 class="card-title">{{ sanitizeString($foto->judul) }}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div> --}}
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    @endif

    @yield('content')
    <footer class="footer absolute-bottom footer-container">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-lg-4 text-white p-5">
                    <h5 class="fw-bold">BKPSDM Kota Surabaya</h5>
                    <p><i class="bi bi-geo-alt-fill"></i> Jl. Jimerto No.25-27 LT. III R.24, Ketabang, Surabaya</p>
                    <p style="margin-top: -3%"><i class="bi bi-telephone-fill"></i> (031) 5466484</p>
                    <p style="margin-top: -3%"><i class="bi bi-envelope-at-fill"></i> bkpsdm@surabaya.go.id</p>
                    {{-- <ul>
                        <li style="list-style: none"><i class="bi bi-geo-alt-fill"></i> Jl. Jimerto No.25-27 LT. III R.24, Ketabang, Surabaya</li>
                        <li style="list-style: none"><i class="bi bi-telephone-fill"></i> (031) 5466484</li>
                        <li style="list-style: none"><i class="bi bi-envelope-at-fill"></i> bkpsdm@surabaya.go.id</li>
                    </ul> --}}
                    {{-- <h5 class="text-center">LT. III R.24, JL Jimerto, No 25-27, Ketabang, Surabaya, Jawa Timur 60272 |
                        Telp (031) 5466484, 635131</h5> --}}
                        <div>
                            {{-- <a href='http://www.freevisitorcounters.com'>Free counter</a> <script type='text/javascript' src='https://www.freevisitorcounters.com/auth.php?id=0db8012efd4ced722d22ae8c754e83c5762ef54d'></script> --}}
                            <script type="text/javascript" src="https://www.freevisitorcounters.com/en/home/counter/1179213/t/0"></script>
                        </div>
                </div>
                <div class="col-lg-4 text-white p-5">
                    <h5 class="fw-bold">Layanan</h5>
                    <a href="{{route('coming_soon')}}" style="text-decoration: none;color:white"><p><i class="bi bi-buildings-fill"></i> Gedung Diklat</p></a>
                    <a href="{{route('coming_soon')}}" style="text-decoration: none;color:white"><p style="margin-top: -3%"><i class="bi bi-newspaper"></i> Artikel</p></a>
                    <a href="{{route('coming_soon')}}" style="text-decoration: none;color:white"><p style="margin-top: -3%"><i class="bi bi-people-fill"></i> SOP & Standart Pelayanan</p></a>
                    <a href="https://drive.google.com/drive/folders/1gcGfHJxCevSoaE5GkAJvaY-ACOTl9cGj" style="text-decoration: none;color:white"><p style="margin-top: -3%"><i class="bi bi-person-workspace"></i> Materi Workshop</p></a>
                </div>
                <div class="col-lg-4 text-white p-5">
                    <h5 class="fw-bold">Media Sosial</h5>
                    <p><a style="margin-top: -3%;text-decoration: none;color:white"
                            href="https://www.instagram.com/bkpsdmsurabaya/"><i class="bi bi-instagram"></i>
                            @bkpsdmsurabaya</a></p>
                    <p><a style="margin-top: -3%;text-decoration: none;color:white"
                            href="https://www.youtube.com/@bkpsdmsurabaya"><i class="bi bi-youtube"></i> Bkpsdm
                            Surabaya</a></p>
                    <p><a style="margin-top: -3%;text-decoration: none;color:white"
                            href="https://wa.me/6282121121521"><i class="bi bi-whatsapp"></i> +62-821-2112-1521</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="footer-icon-container">

        </div>

    </footer>
    {{-- <div class="footer-container" style="background-image: url('{{ asset('assets/images/background/bg_web_bkpsdm_1920x800.png') }}')">

    </div> --}}


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(".carousel-1 .carousel-item-1").each(function() {
            var minPerSlide = 4;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(":first");
            }
            next.children(":first-child").clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(":first");
                }
                next.children(":first-child").clone().appendTo($(this));
            }
        });
    </script>
    <script>
        // Enable dropdown-submenu functionality on hover
        document.querySelectorAll('.dropdown-submenu').forEach(function(element) {
            element.addEventListener('mouseover', function(e) {
                // stop the default behavior
                e.preventDefault();
                e.stopPropagation();
                // open the dropdown submenu
                this.querySelector('.dropdown-menu').classList.add('show');
            });
            element.addEventListener('mouseleave', function(e) {
                // close the dropdown submenu
                this.querySelector('.dropdown-menu').classList.remove('show');
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("scroll", function() {
                const boxes = document.querySelectorAll(".box");

                boxes.forEach(function(box) {
                    const boxTop = box.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;

                    if (boxTop < windowHeight) {
                        box.classList.add("animate__fadeIn");
                    } else {
                        box.classList.remove("animate__fadeIn");
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdowns = document.querySelectorAll('.dropdown-submenu .dropdown-toggle');
    
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('click', function(event) {
                    event.preventDefault();
                    var submenu = dropdown.nextElementSibling;
                    if (submenu) {
                        if (submenu.style.display === 'block') {
                            submenu.style.display = 'none';
                        } else {
                            submenu.style.display = 'block';
                        }
                    }
                });
            });
        });
    </script>
    
</body>

</html>
