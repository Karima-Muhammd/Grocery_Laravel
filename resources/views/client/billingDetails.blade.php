@extends('layout.app')
@section('title')
    Check-out
@endsection
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('{{asset("frontEnd/images/bg_1.jpg")}}')">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
                <h1 class="mb-0 bread">Billing Details</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                <form action="{{route('save.order')}}" class="billing-form" method="post">
                    @csrf
                    <h3 class="mb-4 billing-heading">Billing Details</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname" >Full Name</label>
                                <input type="text" value="{{old('name')}}" name="name" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Email </label>
                                <input type="text" value="{{old('email')}}"  name="email" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Phone</label>
                                <input type="text" value="{{old('phone')}}"  name="phone" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Address</label>
                                <input type="text" value="{{old('address')}}" name="address" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <button   class="btn btn-primary py-3 px-4">Place an order</button>
                </form><!-- END -->
                @include('inc.errors')

            </div>
            <div class="col-xl-5">
                <div class="row mt-5 pt-3">
                    <div class="col-md-12 d-flex mb-5">
                        <div class="cart-detail cart-total">
                            <h3 class="billing-heading mb-4">Cart Total</h3>
                            <p class="d-flex">
                                <span>Quantity</span>
                                <span>{{$cart->totalQty}} Kilo</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span>{{$cart->totalPrice}} EGP</span>
                            </p>
                        </div>
                    </div>

                </div>
            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section> <!-- .section -->


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
