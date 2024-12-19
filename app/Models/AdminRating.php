<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRating extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'admin_id', 'customer_id', 'rating', 'review'];

    public function admin()
    {
        return $this->belongsTo(Admins::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
}
