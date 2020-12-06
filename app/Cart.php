<?php


namespace App;


class Cart
{

    public $items=[];
    public $totalQty;
    public $totalPrice;

    public function __construct($cart=null)
    {
        if($cart)
        {
            $this->items=$cart->items;
            $this->totalQty=$cart->totalQty;
            $this->totalPrice=$cart->totalPrice;
        }
        else
        {
            $this->items=[];
            $this->totalQty=0;
            $this->totalPrice=0;
        }
    }
    public function add($product)
    {
        $item=[
            'name'=>$product->name,
            'price'=>$product->price,
            'img'=>$product->img,
            'offer'=>$product->offer,
            'category_id'=>$product->category_id,
            'qty'=>0
        ];
        //if array exist in cart array
        if(!array_key_exists($product->id,$this->items))
        {
            $this->items[$product->id]=$item;
            $this->totalQty+=1;
            $this->totalPrice+=$product->price;
        }
        else
        {
            $this->totalQty+=1;
            $this->totalPrice+=$product->price;
        }
        $this->items[$product->id]['qty']+=1;
    }

}
