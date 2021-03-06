@extends('layout.app')
@section('title')
    Shop
@endsection
@section('content')

<div class="hero-wrap hero-bread" style="background-image: url('{{asset('frontEnd/images/bg_1.jpg')}}');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
                <h1 class="mb-0 bread">Products</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    <li><a href="{{route('shop')}}" @if(request()->is('shop'))class="active"@endif>All</a></li>
                @foreach($categories as $cate)
                        <li><a href="{{route('category.show',$cate->id)}}" @if(request()->is('category/'.$cate->id))class="active"@endif >{{$cate->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid" src="{{asset("frontEnd/images/products/$product->img")}}" alt="Colorlib Template">
                            @if($product->offer!=null)
                                <span class="status">{{$product->offer."%"}}</span>
                            @endif
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#">{{$product->name}}</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    @if($product->offer!=null)
                                        <p class="price"><span class="mr-2 price-dc">${{$product->price}}</span>
                                            <span class="price-sale"> ${{$product->price-(($product->price*$product->offer)/100)}} </span></p>
                                    @else
                                        <span class="price-sale"> ${{$product->price}} </span></p>
                                    @endif
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a type="submit"  class=" btn buy-now d-flex justify-content-center align-items-center">
                                        <i data-id="{{$product->id}}" onclick="addProduct(event.target)"  class="ion-ios-cart"></i>
                                    </a>
                                    <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                        <span><i class="ion-ios-heart"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-lg-12 mt-5 " >
                <div style="margin-left: 40%" >
                    {!! $products->render() !!}
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@section('script')
    <script src="{{asset('frontEnd/js/jquery-3.5.1.min.js')}}"></script>

    <script>
        function addProduct(event) {

            var id='';
            id  = $(event).data("id");
            console.log(id);
            let _url = `/addCart/${id}`;
            console.log(_url);

            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });
            $.ajax({
                url: _url,
                type: 'get',
                data: {
                    _token: _token
                },
                success: function(response) {
                    var card_items=parseInt(document.getElementById('totalCart').innerText);
                    card_items+=1;
                    document.getElementById('totalCart').innerText=card_items;

                }
            });
        }

    </script>

@endsection
