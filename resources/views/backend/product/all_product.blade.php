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
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('product.add')}}" class="btn btn-outline-primary px-5 radius-30">Add Product</a>

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
                            <th>Code</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $item)

                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{$item->code}}</td>
                            <td>
                                <img class="rounded-circle p-1 bg-primary" src="{{ (!empty($item->image)) ? url($item->image) 
                                : url('upload/no_image.jpg')}}" width="50">
                            </td>
                            <td>{{Str::limit($item->product_name, 25)}}</td>
                            <td>{{$item['category']['category_name']}}</td>
                            <td>{{$item->status}}</td>
                            <td>
                                <a href="{{ route('product.edit', $item->id)}}"
                                    class="btn btn-outline-warning radius-30">Edit</a>
                                <a href="{{ route('product.delete', $item->id)}}" id="delete"
                                    class="btn btn-outline-danger radius-30">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>



</div>


@endsection