<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::get()->unique('order_id');
        return  view('admin.orders.index',['orders'=>$orders]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($order_id)
    {

        $order_details=Order::where('order_id','=',$order_id)->get();
        return view('admin.orders.view',['order'=>$order_details]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
    public function save(Request $request, $order_id)
    {
        $orders=Order::where('order_id','=',$order_id)->get();
        foreach ($orders as $order)
        {
            $order->status=$request->status;
            $order->save();
        }
        return response()->json(['success'=>'Status updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($order_id)
    {
        $orders=Order::where('order_id','=',$order_id)->get();
        foreach ($orders as $order )
            $order->delete();

        return response()->json([
            'success'=>"Successfully Deleted"
        ]);
    }
}
