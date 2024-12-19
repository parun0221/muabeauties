<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'admin_id',
        'muatype_id',
        'booking_date',
        'start_time',
        'end_time',
        'total_price',
        'dp',
        'status',
    ];

    // Relasi dengan model User sebagai Customer
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    // Relasi dengan model Admin sebagai Admin yang dibooking
    public function admin()
    {
        return $this->belongsTo(Admins::class, 'admin_id');
    }

    // Relasi dengan model Muatype untuk jenis makeup yang dipilih
    public function muatype()
    {
        return $this->belongsTo(Muatype::class, 'muatype_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
