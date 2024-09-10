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
                                <img class="w-100" src="{{ asset('assets/images/cpns_pppk/cover cpns.png') }}" alt="">
                                <div class="row d-flex justify-content-center">
                                    <div class="card col-lg-3 m-3 p-3">
                                        <img class="w-100" src="{{ asset('assets/images/cpns_pppk/jadwal 1.jpeg') }}" alt="">
                                        <a href="{{ route('info-cpns.post',['slug' => 'jadwal_cpns']) }}" class="btn btn-info mt-3" style="border-radius: 20px;font-weight:bold">Selengkapnya</a>
                                    </div>
                                    <div class="card col-lg-3 m-3 p-3">
                                        <img class="w-100" src="{{ asset('assets/images/cpns_pppk/press release 1.jpeg') }}" alt="">
                                        <a href="{{ route('info-cpns.post',['slug' => 'press_release_cpns']) }}"  class="btn btn-info mt-3" style="border-radius: 20px;font-weight:bold;">Selengkapnya</a>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div class="bg-container mx-auto">
                                        <a href="https://bit.ly/helpdeskCPNS24" class="button" style="text-decoration: none">Help Desk</a>
                                    </div>
                                </div>
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped table-hover">
                                        <tr class="table-primary">
                                            <td>Tahap</td>
                                            <td>Tanggal</td>
                                            <td>Lampiran</td>
                                            <td>Aksi</td>
                                        </tr>
                                        @php
                                            $judul = array(
                                                    'Pengumuman Pengadaan CPNS TA 2024',
                                                    'Lampiran Pengumuman Pengadaan CPNS TA 2024',
                                                    'Contoh Format Surat Lamaran',
                                                    'Contoh Format Surat Pernyataan 5 Point',
                                                    'Contoh Format Surat Persyaratan Tidak Mengajukan Pindah Paling Singkat 10 Tahun Sejak diangkat CPNS',
                                                    'Contoh Format Surat Keterangan Disabilitas',
                                                    'Persyaratan Kualifikasi Pendidikan dan Surat Tanda Registrasi Dalam rangka Pengadaan CPNS jABATAN fUNGSIONAL kESEHATAN 2024',
                                                    );
                                            $file = array(
                                                    'info-penting/1724112791_file_lampiran.pdf',
                                                    'info-penting/1724112820_file_lampiran.pdf',
                                                    'info-penting/1724112856_file_lampiran.pdf',
                                                    'info-penting/1724112908_file_lampiran.pdf',
                                                    'info-penting/1724113007_file_lampiran.pdf',
                                                    'info-penting/1724113042_file_lampiran.pdf',
                                                    'info-penting/1724113135_file_lampiran.pdf',
                                                    );
                                        @endphp
                                        @for ($i = 0; $i < count($judul); $i++)
                                        <tr>
                                            <td>Pengumuman</td>
                                            <td style="width: 120px">19 Agt 2024</td>
                                            <td>{{ $judul[$i] }}</td>
                                            <td><a class="btn btn-primary" href="{{asset('storage/'.$file[$i]) }}" target="_blank">Download</a></td>
                                        </tr>
                                        @endfor
                                    </table>
                                </div>
                            </div>



                        </div>
                    </div>


                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->


    </section>
@endsection
