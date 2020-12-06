<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $products=Product::get();
        $categories=Category::get();
        return  view('admin.product.index',[
            'products'=>$products,
            'categories'=>$categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $product=Product::all();
        $categories=Category::all();
        return  view('admin.product.create',[
            'product'=>$product,
            'categories'=>$categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:40|string|unique:products,name',
            'price'=>'required|numeric|gt:0',
            'category_id'=>'required',
            'quantity'=>'required|numeric|gt:0',
            'img'=>'required|image|mimes:jpg,jpeg,png',
            'status'=>'required',
        ]);
        $img=$request->file('img');
        $ext=$img->getClientOriginalExtension();
        $img_name='product'.uniqid().".$ext";
        $img->move(public_path('frontEnd/images/products/'),$img_name);


        if($request->status=='on')
            $status=1;
        else
            $status=0;

        Product::create(
            [
                'name'=>$request->name,
                'price'=>$request->price,
                'category_id'=>$request->category_id,
                'quantity'=>$request->quantity,
                'img'=>$img_name,
                'status'=>$status,
            ]);
        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $categories=Category::all();
        return  view('admin.product.edit',[
            'product'=>$product,
            'categories'=>$categories,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::find($id);
        $request->validate([
            'name'=>'required|max:40|string',
            'price'=>'required|numeric|gt:0',
            'category_id'=>'required',
            'quantity'=>'required|numeric|gt:0',
            'img'=>'image|mimes:jpg,jpeg,png',
        ]);

        $img_name=$product->img;
        if($request->hasFile('img'))
        {
            if($product->img!=null) //link old image
                unlink(public_path('frontEnd/images/products/'.$img_name));
            $img=$request->img;
            $ext=$img->getClientOriginalExtension();
            $img_name='product'.uniqid().".$ext";
            $img->move(public_path('frontEnd/images/products/'),$img_name);

        }

        if($request->status=='on')
            $status=1;
        else
            $status=0;

        $product->update(
            [
                'name'=>$request->name,
                'price'=>$request->price,
                'category_id'=>$request->category_id,
                'quantity'=>$request->quantity,
                'img'=>$img_name,
                'status'=>$status,
            ]);
        return redirect(route('admin.product.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod= Product::find($id);
        if($prod->img!=null)
            unlink(public_path("frontEnd/images/products/$prod->img"));
        $prod->delete();
        return response()->json();

    }
    public function AddToCart($id){
        $product=Product::find($id);
        if(session()->has('cart'))
            $cart=new Cart(session()->get('cart'));
        else
            $cart=new Cart();
        $cart->add($product);
        session()->put('cart',$cart);
        return redirect()->route('shop');
    }
    public function Viewcart()
    {
        if(session()->has('cart'))
            $cart=new Cart(session()->get('cart'));
        else
            $cart=new Cart();

        return view('client.cart',
            [
                'cart'=>$cart,
            ]);
    }
}
