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
    public function admins()
    {
        return $this->belongsToMany(Admins::class, 'admin_mua_type', 'muatype_id', 'admin_id');
    }
    

}
