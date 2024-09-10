
<div style="height:130px">
      
</div>
<div class="row slide-header" style="display:flex;">
        <div class="col-md-12 slider-head">
            <div id="carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner slide-back">
                    
                    <div class="carousel-item active"><img src="{{asset('assets/pembinaan/balai kota.jpg')}}" class="d-block w-100" style="height:450px;object-fit: none;">
                        <div style="display: flex;justify-content:center;text-align:center">
                            <div style="position: absolute;top:3%;right:60%">
                                {{-- <div class="carousel-caption"> --}}
                                <h3 class="desc-slider" >Balai Kota Surabaya</h3>
                            {{-- </div> --}}
                        </div>
                        </div>
                        {{-- <div class="carousel-caption">
                            <h3>Balai Kota Surabaya</h3>
                        </div> --}}
                    </div>
                    <div class="carousel-item"><img src="{{asset('assets/pembinaan/balai pemuda.jpeg')}}" class="d-block w-100" style="height:450px;
                        object-fit: none;">
                        <div style="display: flex;justify-content:center;text-align:center">
                            <div style="position: absolute;top:3%;right:60%">
                        {{-- <div class="carousel-caption"> --}}
                            <h3 class="desc-slider">Balai Pemuda</h3>
                        </div>
                        </div>
                    </div>
                    {{-- @php
                    $slider =   \App\Models\M_slider::where('aktif', '1')
                                ->orderByDesc('created_at')
                                ->take(20)->get();
                    $i = 1;
                    @endphp

                    @foreach($slider as $slide)
                    <div class="carousel-item {{($i==1) ?'active':''}}"><img src="{{asset('storage/'.$slide->foto)}}" class="d-block w-100" style="height:450px;
                        object-fit: none;">
                        <div class="carousel-caption">
                            <h3>{{$slide->judul}}</h3>
                        </div>
                    </div>
                    @php $i++; @endphp
                    @endforeach --}}
                                            
                </div>
                <a class="carousel-control-prev lanjut" href="#carousel" role="button" data-slide="prev">
                    <div style="padding:20px; background:orange;">
                        <svg class="fas fa-chevron-left" width="1.5em" height="1.5em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.354 3.646a.5.5 0 010 .708L7.707 10l5.647 5.646a.5.5 0 01-.708.708l-6-6a.5.5 0 010-.708l6-6a.5.5 0 01.708 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </div>
                </a>
                <a class="carousel-control-next lanjut" href="#carousel" role="button" data-slide="next">
                    <div style="padding:20px; background:orange;">
                        <svg class="fas fa-chevron-right" width="1.5em" height="1.5em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6.646 3.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L12.293 10 6.646 4.354a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Next</span>
                    </div>
                </a>
            </div>
        </div>
        {{-- <div class="col-md-5 img-surabaya">
            <div class="teks-surabaya">{{$aktif_sub_slider->judul ?? 'Badan Kepegawaian dan Diklat<br>Kota Surabaya'}}</div>
        </div> --}}
    </div>