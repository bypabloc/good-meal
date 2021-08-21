<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcription extends Model
{
    use HasFactory;

    protected $table = 'subcriptions';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'email', 
        'names', 
        'number', 
        'canal_marketing', 
        'birth_date', 
        'location', 
        'observation', 
    ];
}
