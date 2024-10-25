<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMuaType extends Model
{
    use HasFactory;

    protected $table = 'admin_mua_type';

    protected $fillable = [
        'admin_id',
        'muatype_id',
    ];
}
