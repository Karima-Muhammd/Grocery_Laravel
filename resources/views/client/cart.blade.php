@extends('layout.app')
@section('title')
    Cart
@endsection
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('{{asset('frontEnd/images/bg_1.jpg')}}')">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
                <h1 class="mb-0 bread">My Cart</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr class="text-center">
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>Product name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($cart))
                        @foreach($cart->items as $product)
                        <tr  class="text-center">
                            <td class="product-remove">
                                <a type="submit"  href="{{route('cart.remove.item',$product['id'] )}}" ><span class="ion-ios-close"></span></a>
                            </td>

                            <td class="image-prod"><div class="img" style="background-image:url({{asset("frontEnd/images/products/".$product['img'])}})"></div></td>

                            <td class="product-name">
                                <h3>{{$product['name']}}</h3>
                                <p>Far far away, behind the word mountains, far from the countries</p>
                            </td>

                            <td class="price">
                                @if($product['offer']!=null)
                                  {{$product['price']-(($product['price']*$product['offer'])/100)}} EGP
                                @else
                                  {{$product['price']}} EGP
                                @endif
                            </td>

                            <td class="quantity">
                                <div class="input-group mb-3">
                                    <input type="text" name="quantity" class="quantity form-control input-number" disabled value="{{$product['qty']}}" min="1" max="100">
                                </div>
                            </td>

                            <td class="total">
                                @if($product['offer']!=null)
                                    {{($product['price']-(($product['price']*$product['offer'])/100))*$product['qty']}} EGP
                                @else
                                    {{$product['price']*$product['qty']}} EGP
                                @endif
                            </td>
                        </tr><!-- END TR-->
                        @endforeach
                        @else
                            <p class="text-center ftco-animate ">No Item Added in Your Cart</p>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Cart Totals</h3>
                    <p class="d-flex">
                        <span>Total Quantity</span>
                        <span>{{isset($cart)?$cart->totalQty." Kilo":'--'}}</span>
                    </p>
                    <p class="d-flex">
                        <span>Price </span>
                        {{isset($cart)?($cart->totalPrice)." EGP ":'--'}}
                    </p>
                    <p class="d-flex">
                        <span>Delivery</span>
                        <span>{{isset($cart)?' 5.00 EGP':'--'}}</span>
                    </p>
                    <hr>
                    <p class="d-flex total-price font-weight-bold">
                        <span>Total</span>
                        <span >{{isset($cart)?($cart->totalPrice)." EGP":'--'}}</span>
                    </p>
                </div>
                @if(session()->has('cart'))
                <p><a href="{{route('cart.Details')}}" class="btn btn-primary py-3 text-center px-4">Proceed to Checkout</a></p>
                @endif
            </div>
        </div>
    </div>
</section>


@endsection

@section('script')
<script>
    $(document).ready(function(){

        var quantitiy=0;
        $('.quantity-right-plus').click(function(e){

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

        });

        $('.quantity-left-minus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if(quantity>0){
                $('#quantity').val(quantity - 1);
            }
        });

    });
</script>



@endsection
