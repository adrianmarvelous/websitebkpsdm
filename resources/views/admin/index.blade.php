<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Web Administrator | BKD Kota Surabaya</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- Deklarasi token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="{{asset('assets/admin')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin')}}/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <!-- <link href="{{asset('assets/admin')}}/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" /> -->
        <link href="{{asset('assets/admin')}}/fonts/nunito/nunito.css" rel="stylesheet">

        <!-- Summernote css -->
        <link href="{{asset('assets/admin/plugins')}}/summernote/summernote-bs4.css" rel="stylesheet" type="text/css" />

        @yield('custom_css')

    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"light","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">
    
                <!-- LOGO -->
                <a href="index.html" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="{{asset('assets/admin')}}/images/logo.png" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('assets/admin')}}/images/logo_sm.png" alt="" height="16">
                    </span>
                </a>

                <!-- LOGO -->
                <a href="{{route('dashboard.index')}}" class="logo text-center logo-dark">
                    <span class="logo-lg pt-1">
                        <H3>WEB BKD</H3>
                    </span>
                    <!-- <span class="logo-sm">
                        <img src="{{asset('assets/admin')}}/images/logo_sm_dark.png" alt="" height="16">
                    </span> -->
                </a>
    
                <div class="h-100" id="left-side-menu-container" data-simplebar>

                    <!--- Sidemenu -->
                    <ul class="metismenu side-nav">

                        <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                

                        @php
                        // if(session('logged_in.role') == 1 || session('logged_in.role') == 2 || session('logged_in.role') == 3){
                        /* TAMPILKAN MENU STATIS */
                        $categories = \App\Models\M_menu_admin::Recursive()->get();
                        @endphp

                        @foreach ($categories as $category)
                            <li class="side-nav-item mm-active">
                                <a href="javascript: void(0);" class="side-nav-link active">
                                    <i class="uil-document-layout-center"></i>
                                    <span> {{$category->nama_menu}} </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                @if(count($category->childrenCategories) > 0)
                                    <ul class="side-nav-second-level mm-collapse mm-show" aria-expanded="false">
                                      @foreach ($category->childrenCategories as $childCategory)
                                          @include('admin.child_category', ['child_category' => $childCategory])
                                      @endforeach
                                    </ul>
                                @endif

                            </li>
                        @endforeach
                        <li class="side-nav-item mm-active">
                            <a href="javascript: void(0);" class="side-nav-link active">
                                <i class="uil-document-layout-center"></i>
                                <span> Slide Show </span>
                                <span class="menu-arrow"></span>
                            </a>
                                <ul class="side-nav-second-level mm-collapse mm-show" aria-expanded="false">
                                    <li>
                                        {{-- <a href="/dashboard/sop">
                                            SOP
                                        </a> --}}
                                        <a href="{{ route('dashboard.animasi.index') }}">Animasi</a>
                                    </li>
                                </ul>
                        </li>
                                  
                        @php
                        // }elseif(session('logged_in.role') == 4){
                        @endphp
                        {{-- <li class="side-nav-item mm-active">
                                <a href="javascript: void(0);" class="side-nav-link">
                                    <i class="uil-document-layout-center"></i>
                                    <span> Artikel </span>
                                    @if($jumlah_artikel > 0)
                                    <span style="padding:5px;border-radius:50px;background-color:red;color:white">{{$jumlah_artikel}}</span>
                                    @endif
                                    <span class="menu-arrow"></span>
                                </a>
                                    <ul class="side-nav-second-level mm-collapse mm-show" aria-expanded="false">
                                        <li>
                                            <a href="/dashboard/artikel/populer">
                                                Populer
                                            </a>
                                            <a href="/dashboard/artikel/ilmiah">
                                                Ilmiah
                                            </a>
                                            <a href="/dashboard/artikel/opini">
                                                Opini
                                            </a>
                                            <a href="/dashboard/artikel/pengajuan">
                                                Pengajuan
                                            @if($jumlah_artikel > 0)
                                            <span style="padding:5px;border-radius:50px;background-color:red;color:white">{{$jumlah_artikel}}</span>
                                            @endif
                                            </a>
                                        </li>
                                    </ul>
                        </li> --}}
                        @php
                        // }elseif(session('logged_in.role') == 5){
                        @endphp
                            {{-- <li class="side-nav-item mm-active">
                                <a href="javascript: void(0);" class="side-nav-link active">
                                    <i class="uil-document-layout-center"></i>
                                    <span> Jadwal Rapat </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                    <ul class="side-nav-second-level mm-collapse mm-show" aria-expanded="false">
                                        <li>
                                            <a href="/dashboard/jadwal_rapat/index">
                                                List Jadwal Rapat
                                            </a>
                                        </li>
                                    </ul>
                            </li>
                            <li class="side-nav-item mm-active">
                                <a href="javascript: void(0);" class="side-nav-link">
                                    <i class="uil-document-layout-center"></i>
                                    <span> Dokumen Perencanaan </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                    <ul class="side-nav-second-level mm-collapse mm-show" aria-expanded="false">
                                        <li>
                                            @php
                                                $nama_dokumen = array("RPJMD","Rencana Strategis","Rencana Kerja","Perjanjian Kinerja","Laporan Kinerja","Penilaian Resiko","Indikator Kinerja Operasional","Proses Bisnis","Standar Operasional Prosedur","Paparan","Pendampingan Inspektorat","Monitoring","Maturitas SPIP","Reformasi Birokrasi","SAKIP");
                                                $jumlah = count($nama_dokumen);
                                                for ($i=0; $i < $jumlah; $i++) { 
                                            @endphp
                                            <a href="/dashboard/dokumen_perencanaan/index/{{$nama_dokumen[$i]}}">
                                                {{$nama_dokumen[$i]}}
                                            </a>
                                            @php
                                                }
                                            @endphp
                                        </li>
                                    </ul>
                            </li>
                            <li class="side-nav-item mm-active">
                                <a href="javascript: void(0);" class="side-nav-link active">
                                    <i class="uil-document-layout-center"></i>
                                    <span> Realisasi Anggaran </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                    <ul class="side-nav-second-level mm-collapse mm-show" aria-expanded="false">
                                        <li>
                                            <a href="/dashboard/realisasi/index">
                                                Realisasi Terhadap Anggaran
                                            </a>
                                        </li>
                                    </ul>
                            </li> --}}
                        @php
                        // }elseif(session('logged_in.role') == 4){
                        @endphp
                            {{-- <li class="side-nav-item mm-active">
                                <a href="javascript: void(0);" class="side-nav-link active">
                                    <i class="uil-document-layout-center"></i>
                                    <span> Sigendis </span>
                                    @if($jumlah_sigendis > 0)
                                    <span style="padding:5px;border-radius:50px;background-color:red;color:white">{{$jumlah_sigendis}}</span>
                                    @endif
                                    <span class="menu-arrow"></span>
                                </a>
                                    <ul class="side-nav-second-level mm-collapse mm-show" aria-expanded="false">
                                        <li>
                                            <a href="/dashboard/sigendis/index">
                                                Peminjaman Gedung Diklat
                                    @if($jumlah_sigendis > 0)
                                            <span style="padding:5px;border-radius:50px;background-color:red;color:white">{{$jumlah_sigendis}}</span>
                                    @endif
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="side-nav-second-level mm-collapse mm-show" aria-expanded="false">
                                        <li>
                                            <a href="/dashboard/sigendis/kegiatan/index">
                                                Foto Kegiatan
                                            </a>
                                        </li>
                                    </ul>
                            </li> --}}
                        @php
                        // }
                        @endphp

                       <!--  <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-folder-plus"></i>
                                <span> Multi Level </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                               
                                <li class="side-nav-item">
                                    <a href="javascript: void(0);" aria-expanded="false">Third Level
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="side-nav-third-level" aria-expanded="false">
                                        <li>
                                            <a href="javascript: void(0);">Item 1</a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="javascript: void(0);" aria-expanded="false">Item 2
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul class="side-nav-forth-level" aria-expanded="false">
                                                <li>
                                                    <a href="javascript: void(0);">Item 2.1</a>
                                                </li>
                                                <li>
                                                    <a href="javascript: void(0);">Item 2.2</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </li> -->
            
                    </ul>

                 
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        <ul class="list-unstyled topbar-right-menu float-right mb-0">
                            

                            <!-- <li class="notification-list">
                                <a class="nav-link right-bar-toggle" href="javascript: void(0);">
                                    <i class="dripicons-gear noti-icon"></i>
                                </a>
                            </li> -->

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <span class="account-user-avatar"> 
                                        <!-- <img src="assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle"> -->
                                    </span>
                                    <span>
                                        <span class="account-user-name"> {{session('logged_in')['name']}} </span>
                                        <span class="account-position">{{session('logged_in')['hak_akses']}}</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">

                                    <!-- item-->
                                    <a href="{{route('dashboard.profil_saya')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle mr-1"></i>
                                        <span>Profil Saya</span>
                                    </a>

                                    <!-- item-->
                                    <a href="{{route('dashboard.logout')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout mr-1"></i>
                                        <span>Logout</span>
                                    </a>

                                </div>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left disable-btn">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </div>
                    <!-- end Topbar -->

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        
                        @yield('content')


                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                               BKD Kota Surabaya @ 2020
                            </div>
                            
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


        <!-- bundle -->
        <!-- bundle -->
        <script src="{{asset('assets/admin')}}/js/vendor.min.js"></script>
        <script src="{{asset('assets/admin')}}/js/app.min.js"></script>

        <!-- Typehead -->
        <script src="{{asset('assets/admin')}}/js/handlebars.min.js"></script>
        <!-- <script src="{{asset('assets/admin')}}/js/typeahead.bundle.min.js"></script> -->

        <script src="{{asset('assets/admin/plugins')}}/summernote/summernote-bs4.min.js"></script>
        <script src="{{asset('assets/admin/plugins')}}/summernote/demo.summernote.js"></script>
        <script src="{{asset('assets/admin/plugins')}}/swal/sweetalert2@10.js"></script>

        {{--<script src="{{ asset('assets/admin/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin/plugins/ckeditor/adapters/jquery.js') }}" type="text/javascript"></script>--}}

        <!-- Demo -->
        <!-- <script src="{{asset('assets/admin')}}/js/demo.typehead.js"></script> -->
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @yield('custom_js')
        
    </body>
</html>
