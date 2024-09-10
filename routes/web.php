<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AnimasiHome;

Route::get('/info-penting/pengumuman-seleksi-calon-pegawai-negeri-sipil-cpns-pemerintah-kota-surabaya-tahun-anggaran-2024-1724112752', [App\Http\Controllers\Web\Home::class, 'info_cpns'])->name('info_cpns');
Route::get('/info-cpns/post/{slug}', [App\Http\Controllers\Web\InfoCpns::class, 'post'])->name('info-cpns.post');

Route::get('/', [App\Http\Controllers\Web\Home::class, 'index'])->name('index_web');
Route::get('/beranda_lama', [App\Http\Controllers\Web\Home::class, 'index_v1'])->name('index_v1');
Route::get('/statis/{slug}', [App\Http\Controllers\Web\Statis::class, 'index'])->name('statis');
Route::post('/cari', [App\Http\Controllers\Web\Home::class, 'cari'])->name('cari');
Route::get('/result/{key}', [App\Http\Controllers\Web\Home::class, 'result'])->name('result');
Route::post('/post_comment', [App\Http\Controllers\Web\Home::class, 'post_comment'])->name('post_comment');
Route::post('/refresh_capcay', [App\Http\Controllers\Web\Home::class, 'refresh_capcay'])->name('refresh_capcay');

Route::get('/coming_soon', [App\Http\Controllers\Web\Home::class, 'coming_soon'])->name('coming_soon');
Route::get('/statis/{slug}', [App\Http\Controllers\Web\Statis::class, 'index'])->name('statis');

Route::get('/maklumat', [App\Http\Controllers\Web\Maklumat::class, 'maklumat'])->name('maklumat');
Route::get('/skm', [App\Http\Controllers\Web\Maklumat::class, 'skm'])->name('skm');

Route::get('/bermedsos', [App\Http\Controllers\Web\Home::class, 'bermedsos'])->name('bermedsos');
Route::get('/asn_netral', [App\Http\Controllers\Web\Home::class, 'asn_netral'])->name('asn_netral');
Route::get('/gratifikasi', [App\Http\Controllers\Web\Home::class, 'gratifikasi'])->name('gratifikasi');
Route::get('/antinarkoba', [App\Http\Controllers\Web\Home::class, 'antinarkoba'])->name('antinarkoba');
Route::get('/kode_etik', [App\Http\Controllers\Web\Home::class, 'kode_etik'])->name('kode_etik');
Route::get('/jam_kerja', [App\Http\Controllers\Web\Home::class, 'jam_kerja'])->name('jam_kerja');
Route::get('/jam_kerja_1', [App\Http\Controllers\Web\Home::class, 'jam_kerja_1'])->name('jam_kerja_1');

Route::get('/pembinaan', [App\Http\Controllers\Web\Home::class, 'pembinaan'])->name('pembinaan');
Route::get('/pengumuman_1', [App\Http\Controllers\Web\Home::class, 'pengumuman_1'])->name('pengumuman_1');
Route::get('/pengumuman_penerimaan', [App\Http\Controllers\Web\Home::class, 'pengumuman_penerimaan'])->name('pengumuman_penerimaan');
Route::get('/qna_pppk', [App\Http\Controllers\Web\Home::class, 'qna_pppk'])->name('qna_pppk');
Route::get('/under_construction', [App\Http\Controllers\Web\Home::class, 'under_construction'])->name('under_construction');

Route::get('/hasil_seleksi_administrasi', [App\Http\Controllers\Web\Home::class, 'hasil_seleksi_administrasi'])->name('hasil_seleksi_administrasi');
Route::get('/jadwal_seleksi', [App\Http\Controllers\Web\Home::class, 'jadwal_seleksi'])->name('jadwal_seleksi');

Route::get('/hasil_akhir_pppk', [App\Http\Controllers\Web\Home::class, 'hasil_akhir_pppk'])->name('hasil_akhir_pppk');
Route::get('/hasil_akhir_pppk_guru', [App\Http\Controllers\Web\Home::class, 'hasil_akhir_pppk_guru'])->name('hasil_akhir_pppk_guru');

