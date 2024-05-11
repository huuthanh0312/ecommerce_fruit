@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Contacts</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $key => $item)

                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{Str::limit($item->message, 25)}}</td>
                            <td>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#contact_show" id="{{$item->id}}"
                                    onclick="contactShow(this.id)"
                                    class="btn btn-outline-warning px-5 radius-30">Show</button>
                                <a href="{{ route('category.delete', $item->id)}}" id="delete"
                                    class="btn btn-outline-danger px-5 radius-30">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>


    <!-- Modal Show contact -->
    <div class="modal fade" id="contact_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Show Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card shadow-none bg-transparent border border-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Name Customer: <span id="name"></span></h5>
                        <h5 class="card-title">Email: <span id="name"></span></h5>
                        <p class="card-text" id="message"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function contactShow(id){
    $.ajax({
        type: "get",
        url:  "/contact/show/" + id,
        dataType: "json",
        success: function(data){
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#message').val(data.message);
        }
    })
    }
</script>
@endsection