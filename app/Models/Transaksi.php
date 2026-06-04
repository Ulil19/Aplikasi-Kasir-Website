<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\TransaksiDetail;

class Transaksi extends Model
{
    //
    protected $table = 'transaksi';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'invoice',
        'customer',
        'total',
        'bayar',
        'kembali',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
}
