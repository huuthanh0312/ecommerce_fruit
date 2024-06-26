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
                    <li class="breadcrumb-item active p-1" aria-current="page">Customers</li>
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
                            <th class="text-center">SL</th>
                            <th class="text-center">Customer Name</th>
                            <th class="text-center">Customer Email</th>
                            <th class="text-center">Customer Phone</th>
                            <th class="text-center">Customer Address</th>
                            <th class="text-center"><span class="text-primary">Active</span>/<span class="text-danger">Inactive</span></th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $key => $item)

                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->address}}</td>
                            @if (Auth::user()->can('customer.action'))
                            <td>
                                <div class="form-switch center">
                                <input type="checkbox" class="form-check-input status-toggle large-checkbox"
                                        id="flexSwitchCheckedDanger" data-customer-id="{{$item->id}}" 
                                        {{($item->status ='active') ? 'checked' : ''}} style="front-size: 10px;">
                                </div>
                            </td>
                            <td>
                                <button id="{{$item->id}}" onclick="customerEdit(this.id)" class="btn btn-outline-warning radius-30" title="Edit">
                                    <i class="bx bx-edit"></i>
                                </button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add Category -->
    <div class="modal fade" id="edit_customer" tabindex="-1" aria-labelledby="exLargeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Information Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('customer.update')}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body row">
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-6">
                            <label for="name" class="form-label text-dark">Customer Name</label>
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label text-dark">Customer Email</label>
                            <input type="text" name="email" id="email" class="form-control" disabled />
                        </div>
                        <div class="col-md-12">
                            <label for="phone" class="form-label text-dark">Customer Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" />
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label text-dark">Customer Address</label>
                            <input type="text" name="address" id="address" class="form-control" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
<script>
    function customerEdit(id){
    $.ajax({
        type: "get",
        url:  "/customer/edit/" + id,
        dataType: "json",
        success: function(data){
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#phone').val(data.phone);
            $('#address').val(data.address);
            $('#edit_customer').modal('show');
        }
    })
    }
    
</script>
<script>
    $(document).ready(function(){
        $('.status-toggle').on('change', function(){
            var customerId = $(this).data('customer-id');
            var isChecked = $(this).is(':checked');
            // send ajax request to update satus 

            $.ajax({
                url: "{{route('customer.update.status')}}",
                method: 'POST',
                data: {
                    customer_id: customerId,
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