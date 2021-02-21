@extends('layout.admin-app')
@section('styles')
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
@endsection
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order Details </h6>
        </div>
        <div class="row">
        <div class="col-md-6 p-4">
        <table class="table border">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ITEMS ORDERED</th>
                <th scope="col">NAME</th>
                <th scope="col">QTY</th>
                <th scope="col">PRICE</th>
            </tr>
            </thead>
            <tbody>
            @php $x=0 @endphp
            @foreach($order as $ord)
                <tr>
                    <td><img width="130rem" class="img-thumbnail" src="{{asset('frontEnd/images/products/'.$ord->img)}}"></th>
                    <td>{{$ord->product_name}}</td>
                    <td>{{$ord->product_quantity}}</td>
                    <td>{{$ord->product_price}} EGP</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="col-md-5 " style="margin-top: 30px">
            <p><strong>ORDER NAME :</strong> {{$order[0]->order_id}} </p>
            <p><strong>TOTAL PRICE :</strong> {{$order[0]->total_price}} EGP</p>
            <p><strong>STATUS :</strong> {{$order[0]->status}}</p>
            <label>Update Status:</label>
            <form id="editStatus" data-id="{{ $order[0]->order_id}}" class="form-group" action="{{route('Status.save',$order[0]->order_id)}}" method="post">
                @csrf
                <select name="status" class="form-select  input-group mb-3" aria-label="Default select example">
                    <option @if($order[0]->status =='Processed')selected @endif value="Processed">Processed</option>
                    <option @if($order[0]->status =='Shipped') selected @endif value="Shipped">Shipped</option>
                    <option @if($order[0]->status =='En Route')selected @endif value="En Route">En Route</option>
                    <option @if($order[0]->status =='Arrived') selected @endif value="Arrived">Arrived</option>
                </select>
                <button type="submit" class="btn btn-success">Save</button>
            </form>

            <div class="alert alert-success mt-3"  style="display: none" id="msg_success"></div>
        </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
    <script>

        $("#editStatus").submit(function (e)
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault()
            let client_data= new FormData($("#editStatus")[0])
            console.log(client_data)
            var id  = $("#editStatus").data("id");
            let _url = `/Order/save/${id}`;
            //  console.log(cate_date.get('name'))
            $.ajax({
                type:"post",
                url:_url,
                data:client_data,
                contentType:false,
                processData:false,
                success : function (data)
                {
                    $("#msg_success").show()
                    $("#msg_success").text(data.success)

                },

            });
        });


    </script>
@endsection
