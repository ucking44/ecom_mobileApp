<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Review;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'product_image',
        'product_size',
        'product_color',
        'publication_status',
    ];
   
    public $timestamps = true;

    /**
     * Get the reviews of the product
     *
     *
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the user that added the product.
     *
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}


