<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaModel extends Model
{
    use HasFactory;


    protected $primaryKey = 'kode_kriteria';
    protected $table = 'db_kriteria';
    protected $guarded = [];
    public $incrementing = false;
}
