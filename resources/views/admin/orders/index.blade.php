@extends('layout.admin-app')
@section('styles')
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Orders </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="font-size: 12px" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr style="text-align: center"  >
                        <td>ID</td>
                        <td>Order ID</td>
                        <td>Total Price </td>
                        <td>Order Status</td>
                        <td>Client ID</td>
                        <td>Client Email</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr style="text-align: center">
                        <td >ID</td>
                        <td>Order ID</td>
                        <td>Total Price </td>
                        <td>Order Status</td>
                        <td>Client ID</td>
                        <td>Client Email</td>
                        <td>Actions</td>
                    </tr>
                    </tfoot>
                    <tbody style="text-align: center">
                @foreach($orders as $order)
                    <tr id="row_order{{$order->order_id}}" >
                        <td>{{$order->id}}</td>
                        <td>{{$order->order_id}}</td>
                        <td>{{$order->total_price}}</td>
                        <td><b>{{$order->status}}</b></td>
                        <td>{{$order->user_id}}</td>
                        <td>{{$order->user->email}}</td>
                        <td  >
                            <a  href="{{route('order.show',$order->order_id)}}" style="padding: 4px; width: 80px" class="btn btn-success">Show</a>
                            <a type="submit" onclick="deleteOrder(event.target)" data-id="{{ $order->order_id }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
    <script>
    function deleteOrder(event) {
        var id  = $(event).data("id");
        let _url = `/Order/${id}`;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
        url: _url,
        type: 'DELETE',
        data: {
        _token: _token
        },
        success: function(response)
        {
            $("#row_order"+id).remove();
        }
    });
    }

    </script>

@endsection
