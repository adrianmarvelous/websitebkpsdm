<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_slider extends Model
{
    protected $table = 'm_slider';
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

}
