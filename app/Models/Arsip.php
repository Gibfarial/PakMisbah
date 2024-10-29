<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $fillable = [
  
        'nama',
        'barang_id',
        'tanggal_pengambilan',
        'tanggal_pengembalian',
        'image',
        'keterangan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}




