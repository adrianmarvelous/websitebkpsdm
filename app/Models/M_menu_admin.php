<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_menu_admin extends Model
{
    protected $table = 'm_menu_admin';
    protected $primaryKey = "id";

    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max("id")+1;
    }

    public function scopeRecursive($query)
    {
        return $query->whereNull('parent')
                     ->whereNotNull('aktif')
                     ->with('childrenCategories');
    }

    public function scopeByAktif($query)
    {
        return $query->where('aktif', '1');
    }
    public function scopeBySlug($query, $value)
    {
        return $query->where('slug', $value);
    }

    public function categories()
    {
        return $this->hasMany('App\Models\M_menu_admin', 'parent', 'id');
    }

    public function childrenCategories()
    {
        return $this->categories()->with('childrenCategories')->whereNotNull('aktif');
    }

}
