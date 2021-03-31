<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="">Vegefoods</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{route('home')}}" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="{{route('shop')}}">Shop</a>
                        <a class="dropdown-item" href="{{route('cart.view')}}">Cart</a>
                        @if(session()->has('user'))
                        <a class="dropdown-item" href="{{route('credit-card')}}">Checkout</a>
                        @endif
                    </div>
                </li>


                <li class="nav-item cta cta-colored"><a href="{{route('cart.view')}}" class="nav-link"><span class="icon-shopping_cart"></span>[<span id="totalCart">{{session()->has('cart')?session()->get('cart')->totalQty:0}}</span>]</a></li>
                <li class="nav-item"><a @if(!auth()->check() || auth()->user()->role !='user') type="button" data-toggle="modal" data-target="#exampleModal"  @endif  href="{{route('Track')}}"  class="nav-link">Track Your Order</a></li>
                <li class="nav-item"><a class="nav-link">|</a></li>
                <li class="nav-item"><a @auth @if(auth()->user()->role=='admin' ) href="{{route('admin_index')}}" @endif href="{{route('login')}}"  @endauth  href="{{route('login')}}"  class="nav-link">Admins</a></li>
            </ul>
        </div>
    </div>
</nav>
