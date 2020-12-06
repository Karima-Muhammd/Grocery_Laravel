<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected  $fillable=['name','img'];
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public static function boot() {
        parent::boot();

        static::deleting(function($category) {
            // here you could instantiate each related product
            // in this way the boot function in the product model will be called
            $category->products->each(function($product) {
                // and then the static::deleting method when you delete each one
                unlink(public_path("frontEnd/images/products/$product->img"));
                $product->delete();
            });
        });
    }
}
