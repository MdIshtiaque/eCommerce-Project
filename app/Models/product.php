<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable= [
        'category_id',
        'name',
        'slug',
        'product_code',
        'product_price',
        'product_stock',
        'alert_quantity',
        'short_description',
        'long_description',
        'additional_info',
        'product_image',
        'product_rating',
        'is_active'
    ];



    public function category()
    {

        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
