<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    //
    protected $table = 'kategori';
    protected $guarded = ['id'];
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}
