<html>
<head>
    <title>Track Your Order</title>
<style>
    body {
        color: #000;
        overflow-x: hidden;
        background-color: #8C9EFF;
        background-repeat: no-repeat
    }
    .navbar.bg-light{
        background-color: #651FFF !important;
    }
    .navbar-light .navbar-brand{
        color: white !important;
        font-weight: bold;
    }
    .navbar-light .navbar-nav .active>.nav-link, .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .nav-link.show, .navbar-light .navbar-nav .show>.nav-link
    {
        color: white !important;
        font-weight: bold;
    }
    .card {
        z-index: 0;
        background-color: #ECEFF1;
        padding-bottom: 20px;
        margin-top: 20px;
        margin-bottom: 90px;
        border-radius: 10px
    }

    .top {
        padding-top: 40px;
        padding-left: 13% !important;
        padding-right: 13% !important
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: #455A64;
        padding-left: 0px;
        margin-top: 30px
    }

    #progressbar li {
        list-style-type: none;
        font-size: 13px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar .step0:before {
        font-family: FontAwesome;
        content: "\f10c";
        color: #fff
    }

    #progressbar li:before {
        width: 40px;
        height: 40px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        background: #C5CAE9;
        border-radius: 50%;
        margin: auto;
        padding: 0px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 12px;
        background: #C5CAE9;
        position: absolute;
        left: 0;
        top: 16px;
        z-index: -1
    }

    #progressbar li:last-child:after {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        position: absolute;
        left: -50%
    }

    #progressbar li:nth-child(2):after,
    #progressbar li:nth-child(3):after {
        left: -50%
    }

    #progressbar li:first-child:after {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        position: absolute;
        left: 50%
    }

    #progressbar li:last-child:after {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px
    }

    #progressbar li:first-child:after {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #651FFF
    }

    #progressbar li.active:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    .icon {
        width: 60px;
        height: 60px;
        margin-right: 15px
    }

    .icon-content {
        padding-bottom: 20px
    }

    @media screen and (max-width: 992px) {
        .icon-content {
            width: 50%
        }
    }
</style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">{{ 'Hi , '. auth()->user()->name }} </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto float-right">
        </ul>
        <ul class="navbar-nav  float-right">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('client_logout')}}">Logout <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
<div class="container px-1 px-md-4 mb-5  mx-auto" >
    <h1 CLASS="text-center pt-4" style="font-family: 'Agency FB',serif">TRACK YOUR ORDER</h1>
    <div class="card p-5  " style="  box-shadow: 5px 5px 8px 5px #b7b9cc;">

        <div class="row d-flex justify-content-between px-3 top">
            <div class="d-flex">
                <h5>ORDER <span class="text-primary font-weight-bold">#{{auth()->user()->orders[0]->order_id}}</span></h5>
            </div>
            <div class="d-flex flex-column text-sm-right">
                <p class="mb-0 ">Expected Arrival <span class="font-weight-bold">{{auth()->user()->created_at->addDays(7)->format('Y-m-d')}}</span></p>
                <p>Address <span class="font-weight-bold">{{auth()->user()->address}}</span></p>
            </div>
        </div> <!-- Add class 'active' to progress -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <ul id="progressbar" class="text-center">
                    @if(auth()->user()->orders[0]->status =='Processed')
                    <li class="active  step0"></li>
                    <li class=" step0"></li>
                    <li class=" step0"></li>
                    <li class=" step0"></li>
                    @elseif(auth()->user()->orders[0]->status =='Shipped')
                        <li class="active  step0"></li>
                        <li class="active  step0"></li>
                        <li class=" step0"></li>
                        <li class=" step0"></li>
                    @elseif(auth()->user()->orders[0]->status =='En Route')
                        <li class="active  step0"></li>
                        <li class="active  step0"></li>
                        <li class=" active step0"></li>
                        <li class=" step0"></li>
                    @elseif(auth()->user()->orders[0]->status =='Arrived')
                            <li class="active  step0"></li>
                            <li class="active  step0"></li>
                            <li class="active step0"></li>
                            <li class="active step0"></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="row justify-content-between top">
            <div class="row d-flex icon-content">
                <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>Processed</p>
                </div>
            </div>
            <div class="row d-flex icon-content">
                <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>Shipped</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/TkPm63y.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>En Route</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>Arrived</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
