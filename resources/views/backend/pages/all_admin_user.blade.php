@extends('admin.admin_dashboard')
@section('admin')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">     
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active p-1" aria-current="page">Admin User Setup</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    
                    <button data-bs-toggle="modal" data-bs-target="#add_admin_user" class="btn btn-outline-primary px-5 radius-30">Add Admin User</button>
                    
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
                                <th>IMAGE</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>PHONE</th>
                                <th>ROLE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allAdmin as $key => $item)
                              
                            <tr>
                                <td><img class="rounded-circle p-1 bg-primary" src="{{ (!empty($item->photo)) ? url($item->photo) 
                                    : url('upload/no_image.jpg')}}" width="50"></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone}}</td>
                                <td> 
                                @foreach ($item->roles as $role)
                                    <span class="badge bg-primary">{{$role->name}}</span>
                                @endforeach
                               
                                </td>
                                <td>
                                    {{-- @if (Auth::user()->can('testimonial.delete'))
    
                                    @endif
                                    @if (Auth::user()->can('testimonial.delete'))
                                    
                                    @endif --}}
                                    <button onclick="adminUserEdit({{$item->id}})" class="btn btn-outline-warning radius-30" title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <a href="{{ route('admin.user.delete', $item->id)}}" id="delete" class="btn btn-outline-danger radius-30" title="Delete">
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
</div>
 <!-- Modal Add Admin User -->
<div class="modal fade" id="add_admin_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Admin User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3 p-4">
                        <div class="col-md-6 p-1">
                            <label for="name" class="form-label text-primary">Admin User Name</label>
                            <input type="text" name="name" class="form-control" required/>
                            
                        </div>
                        <div class="col-md-6 p-1">
                            <label for="email" class="form-label text-primary">Admin User Email</label>
                            <input type="email" name="email" class="form-control" required/>
                            
                        </div>
                        <div class="col-md-6 p-1">
                            <label for="phone" class="form-label text-primary">Admin User Phone</label>
                            <input type="text" name="phone" class="form-control" required/>
                            
                        </div>
                        <div class="col-md-6 p-1">
                            <label for="address" class="form-label text-primary">Admin User Address</label>
                            <input type="text" name="address" class="form-control" required/>
                            
                        </div>
                        <div class="col-md-6 p-1">
                            <label for="password" class="form-label text-primary">Admin User Password</label>
                            <input type="password" name="password" class="form-control" required/>
                            
                        </div>
                        <div class="col-md-6 p-1">
                            <label for="check_in" class="form-label text-primary">Admin User Role</label>
                            <select name="roles" class="form-select"  required>
                                <option value="">Choose Role Name</option>
                                @foreach ($roles as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

 <!-- Modal Add Admin User -->
 <div class="modal fade" id="edit_admin_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Admin User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.user.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row mb-3 p-4">
                        <div class="col-md-6 p-1">
                            <label for="name" class="form-label text-primary">Admin User Name</label>
                            <input type="text" name="name" id="name" class="form-control" required/>
                            
                        </div>
                        <div class="col-md-6 p-1">
                            <label for="email" class="form-label text-primary">Admin User Email</label>
                            <input type="email" name="email" id="email" class="form-control" required/>
                            
                        </div>
                        <div class="col-md-6 p-1">
                            <label for="phone" class="form-label text-primary">Admin User Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" required/>
                            
                        </div>
                        <div class="col-md-6 p-1">
                            <label for="address" class="form-label text-primary">Admin User Address</label>
                            <input type="text" name="address" id="address" class="form-control" required/>
                            
                        </div>
                        <div class="col-md-6 p-1">
                            <label for="check_in" class="form-label text-primary">Admin User Role</label>
                            <select name="roles" class="form-select" id="roles" required>
                                <option value="">Choose Role Name</option>
                                @foreach ($roles as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function adminUserEdit(id){
    $.ajax({
        type: "get",
        url:  "/admin-setup-user/edit/" + id,
        dataType: "json",
        success: function(data){
            console.log(data);
            $('#edit_admin_user').modal('show'); 
            $('#id').val(data.user.id);
            $('#name').val(data.user.name);
            $('#email').val(data.user.email);
            $('#phone').val(data.user.phone);
            $('#address').val(data.user.address);
            $('#roles').val(data.roleAdmin); 
        }
    })
    }
</script>
@endsection