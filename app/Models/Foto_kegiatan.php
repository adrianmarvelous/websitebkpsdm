<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto_kegiatan extends Model
{
    protected $table = 'foto_kegiatan';
    protected $primaryKey = "id";

    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max("id")+1;
    }

    public function scopeByAktif($query)
    {
        return $query->where('aktif', '1');
    }

    public function scopeBySlug($query, $value)
    {
        return $query->where('slug', $value);
    }

    public function isi_album()
    {
        return $this->hasMany('App\Models\Lampiran_foto_kegiatan', 'id_foto_kegiatan');
    }

    public function komentar()
    {
        return $this->hasMany('App\Models\Komentar', 'id_kategori')
        ->where('aktif', '1')
        ->where('kategori', 'FOTO_KEGIATAN');
    }
}
