<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran_konten_web extends Model
{
    use HasFactory;

    protected $table = 'lampiran_konten_web';
    protected $primaryKey = "id";

    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max("id")+1;
    }

    public function m_konten_web()
    {
        return $this->belongsTo('App\Models\M_konten_web', 'id_konten');
    }
}
