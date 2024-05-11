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
                <a href="{{ route('product.all')}}" class="btn btn-outline-primary px-5 radius-30">All Products</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="card">
        <div class="card-header">
            <h3>Add Product</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('product.store')}}" method="post" id="myForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row">
                    <div class="col-md-6">
                        <label for="product_name" class="form-label text-dark">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" />
                    </div>
                    <div class="col-md-6">
                        <label for="category_id" class="form-label text-dark">Category</label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">Choose Category</option>
                            @foreach ($categories as $cate)

                            <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="quantity" class="form-label text-dark">Quantity</label>
                        <input type="text" name="quantity" id="quantity" class="form-control" />
                    </div>
                    <div class="col-md-6">
                        <label for="price" class="form-label text-dark">Price</label>
                        <input type="text" name="price" id="price" class="form-control" />
                    </div>

                    <div class="col-md-12">
                        <label for="short_desc" class="form-label text-dark">Short Description</label>
                        <input type="text" name="short_desc" id="short_desc" class="form-control" />
                    </div>
                    <div class="col-md-12">
                        <label for="description" class="form-label text-dark">Description</label>
                        <textarea id="content_tindy" name="description" id="description"
                            class="form-control"></textarea>
                    </div>
                    <div class="col-md-3 pt-3">
                        <label for="hot_deal" class="form-label text-dark">Hot Deal</label>
                        <input type="checkbox" name="hot_deal" id="hot_deal" class="form-check-input" />
                    </div>
                    <div class="col-md-3 pt-3">
                        <label for="hot_new" class="form-label text-dark">Hot New</label>
                        <input type="checkbox" name="hot_new" id="hot_new" class="form-check-input" />
                    </div>
                    <div class="row mb-3 pt-4">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Image Product</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="file" name="image" class="form-control" id="image" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0"></h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <img id="showImage" src="{{ asset('/upload/no_image.jpg')}}"
                                class="rounded-circle p-1 bg-primary" width="80">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- load image call ajax --}}
<script type="text/javascript">
    // ajax call image upload change img profile
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection