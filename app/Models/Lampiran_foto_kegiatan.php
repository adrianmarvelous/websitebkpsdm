<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lampiran_foto_kegiatan extends Model
{
    protected $table = 'lampiran_foto_kegiatan';
    protected $primaryKey = "id";

    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max("id")+1;
    }
}
