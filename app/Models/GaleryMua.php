<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleryMua extends Model
{
    /** @use HasFactory<\Database\Factories\GaleryMuaFactory> */
    use HasFactory;

    protected $fillable = ['admin_mua_type_id', 'gambar', 'deskripsi']; // Sesuaikan dengan nama field di database

    public function adminMuaType()
{
    return $this->belongsTo(AdminMuaType::class);
}
}
