<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaCost extends Model
{
    use HasFactory;

    protected $table = "kriteria_cost";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'nama',
    ];
}
