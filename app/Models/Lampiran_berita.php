<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Lampiran_berita extends Model
{
    protected $table = 'lampiran_berita';
    protected $primaryKey = "id";

    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max("id")+1;
    }

    public function slug_konten()
    {
    	return $this->belongsTo('\App\Models\Berita', 'id_berita');
    }

    public function scopebySlug($query, $val)
    {
    	return $query->whereHas('slug_konten', function (Builder $query) {
    		$query->where('slug', $val);
    	});
    }
}
