@extends('web.index')


@section('content')


<section>
      <div class="container pt-12 mb-5">
        <div class="row">
          
          <div class="col-12 col-md-12 col-lg-12 ">
            <div class="jdl-head-search">Artikel {{$kategori}}</div>
            
            @foreach($data as $oll)
            <!-- Card -->
            <div class="card shadow-lg mb-2">
            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
             
              <div class="card-body">
                
                  
                    
                    <!-- Text -->
                    <div class="mr-auto">
              
                      
                        <div class="row">
                            <div class="col-md-9">
                                <h3 style="font-weight: bold"><a href="/artikel/detail/{{$oll->id}}">{{$oll->judul}}</a></h3>
                                <small>{{tanggal_hari('D, j M Y',$oll->tanggal)}}</small>
                            </div>
                        </div>
                     


                    </div>
                      
                  

                  

              </div>

                      
            </div>
            @endforeach

            {{$data->links('vendor.pagination.bootstrap-4')}}
          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>



@endsection