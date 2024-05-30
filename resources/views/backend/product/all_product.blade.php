@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
    .large-checkbox {
        transform: scale(1.5);
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active p-1" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
        @if (Auth::user()->can('product.action'))
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('product.add')}}" class="btn btn-outline-primary px-5 radius-30">Add Product</a>
            </div>
        </div>
        @endif
    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Code</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Category</th>
                            <th class="text-center"><span class="text-primary">Active</span>/<span class="text-danger">Inactive</span></th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $item)

                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td><a href="{{ route('product.edit', $item->id)}}">{{$item->code}}</a></td>
                            <td>
                                <img class="rounded-circle p-1 bg-primary" src="{{ (!empty($item->image)) ? url($item->image) 
                                : url('upload/no_image.jpg')}}" width="50">
                            </td>
                            <td>{{Str::limit($item->product_name, 20)}}</td>
                            <td>{{$item['category']['category_name']}}</td>
                            <td>
                                @if (Auth::user()->can('product.action'))
                                <div class="form-switch center">
                                    <input type="checkbox" class="form-check-input status-toggle large-checkbox"
                                        id="flexSwitchCheckedDanger" data-product-id="{{$item->id}}" 
                                        {{($item->status == 1) ? 'checked' : ''}} style="front-size: 10px;">
                                </div>
                                @endif
                            </td>
                            <td class="p-0">
                                @if (Auth::user()->can('product.action'))
                                <a href="{{ route('product.edit', $item->id)}}" title="Edit"
                                    class="btn btn-outline-warning radius-30"><i class="bx bx-edit-alt"></i></a>
                                <a href="{{ route('product.delete', $item->id)}}" id="delete" title="Delete"
                                    class="btn btn-outline-danger radius-30"><i class=" bx bx-trash"></i></a>
                                @endif    
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>



</div>
<script>
    $(document).ready(function(){
        $('.status-toggle').on('change', function(){
            var productId = $(this).data('product-id');
            var isChecked = $(this).is(':checked');
            // send ajax request to update satus 

            $.ajax({
                url: "{{route('product.update.status')}}",
                method: 'POST',
                data: {
                    product_id: productId,
                    is_checked: isChecked ? 1 : 0,
                    _token: "{{csrf_token()}}"
                },
                success: function(response){
                    toastr.success(response.message);
                },
                error: function(response){
                    toastr.error(response.message);
                }
            })
        })
        
    })
</script>

@endsection