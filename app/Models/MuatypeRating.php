<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuatypeRating extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'muatype_id', 'customer_id', 'rating', 'review'];

    public function muatype()
    {
        return $this->belongsTo(Muatype::class);
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

