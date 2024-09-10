<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
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

    public function lampiran_berita()
    {
        return $this->hasMany('App\Models\Lampiran_berita', 'id_berita');
    }
}
