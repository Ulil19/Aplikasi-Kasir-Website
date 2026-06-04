<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\TransaksiDetail;

class Produk extends Model
{
    //
    use SoftDeletes;
    protected $table = 'produk';
    protected $guarded = ['id'];
    protected $fillable = [
        'kategori_id',
        'nama',
        'deskripsi',
        'harga',
        'gambar',
    ];

    public function kategori() : BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function transaksiDetails(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class, 'produk_id');
    }
}
