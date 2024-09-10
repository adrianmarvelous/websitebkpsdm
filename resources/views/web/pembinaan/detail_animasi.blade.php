@extends('web.index')


@section('content')


<section>
      <div class="container pt-13 p-4">
        <div class="row">
          
          <div class="col-12 col-md-12 col-lg-12 ">
            
            <!-- Card -->
            <div class="card shadow ">
            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
              <div class="card-body">
                
                <!-- List group -->
                    
                    <!-- Text -->
                    <div class="mr-auto">
                        <p class="display-5">{{$animasi->judul}}</p>
                        {{-- <video style="width: 100%; height: 100%" playsinline autoplay loop>
                            <source src="{{ asset('storage/animasi/' . $animasi->file) }}" type="video/mp4">
                        </video> --}}
                        <video width="100%" autoplay controls id="video">
                          <source src="{{ asset('storage/animasi/' . $animasi->file) }}" type="video/mp4">
                        </video>

                    </div>                  

              </div>
            </div>


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->

    </section>



@endsection
