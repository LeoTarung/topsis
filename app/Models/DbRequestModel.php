<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DbRequestModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_request';
    public $incrementing = false;
    protected $table = 'db_request';
    protected $guarded = [];
    protected $keyType = 'string';

    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'kode_produk', 'kode_produk');
    }
}
