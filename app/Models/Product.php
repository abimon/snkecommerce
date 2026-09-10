<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'short_description',
        'price',
        'compare_price',
        'cover_image',
        'pdf_path',
        'pages',
        'featured',
        'is_active',
    ];

    // protected $casts = [
    //     'price' => 'decimal:2',
    //     'compare_price' => 'decimal:2',
    //     'featured' => 'boolean',
    //     'is_active' => 'boolean',
    // ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
