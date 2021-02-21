@extends('layout.admin-app')
@section('styles')
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the
         <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Subscriber </h6>
        </div>
        <div class="col-md-12  mt-3 pb-5">
{{--id="editSubscriber" data-id="{{ $user->id }}"--}}
            <form class="mt-3" id="editClient" data-id="{{ $user->id }}"  >
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Client Name </label>
                        <input type="text" name="name" value="{{old('name',$user->name)}}" placeholder="Name .." class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Email Address </label>
                        <input type="text" name="email" value="{{old('email',$user->email)}}" placeholder="Email.." class="form-control">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Phone Number </label>
                        <input type="text" name="phone" value="{{old('phone',$user->phone)}}"  placeholder="Phone Number .." class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Client Address</label>
                        <input type="text" name="address" value="{{old('address',$user->address)}}"  placeholder="Address .." class="form-control">
                    </div>


                    <div class="col-md-8 text-center">
                        <button type="submit" style="width: 15rem; margin-left: 18rem" class="btn btn-success " >Update</button>
                    </div>

                </div>
                <div class="input-group col-md-6 offset-3 mt-3 text-center">

                </div>
            </form>
{{--            @include('inc.errors')--}}
            <div class="alert alert-success mt-3"  style="display: none" id="msg_success"></div>
            <div class="alert alert-danger mt-3"  style="display: none" id="msg_error"></div>

        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
    <script>

        $("#editClient").submit(function (e)
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault()
            $("#msg_error").hide()
            $("#msg_error").empty()

            $("#msg_success").hide()
            $("#msg_success").empty()

            let client_data= new FormData($("#editClient")[0])
            console.log(client_data)
            var id  = $("#editClient").data("id");
            let _url = `/Admin/User/edit/${id}`;
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
                error : function (xhr,status,error)
                {
                    $("#msg_error").empty()
                    $("#msg_error").show()
                    $.each(xhr.responseJSON.errors,function (key,item)
                    {
                        $("#msg_error").append("<p>"+ item +"</p>")

                    });
                }
            });
        });


    </script>
@endsection
