@extends('layout.app_admin')

@foreach($errors->all() as $error)
    <div class="alert alert-danger mt-3" >{{$error}}</div>
@endforeach

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                            <tr>
                                <th>Product #</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>image</th>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $count=0 @endphp
                            @foreach($products as $pro)
                                <tr id="row_pro{{$pro->id}}">
                                    <td>{{$count+=1}}</td>
                                    <td>{{$pro->name}}</td>
                                    <td>{{$pro->price}}$</td>
                                    <td>{{$pro->quantity}} Kilos</td>

                                    <td><img src="{{asset("frontEnd/images/products/$pro->img")}}" class="img-fluid "></td>
                                    <td>{{$pro->category_id}}</td>
                                    @if($pro->quantity>0)
                                        <td>
                                            <label class="badge badge-success">Activated</label>
                                        </td>
                                    @else
                                        <td>
                                            <label class="badge badge-danger">Unactivated</label>
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{route('product.edit',$pro->id)}}" class="btn btn-outline-primary">Edit</a>
                                        <a  type="submit" onclick="deleteProduct(event.target)" data-id="{{ $pro->id }}" class="btn btn-outline-danger">Delete</a>


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7 offset-2">
        <div class="alert alert-success mt-3"  style="display: none" id="msg_success"></div>
    </div>
@endsection

@section('script')
    <script src="{{asset('backEnd/js/data-table.js')}}"></script>
    <script>
        function deleteProduct(event) {
            var id  = $(event).data("id");
            let _url = `/product/${id}`;
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $("#msg_success").hide();

            $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response) {
                    $("#row_pro"+id).remove();
                    $("#msg_success").show()
                    $("#msg_success").text("Deleted Successfully")
                }

            });
        }

    </script>
@endsection
