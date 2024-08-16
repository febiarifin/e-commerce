<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public const ACTIVE = "active";
    public const INACTIVE = "inactive";

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock', 
        'status'
    ];
}
