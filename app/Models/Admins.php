<?php

namespace App\Models;

use App\Models\User;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admins extends Model
{
    /** @use HasFactory<\Database\Factories\AdminsFactory> */
    use HasFactory, Notifiable, HasApiTokens;
    protected $guarded=[];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function muatypes()
    {
        return $this->belongsToMany(MuaType::class, 'admin_mua_types', 'admin_id', 'muatype_id')->withPivot('id');
    }

    public function galerymua()
    {
        return $this->hasManyThrough(GaleryMua::class, AdminMuaType::class, 'admin_id', 'admin_mua_type_id');
    }
    

}
