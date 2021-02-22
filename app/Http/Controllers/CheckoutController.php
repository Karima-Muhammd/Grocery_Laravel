<?php

namespace App\Http\Controllers;

use App\Notifications\PayOrder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Stripe\Stripe;
use Notification;

class CheckoutController extends Controller
{
    public function checkout()
    {
        // Enter Your Stripe Secret
        Stripe::setApiKey('sk_test_51HyG85IAjOP49qP0q6Mf7MAQ6K61ipCTjSKcMAMR1QzDKPdJlKsSe0hwArHEmiqIunj2VHnaVu7WR9z5QVqL0CFj00qJo0fHAU');
        $user=User::where('email','=',Session::get('user')['email'])->first();
        $quantity =session()->get('cart')->totalQty;
        $amount=session()->get('cart')->totalPrice;
        $amount *= 100;
        $amount = (int) $amount;

        $payment_intent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'EGP',
            'description' => "$user->name Bought $quantity Kilo ",
            'payment_method_types' => ['card'],
        ]);
        $cart=\session()->get('cart');
        $intent = $payment_intent->client_secret;
        return view('client.credit-card',['intent'=>$intent,'cart'=>$cart]);

    }

    public function afterPayment()
    {
        $user=User::where('email','=',Session::get('user')['email'])->first();
        $user->status=1;
        $user->save();
        foreach (session()->get('cart')->items as $item )
        {
            $order=$user->orders()->create([
                'product_name'=>$item['name'],
                'product_price'=>$item['price'],
                'img'=>$item['img'],
                'product_quantity'=>$item['qty'],
                'user_id'=>$user->id,
                'order_id'=>'Order'.$user->id,
                'total_price'=>session()->get('cart')->totalPrice
            ]);
        }
        Notification::send(User::find(1),new PayOrder($order));
        session()->forget('cart');
        session()->forget('user');
        toast("Payment was done , Thanks ",'success');
        return redirect(route('home'));
    }
}
