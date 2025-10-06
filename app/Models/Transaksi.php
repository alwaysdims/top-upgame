<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table ='transactions';
    protected $fillable = [
        'user_id',
        'zone_id',
        'jumlah',
        'pilihan',
        'total',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaction_id', 'id');
    }
}
