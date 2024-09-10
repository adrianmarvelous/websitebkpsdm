@extends('web.index')


@section('content')


<section>
      <div class="container pt-13 mb-5">
        <div class="row align-items-center">
          
          <div class="col-12 col-md-12 col-lg-12 ">
            
            <!-- Card -->
            <div class="card shadow-lg mb-2">
            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
              <div class="card-body">
                
                <!-- List group -->
                    
                    <!-- Text -->
                    <div class="mr-auto pb-15">

                      {{-- <ul class="breadcrumb">
                        <li><a href="{{route('index_web')}}">HOME</a></li>
                        <li><a href="javascript:void(0)">KONTEN DINAMIS</a></li>
                      </ul> --}}
                      
                      <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{route('index_web')}}">HOME</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><a href="javascript:void(0)">KONTEN DINAMIS</a></li>
                        </ol>
                      </nav>
              
                      <h2 class="font-weight-bold mb-1">
                        {{$load_content->judul_konten ?? 'Judul belum ada'}}
                      </h2>
{{-- 
                      @if($load_content->foto)
                      <div class="image">
                        <img width="100%" src="{{asset('storage/'.$load_content->foto)}}" />
                      </div>
                      @endif --}}
                      
                      @if($load_content->foto)
                      <div class="form-group row mb-3">
                          <label for="foto" class="col-md-3 col-form-label"></label>
                          <div class="w-100">
                              @php
                                  $filePath = 'storage/' . $load_content->foto;
                                  $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                              @endphp

                              @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                                  <img width="100%" src="{{ asset($filePath) }}" alt="Image File" />
                              @elseif($extension === 'mp4')
                                  <video width="100%" controls>
                                      <source src="{{ asset($filePath) }}" type="video/mp4">
                                      Your browser does not support the video tag.
                                  </video>
                              @else
                                  <p>Unsupported file type</p>
                              @endif
                          </div>
                      </div>
                  @endif

                      <!-- Text -->
                      <p class="font-size-sm mb-0 mt-4">
                        {!!$load_content->narasi ?? 'Konten untuk halaman ini belum tersedia'!!}
                      </p>

                      @foreach ($lampiran as $data)
                        @if ($data->id_konten == $load_content->id)
                        <div class="alert alert-warning" style="display: block"> <a target="_blank" href="{{asset('storage/'.$data->file_lampiran)}}">
                          <svg class="bi" width="21" height="21" fill="#007bff">
                            <use xlink:href="{{asset('assets')}}/icons/bootstrap-icons.svg#download"/>
                          </svg>
                          [DOWNLOAD] - {{$data->judul_lampiran}}</a>
                        </div>
                        @endif
                          
                      @endforeach

                    </div>
                      
                  


              </div>
            </div>


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>



@endsection