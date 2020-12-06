@extends('layout.app_admin')
@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Category</h4>
                    <form   method="post" action="{{route('category.update',$category->id)}}" enctype="multipart/form-data">
                        {{method_field('PUT')}}
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label for="cname">Name </label>
                                <input id="cname" class="form-control" name="name" value="{{old('name',$category->name)}}"  type="text" >
                            </div>
                            <div class="input-group  mt-2">
                                <input  type="file"  class="form-control d-block" name="img">
                            </div>
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </fieldset>
                    </form>
                </div>

            </div>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger mt-3" >{{$error}}</div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script src="js/form-validation.js"></script>
    <script src="js/bt-maxLength.js"></script>
@endsection
