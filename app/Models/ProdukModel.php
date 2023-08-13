<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_produk';
    protected $table = 'db_produk';
    protected $guarded = [];
    public $incrementing = false;
}
