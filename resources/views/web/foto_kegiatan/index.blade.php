@extends('web.index')


@section('content')


<section>
      <div class="container  py-12">
        <div class="row">
          
          <div class="col-12 col-md-12 col-lg-12 ">
            <div class="jdl-head-search">Kegiatan</div>
            <div class="row">
            @foreach($all as $oll)
            <!-- Card -->
            <div class="col-md-6">
              <div class="card shadow-lg mb-2">
              <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
               
                <div class="card-body">
                   
                    <div class="row">
                        <div class="col-md-12">
                          <a href="{{route('foto-kegiatan.detail', ['slug' => $oll->slug])}}">
                            @if(count($oll->isi_album) > 0)
                                <img width="100%" src="{{asset('storage/'.$oll->isi_album->where('tipe', 'foto')->first()->file_lampiran)}}" />
                            @else
                                <img src="{{asset('assets/images/no-image-available.png')}}" width="100%">
                            @endif
                          </a>
                        </div>
                        <div class="col-md-12">
                            <h3 style="font-weight: bold"><a href="{{route('foto-kegiatan.detail', ['slug' => $oll->slug])}}">{{$oll->judul}}</a></h3>
                            <small>{{tanggal_hari('D, j M Y',$oll->created_at)}}</small>
                        </div>
                    </div>
                    
                </div>

                        
              </div>
            </div>
            @endforeach
            </div>

            {{$all->links('vendor.pagination.bootstrap-4')}}


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>



@endsection