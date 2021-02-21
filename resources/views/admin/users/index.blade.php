@extends('layout.admin-app')
@section('styles')
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Clients </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="font-size: 12px" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr style="text-align: center"  >
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th  >Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr style="text-align: center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th  >Actions</th>
                    </tr>
                    </tfoot>
                    <tbody style="text-align: center">
                    @foreach($users as $user)
                        <tr id="row_client{{$user->id}}" >
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->address}}</td>
                            <td >
                                <label data-val="{{$user->status}}" style="padding: 8px" data-id="{{ $user->id }}" class="badge badge-dark active-btn" onclick="active(event.target)"  >
                                    @if($user->status==1)Pay @else Didnt Pay @endif
                                </label>
                            </td>
                            <td  >
                                @if($user->status==1)
                                <a  href="{{route('User.edit',$user->id)}}" style="padding: 8px; margin-bottom: 4px; font-size: 10px" class="badge badge-success">Update</a>
                                @endif
                                <a type="submit" onclick="deleteClient(event.target)" style="padding: 8px; font-size: 10px" data-id="{{ $user->id }}" class="badge badge-danger">Delete</a></td>
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
        function deleteClient(event) {
            var id  = $(event).data("id");
            let _url = `/Admin/User/${id}`;
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response)
                {
                    $("#row_client"+id).remove();
                }
            });
        }
        // function active(event) {
        //     var id  = $(event).data("id");
        //     var val  = $(event).data("val");
        //     let _url = `/Admin/un-active/${id}`;
        //     let _token   = $('meta[name="csrf-token"]').attr('content');
        //
        //     $.ajax({
        //         url: _url,
        //         type: 'post',
        //         data: {
        //             _token: _token
        //         },
        //         success: function(response) {
        //
        //             if($('.active-btn').html()=='Active')
        //             {
        //                 $('.active-btn').html('UnActive');
        //                 $('#end').text(val)
        //             }
        //             else
        //             {
        //                 $('.active-btn').html('Active');
        //                 $('#end').empty();
        //             }
        //
        //         }
        //     });
        // }
    </script>


@endsection
