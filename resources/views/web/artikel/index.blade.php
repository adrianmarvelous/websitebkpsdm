@extends('web.index')


@section('content')


<section>
    <div class="container  py-12">
        <div class="row">
        
            <div class="col-12 col-md-12 col-lg-12 ">
                <div class="jdl-head-search">Artikel</div>
                    <div class="row">
                    <!-- Card -->
                        <div class="col-md-12">
                            <div class="card shadow-lg mb-2">
                            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
                            
                                <div class="card-body">
                                    @if (session('status'))
                                    <div style="width:100%;background-color:#98FFA0;padding:5px;border-radius:20px">
                                        <p style="color:#11471B;font-size:24px;text-align:center;font-weight:bold">{{session('status')}}</p>
                                    </div>
                                    @endif
                                    
                                    <div class="row" style="padding:50px">
                                        @php
                                            $menu = array("Populer","Ilmiah","Opini","Ajukan Artikel");
                                            $bg = array(
                                                        "pexels-ann-poan-5797900.jpg",
                                                        "pexels-jess-bailey-designs-745760.jpg",
                                                        "pexels-john-diez-7578754.jpg",
                                                        "pexels-pnw-production-8250888.jpg"
                                                        );
                                            $link = array(
                                                        "/artikel/populer",
                                                        "/artikel/ilmiah",
                                                        "/artikel/opini",
                                                        "/artikel/pengajuan"
                                                        );
                                            $jumlah = count($menu);
                                        @endphp
                                        @for ($i = 0; $i < $jumlah; $i++)
                                            <a href="{{$link[$i]}}" style="
                                                box-shadow: 5px 5px 10px 5px #888888;
                                                border:0px;
                                                height: 400px;
                                                width: 300px;
                                                background-size: 300px 400px;
                                                border-radius: 50px;
                                                padding:30px;
                                                margin:20px;
                                                font-size:32px;
                                                font-weight:bold;
                                                background-image:url({{asset('assets/images/icon_artikel/'.$bg[$i])}})
                                                ">
                                            <p style="font-family: 'Bebas Neue', cursive;text-align:center;color:black">{{$menu[$i]}}</p>
                                            </a>
                                        @endfor
                                    </div>
                                    
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