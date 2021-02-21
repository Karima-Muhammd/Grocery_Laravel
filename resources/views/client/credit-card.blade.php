@extends('layout.app')
@section('title')
    Check-out
@endsection
@section('style')
    @include('inc.inc_stripe.styles')
@endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{asset("frontEnd/images/bg_1.jpg")}}')">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span>
                    </p>
                    <h1 class="mb-0 bread">Checkout</h1>
                </div>
            </div>
        </div>
    </div>
    @php
        $stripe_key = 'pk_test_51HyG85IAjOP49qP095nqAT4HIb1Urf34HkBaO0Z6BIpnL9gpOkTJx8139oRrksZNyleDBmeMfJmx3J8GO13MBQ3R00HzlFAooZ';
    @endphp
    <div class="container" style="margin-top:10%;margin-bottom:10%">
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <div class="card bg-github">
                    <form action="{{route('checkout.credit-card')}}" method="post" id="payment-form">
                        @csrf
                        <div class="form-group">
                            <div class="card-header bg-dark">
                                <label for="card-element"
                                       style="color:white ;font-family:'Century Schoolbook',fantasy; font-weight: bolder">
                                    Enter your credit card information
                                </label>
                            </div>
                            <div class="card-body">
                                <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                                <input type="hidden" name="plan" value=""/>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="card-button" class="btn btn-dark" type="submit" data-secret="{{ $intent }}">
                                Pay {{session()->get('cart')->totalPrice}} EGP
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    @include('inc.inc_stripe.scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)

        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        const stripe = Stripe('{{ $stripe_key }}', {locale: 'en'}); // Create a Stripe client.
        const elements = stripe.elements(); // Create an instance of Elements.
        const cardElement = elements.create('card', {style: style}); // Create an instance of the card Element.
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

        // Handle real-time validation errors from the card Element.
        cardElement.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.handleCardPayment(clientSecret, cardElement, {
                payment_method_data: {
                    billing_details: {
                        email: '{{session()->get('user')['email']}}',
                        name: '{{session()->get('user')['name']}}'
                    }
                }
            })
                .then(function (result) {
                    console.log(result);
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        console.log(result);
                        form.submit();
                    }
                });
        });
    </script>
@endsection
