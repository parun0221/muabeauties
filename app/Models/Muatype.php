<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Muatype extends Model
{
    /** @use HasFactory<\Database\Factories\MuatypeFactory> */
    use HasFactory, Notifiable, HasApiTokens;
    protected $guarded=[];
    public function admin()
    {
        return $this->belongsToMany(Admins::class, 'admin_mua_types', 'muatype_id', 'admin_id');
    }

    public function galerymua()
    {
        return $this->hasMany(GaleryMua::class, 'admin_mua_type_id');
    }
    

}
