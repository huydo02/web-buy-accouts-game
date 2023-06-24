<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class card_auto extends Model
{
    use HasFactory;
    protected $table = 'card_auto';
    protected $fillable = [
        'id',
        'username',
        'loaithe',
        'menhgia',
        'thucnhan',
        'thoigian',
        'trangthai',
        'ghichu',
        'seri',
        'pin',
        'request_id',
        
    ];
}
