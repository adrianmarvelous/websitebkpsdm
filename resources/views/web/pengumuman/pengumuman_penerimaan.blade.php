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
                    <div class="mr-auto">

                        <h1 class="title-pengumuman-container animate__animated animate__heartBeat animate__infinite">Pengumuman Penerimaan PPPK 2023</h1>
                        <div class="type-pppk">
                          @php
                              $jenis = array('Teknis','Guru','Kesehatan');
                              $jumlah = count($jenis);
                              $pengumuman = array('assets/pppk2023/010_Pengumuman_PPPK_JF_Teknis_2023.pdf',
                                                'assets/pppk2023/010_Pengumuman_PPPK_JF_Guru_2023.pdf',
                                                'assets/pppk2023/010_Pengumuman_PPPK_JF_Kesehatan_2023.pdf');
                              $lampiran = array('assets/pppk2023/020_Lampiran_Pengumuman_PPPK_Teknis.pdf',
                                                'assets/pppk2023/020_Lampiran_Pengumuman_PPPK_Guru_01.pdf',
                                                'assets/pppk2023/020_Lampiran_Pengumuman_PPPK_Nakes_01.pdf',
                                                'assets/pppk2023/030_Lampiran_Pengumuman_PPPK_Nakes_02.pdf');
                              $revisi = array('assets/pppk2023/Refisi_Pengumuman_Teknis_2023.pdf',
                                              'assets/pppk2023/Refisi_Pengumuman_Guru_2023.pdf',
                                              'assets/pppk2023/Ref_Pengumuman_Kesehatan_2023.pdf');
                          @endphp
                          @for ($i = 0; $i < $jumlah; $i++)
                            <div class="card-pppk">
                              <p class="title-pppk">{{$jenis[$i]}}</p>
                              <ul>
                                <li>
                                  <a href="{{$pengumuman[$i]}}">Pengumuman PPPK JF {{$jenis[$i]}} 2023</a>
                                </li>
                                <li>
                                  <a href="{{$revisi[$i]}}">Revisi Pengumuman PPPK JF {{$jenis[$i]}} 2023</a>
                                </li>
                                @php
                                    if($jenis[$i] == "Kesehatan"){
                                @endphp
                                <li>
                                  <a href="{{$lampiran[$i]}}">Lampiran 1</a>
                                </li>
                                <li>
                                  <a href="{{$lampiran[$i+1]}}">Lampiran 2</a>
                                </li>
                                @php
                                    }else{
                                @endphp
                                <li>
                                  <a href="{{$lampiran[$i]}}">Lampiran</a>
                                </li>
                                @php
                                }
                                @endphp
                              </ul>
                            </div>
                          @endfor
                        </div>
                        <div class="lampiran-lainnya">
                          <p class="title-lainnya">Dokumen Persyaratan Lainnnya :</p>
                          <ul>
                            <li><a target="_blank" href="{{asset('assets/pppk2023/030_Surat_Lamaran_Pekerjaan.pdf')}}">Surat Lamaran Pekerjaan</a></li>
                            <li><a target="_blank" href="{{asset('assets/pppk2023/040_Surat_Pernyataan.pdf')}}">Surat Pernyataan</a></li>
                            <li><a target="_blank" href="{{asset('assets/pppk2023/050_Surat_Keterangan_Pengalaman_Kerja.pdf')}}">Surat Keterangan Pengalaman Kerja Formasi Umum</a></li>
                            <li><a target="_blank" href="{{asset('assets/pppk2023/Surat Keterangan Pengalaman Kerja bagi formasi Khusus.pdf')}}">Surat Keterangan Pengalaman Kerja Formasi Khusus</a></li>
                            <li><a target="_blank" href="{{asset('assets/pppk2023/060_Surat_Keterangan_Disabilitas.pdf')}}">Surat Keterangan Disabilitas</a></li>
                            <li><a target="_blank" href="{{asset('assets/pppk2023/Surat Pengantar Keterangan Pengalaman Kerja bagi Kecamatan.pdf')}}">Surat Pengantar Keterangan Pengalaman Kerja bagi Kecamatan</a></li>
                            <li><a target="_blank" href="{{asset('assets/pppk2023/650_KEPMENPANRB_TENTANG_PERSYARATAN_WAJIB_TAMBAHAN___SERTIFIKASI_KOMPETENSI_-_BAGI_PPPPK_-_SBY.pdf')}}">KEPMENPANRB Tentang Persyaratan Wajib Tambahan Sertifikasi Kompetensi bagi PPPK</a></li>
                          </ul>
                        </div>
                        <div class="faq-pppk">
                          <p class="title-lainnya">Frequently Asked Questions</p>
                          <div class="faq-img-container">
                            @php
                                $judul = array('faq 1.mp4','faq 2.mp4','faq 3.mp4');
                                $jumlah = count($judul);
                            @endphp
                            @for ($i = 0; $i < $jumlah; $i++)
                              <div onmouseover="document.getElementById('video').play()" onmouseout="document.getElementById('video').pause()">
                                <video width="350" playsinline autoplay muted loop onmouseover="this.play()" onmouseout="this.pause()" id="video">
                                  <source src="{{asset('assets/icons/home/faq/faq 1.mp4')}}" type="video/mp4">
                                </video>
                              </div>
                            @endfor
                          </div>
                        </div>
                    </div>

              </div>
            </div>


          </div>
        </div> 
      </div> 



    </section>



@endsection