Route::group([ 'prefix' => 'qna_pppk', 'as' => 'qna_pppk.', 'namespace' => 'Link_contact', ], function () {
    Route::get('/', [App\Http\Controllers\Web\Link_contact::class, 'index'])->name('index');
});
/* info penting */
Route::group([ 'prefix' => 'info-penting', 'as' => 'info-penting.', 'namespace' => 'InfoPenting', ], function () {
    Route::get('/', [App\Http\Controllers\Web\InfoPenting::class, 'index'])->name('index');
    Route::get('/{slug}', [App\Http\Controllers\Web\InfoPenting::class, 'detail'])->name('detail');
});

/* berita */
Route::group([ 'prefix' => 'berita', 'as' => 'berita.', 'namespace' => 'Berita', ], function () {
    Route::get('/', [App\Http\Controllers\Web\Berita::class, 'index'])->name('index');
    Route::get('/{slug}', [App\Http\Controllers\Web\Berita::class, 'detail'])->name('detail');
});

/* foto kegiatan */
Route::group([ 'prefix' => 'foto-kegiatan', 'as' => 'foto-kegiatan.', 'namespace' => 'FotoKegiatan',], function () {
    Route::get('/', [App\Http\Controllers\Web\FotoKegiatan::class, 'index'])->name('index');
    Route::get('/{slug}', [App\Http\Controllers\Web\FotoKegiatan::class, 'detail'])->name('detail');
});

/* hubungi kami */
Route::group([ 'prefix' => 'hubungi-kami', 'as' => 'hubungi-kami.', 'namespace' => 'HubungiKami', ], function () {
    Route::get('/', [App\Http\Controllers\Web\HubungiKami::class, 'index'])->name('index');
});

/* Pembinaan */
Route::group([ 'prefix' => 'pembinaan', 'as' => 'pembinaan.', 'namespace' => 'Pembinaan', ], function () {
    // Route::get('/', [App\Http\Controllers\Web\Pembinaan::class, 'index'])->name('index');
    Route::get('/{slug}', [App\Http\Controllers\Web\Pembinaan::class, 'detail'])->name('detail');
});

Route::get('/dashboard/login', [App\Http\Controllers\Admin\Login::class, 'index'])->name('dashboard.login');
Route::post('/dashboard/login', [App\Http\Controllers\Admin\Login::class, 'form_login_action'])->name('dashboard.form_login_action');
Route::post('/dashboard/login/refresh_capcay', [App\Http\Controllers\Admin\Login::class, 'refresh_capcay'])->name('dashboard.refresh_capcay');


/* ================================== [CPNS] ============================================ */
Route::get('/info-penting/pengumuman-seleksi-calon-pegawai-negeri-sipil-cpns-pemerintah-kota-surabaya-tahun-anggaran-2024-1724112752', [App\Http\Controllers\Web\Home::class, 'info_cpns'])->name('info_cpns');
Route::get('/jadwal_cpns', [App\Http\Controllers\Web\Home::class, 'jadwal_cpns'])->name('jadwal_cpns');
Route::get('/press_release_cpns', [App\Http\Controllers\Web\Home::class, 'press_release_cpns'])->name('press_release_cpns');


