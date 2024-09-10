@extends('web.index')


@section('content')


<section>
      <div class="container py-10">
        <div class="row">
          
          <div class="col-12 col-md-12 col-lg-12 ">
            <div class="jdl-head-search"> {{$judul}} </div>
            
            @if($result)
            {{-- INFO PENTING --}}
            <h2>Info Penting</h2>


            
            @forelse($result as $oll)
            <!-- Card -->
            <div class="card shadow mb-2">
            <!-- <div class="card card-border border-success shadow mb-2" data-aos="fade-up"> -->
             
              <div class="card-body">
                
                <!-- List group -->
                <div class="list-group list-group-flush">
                  
                  <div class="list-group-item d-flex align-items-center">
                    
                    <!-- Text -->
                    <div class="mr-auto">
              
                      
                        <div class="row">
                            <div class="col-md-3">
                              <a href="{{route('info-penting.detail', ['slug' => $oll->slug])}}">
                                @if($oll->foto)
                                    <img width="100%" src="{{asset('storage/'.$oll->foto)}}" />
                                @else
                                    <img src="{{asset('assets/images/no-image-available.png')}}" width="100%">
                                @endif
                              </a>
                            </div>
                            <div class="col-md-9">
                                <h3 style="font-weight: bold"><a href="{{route('info-penting.detail', ['slug' => $oll->slug])}}">{{$oll->judul}}</a></h3>
                                <small>{{tanggal_hari('D, j M Y',$oll->created_at)}}</small>
                            </div>
                        </div>
                     


                    </div>
                      
                  

                  </div>
                  
                </div>

              </div>

                      
            </div>
            @empty

            <!-- Card -->
            <div class="card shadow mb-2">
            <!-- <div class="card card-border border-success shadow mb-2" data-aos="fade-up"> -->
             
              <div class="card-body">
                  Info Penting dengan kata kunci pencarian "<strong class="text-danger">{{$keyword}}</strong>" tidak ditemukan
                  <br>
                  <br>
              </div>
            </div>

            @endforelse

            {{$result->links('vendor.pagination.bootstrap-4')}}




            <hr>


            {{-- FOTO KEGIATAN --}}
            <br>
            <br>
            <h2>Kegiatan (Foto dan Video)</h2>
            <div class="row">
            @forelse($foto as $oll)
            <!-- Card -->
            <div class="col-md-6">
              <div class="card shadow mb-2">
              <!-- <div class="card card-border border-success shadow mb-2" data-aos="fade-up"> -->
               
                <div class="card-body">
                   
                    <div class="row">
                        <div class="col-md-12">
                          <a href="{{route('foto-kegiatan.detail', ['slug' => $oll->slug])}}">
                            @if(count($oll->isi_album) > 0)
                                <img width="100%" src="{{asset('storage/'.$oll->isi_album->first()->file_lampiran)}}" />
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
            @empty
            <div class="col-12 col-md-12 col-lg-12 ">
            <!-- Card -->
            <div class="card shadow mb-2">
            <!-- <div class="card card-border border-success shadow mb-2" data-aos="fade-up"> -->
             
              <div class="card-body">
                  Galeri Foto Kegiatan dengan kata kunci pencarian "<strong class="text-danger">{{$keyword}}</strong>" tidak ditemukan 
                  <br>
                  <br>
              </div>
            </div>
            </div>

            @endforelse
            </div>

            {{$foto->links('vendor.pagination.bootstrap-4')}}
            @endif

<br>

            <hr>




            @if($berita)
            {{-- BERITA --}}
            <h2>Berita Terkini</h2>


            
            @forelse($berita as $oll)
            <!-- Card -->
            <div class="card shadow mb-2">
            <!-- <div class="card card-border border-success shadow mb-2" data-aos="fade-up"> -->
             
              <div class="card-body">
                
                <!-- List group -->
                <div class="list-group list-group-flush">
                  
                  <div class="list-group-item d-flex align-items-center">
                    
                    <!-- Text -->
                    <div class="mr-auto">
              
                      
                        <div class="row">
                            <div class="col-md-3">
                              <a href="{{route('berita.detail', ['slug' => $oll->slug])}}">
                                @if($oll->foto)
                                    <img width="100%" src="{{asset('storage/'.$oll->foto)}}" />
                                @else
                                    <img src="{{asset('assets/images/no-image-available.png')}}" width="100%">
                                @endif
                              </a>
                            </div>
                            <div class="col-md-9">
                                <h3 style="font-weight: bold"><a href="{{route('berita.detail', ['slug' => $oll->slug])}}">{{$oll->judul}}</a></h3>
                                <small>{{tanggal_hari('D, j M Y',$oll->created_at)}}</small>
                            </div>
                        </div>
                     


                    </div>
                      
                  

                  </div>
                  
                </div>

              </div>

                      
            </div>
            @empty

            <!-- Card -->
            <div class="card shadow mb-2">
            <!-- <div class="card card-border border-success shadow mb-2" data-aos="fade-up"> -->
             
              <div class="card-body">
                  Berita dengan kata kunci pencarian "<strong class="text-danger">{{$keyword}}</strong>" tidak ditemukan
                  <br>
                  <br>
              </div>
            </div>

            @endforelse

            {{$berita->links('vendor.pagination.bootstrap-4')}}
            @endif

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>



@endsection