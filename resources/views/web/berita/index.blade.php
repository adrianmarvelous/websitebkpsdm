@extends('web.index')


@section('content')


<section>
      <div class="container pt-12 mb-5">
        <div class="row">
          
          <div class="col-12 col-md-12 col-lg-12 ">
            <div class="jdl-head-search">Berita</div>
            
            @foreach($all as $oll)
            <!-- Card -->
            <div class="card shadow-lg mb-2">
            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
             
              <div class="card-body">
                
                
                  
                    
                    <!-- Text -->
                    <div class="mr-auto">
              
                      
                        <div class="row">
                            <div class="col-md-3">
                                @if($oll->foto)
                                    <img width="100%" src="{{asset('storage/'.$oll->foto)}}" />
                                @else
                                    <img src="{{asset('assets/images/no-image-available.png')}}" width="100%">
                                @endif
                            </div>
                            <div class="col-md-9">
                                <h3 style="font-weight: bold"><a href="{{route('berita.detail', ['slug' => $oll->slug])}}">{{sanitizeString($oll->judul)}}</a></h3>
                                <small>{{tanggal_hari('D, j M Y',$oll->created_at)}}</small>
                            </div>
                        </div>
                     


                    </div>
                      
                  

                  

              </div>

                      
            </div>
            @endforeach

            {{$all->links('vendor.pagination.bootstrap-4')}}


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>



@endsection