/* ================================== [WEB ADMIN] ============================================ */
Route::group([ 'prefix' => 'dashboard', 'as' => 'dashboard.', 'namespace' => 'Dashboard', 'middleware' => 'cek_login' ], function () {

    Route::get('/', [App\Http\Controllers\Admin\Dashboard::class, 'index'])->name('index');
    Route::get('/profil_saya', [App\Http\Controllers\Admin\Dashboard::class, 'profil_saya'])->name('profil_saya');
    Route::post('/profil_saya', [App\Http\Controllers\Admin\Dashboard::class, 'update_profil_saya'])->name('update_profil_saya');
    Route::get('/logout', [App\Http\Controllers\Admin\Login::class, 'logout'])->name('logout');


    /**
     * INFO PENTING
     */
    Route::get('/info-penting', [App\Http\Controllers\Admin\InfoPenting::class, 'index'])->name('info-penting');
    Route::post('/info-penting/datatable', [App\Http\Controllers\Admin\InfoPenting::class, 'datatable'])->name('info-penting.datatable');
    Route::get('/info-penting/add', [App\Http\Controllers\Admin\InfoPenting::class, 'add'])->name('info-penting.add');
    Route::post('/info-penting/save', [App\Http\Controllers\Admin\InfoPenting::class, 'save'])->name('info-penting.save');
    Route::get('/info-penting/edit/{id}', [App\Http\Controllers\Admin\InfoPenting::class, 'edit'])->name('info-penting.edit');
    Route::post('/info-penting/update', [App\Http\Controllers\Admin\InfoPenting::class, 'update'])->name('info-penting.update');
    Route::post('/info-penting/upload', [App\Http\Controllers\Admin\InfoPenting::class, 'upload'])->name('info-penting.upload');
    Route::post('/info-penting/hapus_lampiran', [App\Http\Controllers\Admin\InfoPenting::class, 'hapus_lampiran'])->name('info-penting.hapus_lampiran');
    Route::post('/info-penting/hapus', [App\Http\Controllers\Admin\InfoPenting::class, 'hapus'])->name('info-penting.hapus');

    /**
     * BERITA
     */
    Route::get('/berita', [App\Http\Controllers\Admin\Berita::class, 'index'])->name('berita');
    Route::post('/berita/datatable', [App\Http\Controllers\Admin\Berita::class, 'datatable'])->name('berita.datatable');
    Route::get('/berita/add', [App\Http\Controllers\Admin\Berita::class, 'add'])->name('berita.add');
    Route::post('/berita/save', [App\Http\Controllers\Admin\Berita::class, 'save'])->name('berita.save');
    Route::get('/berita/edit/{id}', [App\Http\Controllers\Admin\Berita::class, 'edit'])->name('berita.edit');
    Route::post('/berita/update', [App\Http\Controllers\Admin\Berita::class, 'update'])->name('berita.update');
    Route::post('/berita/upload', [App\Http\Controllers\Admin\Berita::class, 'upload'])->name('berita.upload');
    Route::post('/berita/hapus_lampiran', [App\Http\Controllers\Admin\Berita::class, 'hapus_lampiran'])->name('berita.hapus_lampiran');
    Route::post('/berita/hapus', [App\Http\Controllers\Admin\Berita::class, 'hapus'])->name('berita.hapus');


    /**
     * HUBUNGI KAMI
     */
    Route::get('/hubungi-kami', [App\Http\Controllers\Admin\Hubungi_kami::class, 'edit'])->name('hubungi-kami');
    Route::post('/hubungi-kami', [App\Http\Controllers\Admin\Hubungi_kami::class, 'update'])->name('hubungi-kami.update');

    /**
     * KOMENTAR POSTING
     */
    Route::get('/komentar', [App\Http\Controllers\Admin\Komentar::class, 'index'])->name('komentar');
    Route::post('/komentar/datatable', [App\Http\Controllers\Admin\Komentar::class, 'datatable'])->name('komentar.datatable');
    Route::get('/komentar/edit/{id}', [App\Http\Controllers\Admin\Komentar::class, 'edit'])->name('komentar.edit');
    Route::post('/komentar/update', [App\Http\Controllers\Admin\Komentar::class, 'update'])->name('komentar.update');
    Route::post('/komentar/hapus', [App\Http\Controllers\Admin\Komentar::class, 'hapus'])->name('komentar.hapus');


    /**
     * FOTO KEGIATAN
     */
    Route::get('/foto-kegiatan', [App\Http\Controllers\Admin\FotoKegiatan::class, 'index'])->name('foto-kegiatan');
    Route::post('/foto-kegiatan/datatable', [App\Http\Controllers\Admin\FotoKegiatan::class, 'datatable'])->name('foto-kegiatan.datatable');
    Route::get('/foto-kegiatan/add', [App\Http\Controllers\Admin\FotoKegiatan::class, 'add'])->name('foto-kegiatan.add');
    Route::post('/foto-kegiatan/save', [App\Http\Controllers\Admin\FotoKegiatan::class, 'save'])->name('foto-kegiatan.save');
    Route::get('/foto-kegiatan/edit/{id}', [App\Http\Controllers\Admin\FotoKegiatan::class, 'edit'])->name('foto-kegiatan.edit');
    Route::post('/foto-kegiatan/update', [App\Http\Controllers\Admin\FotoKegiatan::class, 'update'])->name('foto-kegiatan.update');
    Route::post('/foto-kegiatan/upload', [App\Http\Controllers\Admin\FotoKegiatan::class, 'upload'])->name('foto-kegiatan.upload');
    Route::post('/foto-kegiatan/hapus_lampiran', [App\Http\Controllers\Admin\FotoKegiatan::class, 'hapus_lampiran'])->name('foto-kegiatan.hapus_lampiran');
    Route::post('/foto-kegiatan/hapus', [App\Http\Controllers\Admin\FotoKegiatan::class, 'hapus'])->name('foto-kegiatan.hapus');

    Route::get('/foto-kegiatan', [App\Http\Controllers\Admin\FotoKegiatan::class, 'index'])->name('foto-kegiatan');

    // Route::get('/hubungi-kami', [App\Http\Controllers\Admin\HubungiKami::class, 'index'])->name('hubungi-kami');


 	/**
     * SLIDER
     */
    Route::get('/slider', [App\Http\Controllers\Admin\Slider::class, 'index'])->name('slider');
    Route::post('/slider/datatable', [App\Http\Controllers\Admin\Slider::class, 'datatable'])->name('slider.datatable');
    Route::get('/slider/add', [App\Http\Controllers\Admin\Slider::class, 'add'])->name('slider.add');
    Route::post('/slider/save', [App\Http\Controllers\Admin\Slider::class, 'save'])->name('slider.save');
    Route::get('/slider/edit/{id}', [App\Http\Controllers\Admin\Slider::class, 'edit'])->name('slider.edit');
    Route::post('/slider/update', [App\Http\Controllers\Admin\Slider::class, 'update'])->name('slider.update');
    Route::post('/slider/hapus', [App\Http\Controllers\Admin\Slider::class, 'hapus'])->name('slider.hapus');

    /**
     * SUB SLIDER
     */
    Route::get('/subslider', [App\Http\Controllers\Admin\Subslider::class, 'index'])->name('subslider');
    Route::post('/subslider/datatable', [App\Http\Controllers\Admin\Subslider::class, 'datatable'])->name('subslider.datatable');
    Route::get('/subslider/add', [App\Http\Controllers\Admin\Subslider::class, 'add'])->name('subslider.add');
    Route::post('/subslider/save', [App\Http\Controllers\Admin\Subslider::class, 'save'])->name('subslider.save');
    Route::get('/subslider/edit/{id}', [App\Http\Controllers\Admin\Subslider::class, 'edit'])->name('subslider.edit');
    Route::post('/subslider/update', [App\Http\Controllers\Admin\Subslider::class, 'update'])->name('subslider.update');
    Route::post('/subslider/hapus', [App\Http\Controllers\Admin\Subslider::class, 'hapus'])->name('subslider.hapus');

    /**
     * KONTEN STATIS
     */
    Route::get('/konten-statis-web', [App\Http\Controllers\Admin\KontenStatisWeb::class, 'index'])->name('konten-statis-web');
    Route::post('/konten-statis-web/datatable', [App\Http\Controllers\Admin\KontenStatisWeb::class, 'datatable'])->name('konten-statis-web.datatable');
    Route::get('/konten-statis-web/add', [App\Http\Controllers\Admin\KontenStatisWeb::class, 'add'])->name('konten-statis-web.add');
    Route::post('/konten-statis-web/save', [App\Http\Controllers\Admin\KontenStatisWeb::class, 'save'])->name('konten-statis-web.save');
    Route::get('/konten-statis-web/edit/{id}', [App\Http\Controllers\Admin\KontenStatisWeb::class, 'edit'])->name('konten-statis-web.edit');
    Route::post('/konten-statis-web/update', [App\Http\Controllers\Admin\KontenStatisWeb::class, 'update'])->name('konten-statis-web.update');
    Route::post('/konten-statis-web/upload', [App\Http\Controllers\Admin\KontenStatisWeb::class, 'upload'])->name('konten-statis-web.upload');
    Route::post('/konten-statis-web/hapus_lampiran', [App\Http\Controllers\Admin\KontenStatisWeb::class, 'hapus_lampiran'])->name('konten-statis-web.hapus_lampiran');
    Route::post('/konten-statis-web/hapus', [App\Http\Controllers\Admin\KontenStatisWeb::class, 'hapus'])->name('konten-statis-web.hapus');


    /**
     * USER ADMIN
     */
    Route::get('/user', [App\Http\Controllers\Admin\User::class, 'index'])->name('user');
    Route::post('/user/datatable', [App\Http\Controllers\Admin\User::class, 'datatable'])->name('user.datatable');
    Route::get('/user/add', [App\Http\Controllers\Admin\User::class, 'add'])->name('user.add');
    Route::post('/user/save', [App\Http\Controllers\Admin\User::class, 'save'])->name('user.save');
    Route::get('/user/edit/{id}', [App\Http\Controllers\Admin\User::class, 'edit'])->name('user.edit');
    Route::post('/user/update', [App\Http\Controllers\Admin\User::class, 'update'])->name('user.update');
    Route::post('/user/hapus', [App\Http\Controllers\Admin\User::class, 'hapus'])->name('user.hapus');

    // Animasi
    
    Route::get('/animasi', [App\Http\Controllers\Admin\AnimasiHome::class, 'index'])->name('animasi.index');
    Route::get('/animasi/create', [App\Http\Controllers\Admin\AnimasiHome::class, 'create'])->name('animasi.create');
    Route::post('/animasi/store', [App\Http\Controllers\Admin\AnimasiHome::class, 'store'])->name('animasi.store');
    Route::get('/animasi/edit/{id}', [App\Http\Controllers\Admin\AnimasiHome::class, 'edit'])->name('animasi.edit');
    Route::post('/animasi/update/{id}', [App\Http\Controllers\Admin\AnimasiHome::class, 'update'])->name('animasi.update');
    Route::get('/animasi/destroy/{id}', [App\Http\Controllers\Admin\AnimasiHome::class, 'destroy'])->name('animasi.destroy');


    /*
    Slide Show SOP
    */
    // Route::get('/sop', [App\Http\Controllers\Admin\Sop::class, 'index'])->name('sop.index');
    // Route::get('/sop/add', [App\Http\Controllers\Admin\Sop::class, 'add'])->name('add');
    // Route::post('/sop/save', [App\Http\Controllers\Admin\Sop::class, 'save'])->name('sop.save');
    // Route::get('/sop/edit/{id}', [App\Http\Controllers\Admin\Sop::class, 'edit'])->name('sop.edit');
    // Route::post('/sop/update', [App\Http\Controllers\Admin\Sop::class, 'update'])->name('sop.update');
    // Route::get('/sop/hapus/{id}', [App\Http\Controllers\Admin\Sop::class, 'hapus'])->name('sop.hapus');
    // Route::get('/sop/slide_show', [App\Http\Controllers\Admin\Sop::class, 'slide_show'])->name('sop.slide_show');
    // Route::get('/sop/index_slide_show', [App\Http\Controllers\Admin\Sop::class, 'index_slide_show'])->name('sop.index_slide_show');

    /*
    Sigendis User Admin
    */
    // Route::get('/sigendis/index', [App\Http\Controllers\Admin\Sigendis::class, 'index'])->name('sigendis.index');
    // Route::post('/sigendis/filter', [App\Http\Controllers\Admin\Sigendis::class, 'filter'])->name('sigendis.filter');
    // Route::get('/sigendis/detail/{id}', [App\Http\Controllers\Admin\Sigendis::class, 'detail'])->name('sigendis.detail');
    // Route::get('/sigendis/approve/{id}', [App\Http\Controllers\Admin\Sigendis::class, 'approve'])->name('sigendis.approve');
    // Route::get('/sigendis/hapus/{id}', [App\Http\Controllers\Admin\Sigendis::class, 'hapus'])->name('sigendis.hapus');
    // Route::get('/sigendis/persetujuan_pdf/{id}', [App\Http\Controllers\Admin\Sigendis::class, 'persetujuan_pdf'])->name('sigendis.persetujuan_pdf');
    // Route::get('/sigendis/ijin_pdf/{id}', [App\Http\Controllers\Admin\Sigendis::class, 'ijin_pdf'])->name('sigendis.ijin_pdf');
    // Route::get('/sigendis/print_pdf/{bulan}/{tahun}', [App\Http\Controllers\Admin\Sigendis::class, 'print_pdf'])->name('sigendis.print_pdf');
    // Route::get('/sigendis/add', [App\Http\Controllers\Admin\Sigendis::class, 'add'])->name('sigendis.add');
    // Route::post('/sigendis/simpan', [App\Http\Controllers\Admin\Sigendis::class, 'simpan'])->name('sigendis.simpan');
    // Route::get('/sigendis/tolak/{id}', [App\Http\Controllers\Admin\Sigendis::class, 'tolak'])->name('sigendis.tolak');
    // Route::get('/sigendis/batal_tolak/{id}', [App\Http\Controllers\Admin\Sigendis::class, 'batal_tolak'])->name('sigendis.batal_tolak');

    // Route::get('/sigendis/kegiatan/index', [App\Http\Controllers\Admin\Sigendis_kegiatan::class, 'index'])->name('sigendis_kegiatan.index');
    // Route::get('/sigendis/kegiatan/detail/{id}', [App\Http\Controllers\Admin\Sigendis_kegiatan::class, 'detail'])->name('sigendis_kegiatan.detail');
    // Route::get('/sigendis/kegiatan/edit/{id}', [App\Http\Controllers\Admin\Sigendis_kegiatan::class, 'edit'])->name('sigendis_kegiatan.edit');
    // Route::post('/sigendis/kegiatan/update_data', [App\Http\Controllers\Admin\Sigendis_kegiatan::class, 'update_data'])->name('sigendis_kegiatan.update_data');
    // Route::get('/sigendis/kegiatan/hapus_foto/{id}', [App\Http\Controllers\Admin\Sigendis_kegiatan::class, 'hapus_foto'])->name('sigendis_kegiatan.hapus_foto');
    // Route::post('/sigendis/kegiatan/update_foto', [App\Http\Controllers\Admin\Sigendis_kegiatan::class, 'update_foto'])->name('sigendis_kegiatan.update_foto');
    // Route::get('/sigendis/kegiatan/add', [App\Http\Controllers\Admin\Sigendis_kegiatan::class, 'add'])->name('sigendis_kegiatan.add');
    // Route::post('/sigendis/kegiatan/simpan', [App\Http\Controllers\Admin\Sigendis_kegiatan::class, 'simpan'])->name('sigendis_kegiatan.simpan');
    /*
    Jadwal Rapat
    */
    // Route::get('/jadwal_rapat/index', [App\Http\Controllers\Admin\Jadwal_Rapat::class, 'index'])->name('jadwal_rapat.index');
    // Route::get('/jadwal_rapat/add', [App\Http\Controllers\Admin\Jadwal_Rapat::class, 'add'])->name('add');
    // Route::get('/jadwal_rapat/save', [App\Http\Controllers\Admin\Jadwal_Rapat::class, 'save'])->name('jadwal_rapat.save');
    // Route::get('/jadwal_rapat/edit/{id}', [App\Http\Controllers\Admin\Jadwal_Rapat::class, 'edit'])->name('jadwal_rapat.edit');
    // Route::get('/jadwal_rapat/update/{id}', [App\Http\Controllers\Admin\Jadwal_Rapat::class, 'update'])->name('jadwal_rapat.update');
    // Route::get('/jadwal_rapat/hapus/{id}', [App\Http\Controllers\Admin\Jadwal_Rapat::class, 'hapus'])->name('jadwal_rapat.hapus');
    // Route::get('/jadwal_rapat/filter', [App\Http\Controllers\Admin\Jadwal_Rapat::class, 'filter'])->name('jadwal_rapat.filter');

    /*
    Dokuemen Perencanaan
    */
    // Route::get('/dokumen_perencanaan/index/{jenis_dokumen}', [App\Http\Controllers\Admin\Dokumen_perencanaan::class, 'index'])->name('dokumen_perencanaan.index');
    // Route::get('/dokumen_perencanaan/add/{jenis_dokumen}', [App\Http\Controllers\Admin\Dokumen_perencanaan::class, 'add'])->name('dokumen_perencanaan.add');
    // Route::post('/dokumen_perencanaan/save', [App\Http\Controllers\Admin\Dokumen_perencanaan::class, 'save'])->name('dokumen_perencanaan.save');
    // Route::get('/dokumen_perencanaan/delete/{id}', [App\Http\Controllers\Admin\Dokumen_perencanaan::class, 'delete'])->name('dokumen_perencanaan.delete');
    // Route::get('/dokumen_perencanaan/edit/{id}', [App\Http\Controllers\Admin\Dokumen_perencanaan::class, 'edit'])->name('dokumen_perencanaan.edit');
    // Route::post('/dokumen_perencanaan/update', [App\Http\Controllers\Admin\Dokumen_perencanaan::class, 'update'])->name('dokumen_perencanaan.update');

    /*
    Realisasi Anggaran
    */
    // Route::get('/realisasi/index', [App\Http\Controllers\Admin\Realisasi::class, 'index'])->name('realisasi.index');
    // Route::get('/realisasi/add', [App\Http\Controllers\Admin\Realisasi::class, 'add'])->name('realisasi.add');
    // Route::post('/realisasi/save', [App\Http\Controllers\Admin\Realisasi::class, 'save'])->name('realisasi.save');
    // Route::get('/realisasi/delete/{id}', [App\Http\Controllers\Admin\Realisasi::class, 'delete'])->name('realisasi.delete');
    // Route::get('/realisasi/edit/{id}', [App\Http\Controllers\Admin\Realisasi::class, 'edit'])->name('realisasi.edit');
    // Route::post('/realisasi/update', [App\Http\Controllers\Admin\Realisasi::class, 'update'])->name('realisasi.update');

    /*
    Artikel
    */
    // Route::get('/artikel/populer', [App\Http\Controllers\Admin\Artikel::class, 'populer'])->name('artikel.populer');
    // Route::get('/artikel/ilmiah', [App\Http\Controllers\Admin\Artikel::class, 'ilmiah'])->name('artikel.ilmiah');
    // Route::get('/artikel/opini', [App\Http\Controllers\Admin\Artikel::class, 'opini'])->name('artikel.opini');
    // Route::get('/artikel/pengajuan', [App\Http\Controllers\Admin\Artikel::class, 'pengajuan'])->name('artikel.pengajuan');
    // Route::get('/artikel/add', [App\Http\Controllers\Admin\Artikel::class, 'add'])->name('artikel.add');
    // Route::post('/artikel/save', [App\Http\Controllers\Admin\Artikel::class, 'save'])->name('artikel.save');
    // Route::get('/artikel/detail/{id}', [App\Http\Controllers\Admin\Artikel::class, 'detail'])->name('artikel.detail');
    // Route::get('/artikel/edit/{id}', [App\Http\Controllers\Admin\Artikel::class, 'edit'])->name('artikel.edit');
    // Route::post('/artikel/update', [App\Http\Controllers\Admin\Artikel::class, 'update'])->name('artikel.update');
    // Route::get('/artikel/delete/{id}', [App\Http\Controllers\Admin\Artikel::class, 'delete'])->name('artikel.delete');
});

