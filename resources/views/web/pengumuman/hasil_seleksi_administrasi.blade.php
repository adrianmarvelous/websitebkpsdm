@extends('web.index')


@section('content')


<section>
      <div class="container  pt-13">
        <div class="row">
          
          <div class="col-12 col-md-12 col-lg-12 ">
            
            <!-- Card -->
            <div class="card shadow ">
            <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
              <div class="card-body">
                
                <!-- List group -->
                  
                    
                    <!-- Text -->
                    <div class="mr-auto" >

                        <h1 class="title-pengumuman-container">Pengumuman Hasil Pasca Sanggah Seleksi Administrasi PPPK TA 2023</h1>
                        <div class="type-pppk">
                            @php
                            $jenis = array('Teknis','Guru','Kesehatan');
                            $judul = array('Lampiran Pengumuman PPPK JF Teknis',
                                            'Lampiran Pengumuman PPPK JF Guru',
                                            'Lampiran Pengumuman PPPK JF Kesehatan');
                            $file = array('assets/pppk2023/pasca_sanggah_Lampiran_Teknis.pdf',
                                            'assets/pppk2023/pasca_sanggah_Lampiran_Guru.pdf',
                                            'assets/pppk2023/pasca_sanggah_Lampiran_Kesehatan.pdf');
                            $jumlah = count($jenis);
                        @endphp
                          @for ($i = 0; $i < $jumlah; $i++)
                            <div class="card-pppk">
                              <p class="title-pppk">{{$jenis[$i]}}</p>
                              <ul>
                                <li>
                                    <a href="{{$file[$i]}}">{{$judul[$i]}} 2023</a>
                                </li>
                              </ul>
                            </div>
                          @endfor
                        </div>
                        <ul style="margin-top: 50px">
                            <li>
                                
                          <a style="font-size: 24px" href="assets/pppk2023/Pengumuman Pasca Sanggah PPPK 2023 v2.pdf">Pengumuman Hasil Pasca Sanggah Seleksi Administrasi PPPK TA 2023</a>
                            </li>
                        </ul>
                    </div>

              </div>
            </div>


          </div>
        </div> 
      </div> 



    </section>



@endsection

