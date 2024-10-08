<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const PENDING = "pending";
    public const COMPLETED = "completed";
    public const CANCELLED = "cancelled";

    protected $fillable = [
        'user_id',
        'total_price',
        'snap_token',
        'note',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