/*
// GEDUNG DIKLAT


Route::get('/sigendis', [App\Http\Controllers\Sigendis\Sigendis::class, 'index'])->name('index');
Route::get('/sigendis/home', [App\Http\Controllers\Sigendis\Sigendis::class, 'home'])->name('home');
Route::get('/sigendis/calendar', [App\Http\Controllers\Sigendis\Sigendis::class, 'calendar'])->name('calendar');
Route::get('/sigendis/kegiatan', [App\Http\Controllers\Sigendis\Sigendis::class, 'kegiatan'])->name('kegiatan');

Route::get('/sigendis/calendarSubmit', [App\Http\Controllers\Sigendis\Sigendis::class, 'calendarSubmit'])->name('calendarSubmit');
Route::get('/sigendis/form_permohonan', [App\Http\Controllers\Sigendis\Sigendis::class, 'form_permohonan'])->name('form_permohonan');
Route::post('/sigendis/submit_permohonan', [App\Http\Controllers\Sigendis\Sigendis::class, 'submit_permohonan'])->name('submit_permohonan');

Route::get('/sigendis/kegiatan_detail_web', [App\Http\Controllers\Sigendis\Sigendis::class, 'kegiatan_detail_web'])->name('kegiatan_detail_web');
Route::get('/sigendis/kegiatan_detail', [App\Http\Controllers\Sigendis\Sigendis::class, 'kegiatan_detail'])->name('kegiatan_detail');

Route::get('/sigendis/tanggapan', [App\Http\Controllers\Sigendis\Sigendis::class, 'tanggapan'])->name('tanggapan');
Route::get('/sigendis/index_tanggapan', [App\Http\Controllers\Sigendis\Sigendis::class, 'index_tanggapan'])->name('index_tanggapan');
Route::get('/sigendis/detail_tanggapan/{id}', [App\Http\Controllers\Sigendis\Sigendis::class, 'detail_tanggapan'])->name('detail_tanggapan');
Route::get('/sigendis/persetujuan_pdf/{id}', [App\Http\Controllers\Sigendis\Sigendis::class, 'persetujuan_pdf'])->name('persetujuan_pdf');


Route::get('/sigendis/login', [App\Http\Controllers\Sigendis\Sigendis::class, 'login'])->name('login');
//Route::get('/sigendis',[Sigendis::class,'index']);
//Route::get('/sigendis',[Sigendis\Sigendis::class,'index']);

*/
// SOP


