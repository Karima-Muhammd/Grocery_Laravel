@extends('layout.app_admin')
@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Product</h4>
                    <form  method="post" action="{{route('product.store')}} " enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="input-group mt-2">
                                <span class="mt-2 mr-5">Name:</span>
                                <input value="{{old('name')}}" id="cname" class="form-control" name="name" placeholder="Product Name .."  type="text" >
                            </div>
                            <div class="input-group mt-2">
                                <span class="mt-2 mr-5">Price:</span>
                                <input id="cname" class="form-control"  placeholder="Product price .." value="{{old('price')}}"  name="price"  type="text" >
                            </div>

                            <div class="input-group  mt-2">
                                <span class="mt-2 mr-5">Image:</span>
                                <input type="file"  class="form-control" name="img">
                            </div>
                              <div class="input-group  mt-2">
                                <span class="mt-2 mr-4">Quantity:</span>
                                <input type="number" value="{{old('quantity')}}"  min="1" class="form-control" name="quantity">
                            </div>

                            <div class="input-group mb-3 mt-2">
                                <span class="mt-2 mr-4">Category :</span>
                                <select name="category_id" class="custom-select" id="inputGroupSelect01">
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <small >Product status:</small> <input  name="status" type="checkbox" aria-label="Checkbox for following text input">
                            </div>
                            <input class="btn btn-primary mt-2" type="submit" name="status" value="Submit">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger mt-3" >{{$error}}</div>
        @endforeach
    @endif

@endsection

@section('script')
    <script src="js/form-validation.js"></script>
    <script src="js/bt-maxLength.js"></script>
@endsection
