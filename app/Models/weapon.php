<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class weapon extends Model
{
    use HasFactory;
    protected $table ='weapons';
    protected $fillable = [
        'id',
        'name',
        'flies',
    ];

}