// Route::get('/sop', [App\Http\Controllers\Web\Sop::class, 'index'])->name('index');
// Route::get('/sop/slide_show', [App\Http\Controllers\Web\Sop::class, 'slide_show'])->name('slide_show');

// Route::get('/dashboard_web', [App\Http\Controllers\Dashboard_web\Dashboard_web::class, 'index'])->name('index');

// Route::get('/jadwal_rapat', [App\Http\Controllers\Dashboard_web\Dashboard_web::class, 'jadwal_rapat'])->name('jadwal_rapat');
// Route::get('/dokumen', [App\Http\Controllers\Dashboard_web\Dashboard_web::class, 'dokumen'])->name('dokumen');
// Route::get('/dokumen/jenis_dokumen/{jenis_dokumen}', [App\Http\Controllers\Dashboard_web\Dashboard_web::class, 'jenis_dokumen'])->name('jenis_dokumen');
// Route::get('/realisasi', [App\Http\Controllers\Dashboard_web\Dashboard_web::class, 'realisasi'])->name('realisasi');


// // Artikel

// Route::get('/artikel', [App\Http\Controllers\Web\Artikel::class, 'index'])->name('index');
// Route::get('/artikel/detail/{id}', [App\Http\Controllers\Web\Artikel::class, 'detail'])->name('detail');
// Route::get('/artikel/populer', [App\Http\Controllers\Web\Artikel::class, 'populer'])->name('populer');
// Route::get('/artikel/ilmiah', [App\Http\Controllers\Web\Artikel::class, 'ilmiah'])->name('ilmiah');
// Route::get('/artikel/opini', [App\Http\Controllers\Web\Artikel::class, 'opini'])->name('opini');
// Route::get('/artikel/pengajuan', [App\Http\Controllers\Web\Artikel::class, 'pengajuan'])->name('pengajuan');
// Route::post('/artikel/pengajuan/save', [App\Http\Controllers\Web\Artikel::class, 'save'])->name('save');


