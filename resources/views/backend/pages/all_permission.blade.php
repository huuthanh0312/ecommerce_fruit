@extends('admin.admin_dashboard')
@section('admin')

<div class="container-xxl flex-grow-1 container-p-y">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">     
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active p-1" aria-current="page">Permissions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button data-bs-toggle="modal" data-bs-target="#add_permission" class="btn btn-outline-primary px-5 radius-30">Add Permission</button>
                
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                    <thead >
                        <tr>
                            <th>SL</th>
                            <th>PERMINSSION NAME</th>
                            <th>GROUP NAME</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $item)
                          
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->group_name}}</td>
                            <td>
                                <button onclick="permissionEdit({{$item->id}})" class="btn btn-outline-warning radius-30" title="Edit">
                                    <i class="bx bx-edit"></i>
                                </button>
                                <a href="{{ route('permission.delete', $item->id)}}" id="delete" class="btn btn-outline-danger radius-30" title="Delete">
                                    <i class="bx bx-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>
 <!-- Modal Add Permission -->
 <div class="modal fade" id="add_permission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('permission.store')}}" method="post" id="myForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="name" class="form-label text-dark">Permission Name</label>
                        <input type="text" name="name" class="form-control" />
                    </div>
                    <div class="col-md-12">
                        <label for="name" class="form-label text-dark">Permission Group Name</label>
                        
                        <select name="group_name" class="form-select" required>
                            <option value="">Choose Group Name</option>
                            <option value="Category">Category</option>
                            <option value="Product">Product</option>
                            <option value="Order">Order</option>
                            <option value="Post">Post</option>
                            <option value="Contact">Contact</option>
                            <option value="Customer">Customer</option>
                            <option value="RoleAndPermission">Role And Permission</option>
                            <option value="SetupAdminUser">Setup Admin User</option>
                            <option value="SiteSetting">Site Setting</option>
                            <option value="SMTPSetting">SMTPSetting</option>
                        </select>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Permission -->
<div class="modal fade" id="edit_permission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('permission.update')}}" method="post" id="myForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id" />
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <label for="name" class="form-label text-dark">Permission Name</label>
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                        <div class="col-md-12">
                            <label for="name" class="form-label text-dark">Permission Group Name</label>
                            <select name="group_name" class="form-select" id="group_name" required>
                                <option value="">Choese Group Name</option>
                                <option value="Category">Category</option>
                                <option value="Product">Product</option>
                                <option value="Order">Order</option>
                                <option value="Post">Post</option>
                                <option value="Contact">Contact</option>
                                <option value="Customer">Customer</option>
                                <option value="RoleAndPermission">Role And Permission</option>
                                <option value="SetupAdminUser">Setup Admin User</option>
                                <option value="SiteSetting">Site Setting</option>
                                <option value="SMTPSetting">SMTPSetting</option>
                            </select>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function permissionEdit(id){
    $.ajax({
        type: "get",
        url:  "/permission/edit/" + id,
        dataType: "json",
        success: function(data){
            $('#edit_permission').modal('show'); 
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#group_name').val(data.group_name); 
        }
    })
    }
</script>
@endsection