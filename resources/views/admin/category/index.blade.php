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
                                <th>Category #</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $count=0 @endphp
                            @foreach($categories as $category)
                                <tr id="row_cate{{$category->id}}">
                                    <td>{{$count+=1}}</td>
                                    <td>{{$category->name}}</td>
                                    <td><img src="{{asset("frontEnd/images/categories/$category->img")}}" class="img-fluid "></td>
                                    <td>
                                        <label class="badge badge-info">On hold</label>
                                    </td>
                                    <td>
                                        <a href="{{route('category.edit',$category->id)}}" class="btn btn-outline-primary">Edit</a>
                                        <a  type="submit" onclick="deleteCategory(event.target)" data-id="{{ $category->id }}" class="btn btn-outline-danger">Delete</a>


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
        function deleteCategory(event) {
            var id  = $(event).data("id");
            let _url = `category/${id}`;
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $("#msg_success").hide();

            $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response) {
                    $("#row_cate"+id).remove();
                    $("#msg_success").show()
                    $("#msg_success").text("Deleted Successfully")
                }

            });
        }

    </script>
@endsection
