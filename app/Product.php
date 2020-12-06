<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Product extends Model
{
    protected $guarded=['id'];
    public function Category()
    {
        return $this->belongsTo('App\Category');
    }
}
