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
                    <li class="breadcrumb-item active" aria-current="page">Categories</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                    class="btn btn-outline-primary px-5 radius-30">Add Category</button>

            </div>
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
                            <th>Category Name</th>
                            <th>Category Name Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $item)

                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{$item->category_name}}</td>
                            <td>{{$item->category_name_slug}}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#edit_category" id="{{$item->id}}"
                                    onclick="categoryEdit(this.id)"
                                    class="btn btn-outline-warning px-5 radius-30">Edit</button>
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

    <!-- Modal Add Category -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('category.store')}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12">
                            <label for="category_name" class="form-label text-dark">Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Category -->
    <div class="modal fade" id="edit_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('category.update')}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" />
                    <div class="modal-body">
                        <div class="col-md-12">
                            <label for="category_name" class="form-label text-dark">Category Name</label>
                            <input type="text" name="category_name" id="cat_name" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function categoryEdit(id){
    $.ajax({
        type: "get",
        url:  "/category/edit/" + id,
        dataType: "json",
        success: function(data){
            $('#id').val(data.id);
            $('#cat_name').val(data.category_name);
        }
    })
    }
</script>
@endsection