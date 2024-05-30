@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">     
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active p-1" aria-current="page">Role In Permissions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button onclick="addRoleInPermission()" class="btn btn-outline-primary px-5 radius-30">Add Role In Permission</button>
                
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
                        <tr >
                            <th class="text-center">SL</th>
                            <th class="text-center">ROLES NAME</th>
                            <th class="text-center">PERMISSION NAME</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $item)
                          
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{$item->name}}</td>
                            <td>
                            @foreach ($item->permissions as $permission)
                                <span class="badge bg-primary">{{$permission->name}}</span>
                            @endforeach
                            </td>
                            <td class="p-0">
                                @if (Auth::user()->can('role.permission.action'))
                                <button onclick="roleInPermissionEdit({{$item->id}})" class="btn btn-outline-warning radius-30" title="Edit">
                                    <i class="bx bx-edit"></i>
                                </button>
                                <a href="{{route('role.permission.delete', $item->id)}}" id="delete" class="btn btn-outline-danger radius-30" title="Delete">
                                    <i class="bx bx-trash-alt"></i>
                                </a>
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
 <!-- Modal Add Category -->
 <div class="modal fade" id="roleInPermission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div id="addRolePermission">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="exampleModalLabel">Add Role In Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('role.permission.store')}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row p-2">
                            <div class="col-md-12 p-2">
                                <label for="" class="form-label text-primary">Role Name</label>
                                <select name="role_id" id="" class="form-select" aria-label="Default select example">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 p-2 ">                            
                                <input type="checkbox" class="form-check-label " id="CheckDefaultMain">
                                <label for="CheckDefaultMain" class="form-label text-primary ">Permission All</label>                                                       
                            </div>
                            <hr>
                            <div class="row">              
                                @foreach ($permission_groups as $permission)
                                    <div class="col-lg-6 border d-flex">
                                        <div class="col-md-6 p-2">
                                            <input type="checkbox" class="form-check-label checkboxPerInputAll" data-group-name="{{$permission->group_name}}"
                                                     id="groupName{{$permission->group_name}}">
                                            <label for="groupName{{$permission->group_name}}" class="form-label text-primary">{{$permission->group_name}}</label>
                                        </div>
                                        @php
                                        $permission_group_name = App\Models\User::getPermissionGroupName($permission->group_name);
                                        @endphp
                                        <div class="col-md-6 p-2" >
                                            @foreach ($permission_group_name as $item)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-label flexCheckDefault checkbox{{$permission->group_name}}" 
                                                            data-group-name="{{$permission->group_name}}" name="permission[]" id="flexCheckDefault{{$item->id}}" 
                                                            value="{{$item->id}}">
                                                    <label for="flexCheckDefault{{$item->id}}" class="form-label">{{ $item->name}}</label>
                                                </div>
                                            @endforeach
                                        </div>                                     
                                    </div>                                     
                                @endforeach  
                            </div>    
                        </div>  
                    </div>
                    <hr>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div id="modalEdit"></div>
        </div>
    </div>
</div>


<script>

    function addRoleInPermission(){
        $('#editRolePermission').addClass('d-none');
        $('#addRolePermission').removeClass('d-none');
        $('#roleInPermission').modal('show');
    }

    function roleInPermissionEdit(id){
        $.ajax({
            type: "get",
            url:  "/role-permission/edit/" + id,
            success: function(data){
                $('#addRolePermission').addClass('d-none');
                $('#modalEdit').html(data);
                $('#roleInPermission').modal('show'); 
            }
        })
    }  

    $('#CheckDefaultMain').click(function(){
        if($(this).is(":checked")){
            $('input[type=checkbox]').prop('checked', true);
           
        }else{
            $('input[type=checkbox]').prop('checked', false);
        }
    });

    $(document).ready(function(){
        $('.checkboxPerInputAll').on('change', function(){
            var groupName = $(this).data('group-name');
            var checkBoxInput  = `.checkbox${groupName}`;
            
            if($(this).is(":checked")){
                $(checkBoxInput).prop('checked', true);
            } else{
                $(checkBoxInput).prop('checked', false);
            }
        })

        $('.flexCheckDefault').on('change', function(){
            var groupName = $(this).data('group-name');
            var checkBoxInput  = `.checkbox${groupName}`;
            var sumCheck = 0;
            var check = 0;
            $(checkBoxInput).each(function(){ 
                if($(this).is(":checked")){
                    check += 1;
                }
                sumCheck += 1;
            })
            
            var checkBoxInputAll  = `#groupName${groupName}`;
            if(sumCheck === check){
                $(checkBoxInputAll).prop('checked', true);
            } else{
                $(checkBoxInputAll).prop('checked', false);
            }
        })        
    })
</script>
@endsection