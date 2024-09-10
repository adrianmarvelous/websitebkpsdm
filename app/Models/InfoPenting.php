<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPenting extends Model
{
    protected $table = 'info_penting';
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

    public function lampiran_info_penting()
    {
        return $this->hasMany('App\Models\Lampiran_info_penting', 'id_info_penting');
    }

    public function komentar()
    {
        return $this->hasMany('App\Models\Komentar', 'id_kategori')
        ->where('aktif', '1')
        ->where('kategori', 'INFO_PENTING');
    }
}
