<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $fillable = [
        'barang',
        'item',

    ];
    public function arsips()
    {
        return $this->hasMany(Arsip::class);
    }
}
