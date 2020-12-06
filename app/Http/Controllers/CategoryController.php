<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $categories= Category::get();
        return view('admin.category.index', [
                'categories'=>$categories
            ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:30|string|unique:categories,name',
            'img'=>'required|image|mimes:jpg,jpeg,png',
        ]);

        $img=$request->img;
        $ext=$img->getClientOriginalExtension();
        $img_name="Category-".uniqid().".$ext";
        $img->move(public_path('frontEnd/images/categories/'),$img_name);
        Category::create([
            'name'=>$request->name,
            'img'=>$img_name,
        ]);
        return redirect(route('category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $categories=Category::get();
        $products_cate=Product::where('category_id','=',$id)->paginate(8);
      return view('client.shop',['products'=>$products_cate,'categories'=>$categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category=Category::find($id);

        return view('admin.category.edit',[
            'category'=>$category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $category=Category::find($id);
        $request->validate([
            'name'=>'required|max:30|string|unique:categories,name',
            'img'=>'image|mimes:jpg,jpeg,png',
        ]);
        $img_name=$category->img;
        if($request->hasFile('img'))
        {
            //delete  the old
            if($category->img!=null)
                unlink(public_path("frontEnd/images/categories/$img_name"));

            //update the new
            $img=$request->img;
            $ext=$img->getClientOriginalExtension();
            $img_name="Category-".uniqid().".$ext";
            $img->move(public_path('frontEnd/images/categories/'),$img_name);

        }
        $category->update([
            'name'=>$request->name,
            'img'=>$img_name,
        ]);
        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category= Category::find($id);
        if($category->img!==null)
            unlink(public_path("frontEnd/images/categories/$category->img"));
        $category->delete();
        return response()->json();

    }


}
