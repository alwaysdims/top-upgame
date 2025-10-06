<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $table = 'transaction_details';

    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'jumlah',
        'harga',
        'total_harga',
    ];
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaction_id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }
}
