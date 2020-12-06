<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{


    public function home()
    {
        $products =Product::paginate(8);
        $categories=Category::get();
        return view('client.home',['products'=>$products,'categories'=>$categories]);
    }

    public function shop()
    {
        $products =Product::paginate(8);
        $categories=Category::get();
        return view('client.shop',['products'=>$products,'categories'=>$categories]);
    }
    public function checkout()
    {
        return view('client.checkout');
    }
    public function login()
    {
        return view('client.login');
    }
    public function register()
    {
        return view('client.register');
    }

}