// Dashboard Bu Kadan

// Route::get('/dashboard_bkpsdm_login', [App\Http\Controllers\Admin_Dashboard\Login::class, 'dashboard_bkpsdm_login'])->name('dashboard.login');
// Route::get('/login_dashboard', [Login::class, 'showLoginForm'])->name('dashboard_login_page');
// Route::get('/logout_dashboard_bpksdm', [Login::class, 'logout'])->name('logout');
// Route::get('/proses_login_dashboard', [Login::class, 'proses_login_dashboard'])->name('proses_login_dashboard');

// Route::group(['prefix' => 'dashboard_bkpsdm', 'middleware' => ['CheckLoginDashboardBkpsdm:user,admin']], function () {
//     Route::get('/', [Dashboard::class, 'index'])->name('index');
//     Route::get('/view_jadwal_rapat', [Dashboard::class, 'view_jadwal_rapat'])->name('view_jadwal_rapat');
//     Route::get('/dokumen_perencanaan', [Dashboard::class, 'dokumen_perencanaan'])->name('dokumen_perencanaan');
//     Route::get('/dokumen_perencanaan_tahun/{tahun}', [Dashboard::class, 'dokumen_perencanaan_tahun'])->name('dokumen_perencanaan_tahun');
//     Route::get('/dokumen_bpk/{tahun}', [Dashboard::class, 'dokumen_bpk'])->name('dokumen_bpk');
//     Route::get('/realisasi/{tahun}', [Dashboard::class, 'realisasi'])->name('realisasi');
//     Route::get('/index_realisasi', [Dashboard::class, 'index_realisasi'])->name('index_realisasi');

//     Route::group(['prefix' => 'admin', 'middleware' => ['CheckLoginDashboardBkpsdm:admin']], function () {
//         Route::resource('jadwal_rapat', Jadwal_Rapat::class);
//         Route::resource('dokumen_perencanaan', Dokumen_Perencanaan::class);
//         Route::resource('dokumen_bpk', Dokumen_Bpk::class);
//         Route::resource('realisasi', Realisasi::class);
//     });
// });