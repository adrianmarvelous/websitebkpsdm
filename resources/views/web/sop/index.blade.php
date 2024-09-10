@extends('web.index')


@section('content')


<section>
      <div class="container pt-12 mb-5">
        <div class="row">
          
          <div class="col-12 col-md-12 col-lg-12 ">
            <div class="jdl-head-search">SOP & Standart Pelayanan</div>
            
            <!-- Card -->
            <div class="card shadow-lg mb-2">
            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
             
              <div class="card-body">
                    <!-- Text -->
                    <div class="mr-auto">
                        <div class="row" style="display:flex;padding:30px;flex-direction:column">
                          @foreach ($sop as $data)
                          <div class="alert alert-warning" style="display: block"> 
                            <a target="_blank" href="{{asset('assets/slide_show/sop/'.$data->file)}}">
                            <svg class="bi" width="21" height="21" fill="#007bff">
                              <use xlink:href="{{asset('assets')}}/icons/bootstrap-icons.svg#download"/>
                            </svg>
                            [DOWNLOAD] - {{$data->judul}}</a>
                          </div>
                          @endforeach
                          <a href="/sop/slide_show" class="btn btn-primary" target="_blank">Slide Show</a>
                        </div>
                    </div>
              </div>
            </div>
          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>



@endsection