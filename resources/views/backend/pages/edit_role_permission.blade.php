<div id="editRolePermission">
    <div class="modal-header border-bottom">
        <h5 class="modal-title" id="exampleModalLabel">Update Role In Permission</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{route('role.permission.update', $role->id)}}" method="post" id="myForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row p-2">
                <div class="col-md-12 p-2">
                    
                    <h3>Role Name : {{$role->name}}</h3>
                </div>
                <div class="col-md-12 p-2 ">                            
                    <input type="checkbox" class="form-check-label " id="CheckDefaultMain">
                    <label for="CheckDefaultMain" class="form-label text-primary ">Permission All</label>                                                       
                </div>
                <hr>
                <div class="row">              
                    @foreach ($permission_groups as $permission)
                        <div class="col-lg-6 border d-flex">
                            @php
                                $permission_group_name = App\Models\User::getPermissionGroupName($permission->group_name);
                            @endphp
                            <div class="col-md-6 p-2">
                                <input type="checkbox" class="form-check-label" id="flexCheckDefault" 
                                    {{ App\Models\User::roleHasPermissions($role, $permission_group_name) ? 'checked' : '' }}>
                                <label for="flexCheckDefault" class="form-label text-primary">{{$permission->group_name}}</label>
                            </div>
                           
                            <div class="col-md-6 p-2" >
                                @foreach ($permission_group_name as $item)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-label" name="permission[]" id="flexCheckDefault{{$item->id}}" 
                                                value="{{ $item->id}}" {{$role->hasPermissionTo($item->name) ? 'checked' : ''}}>
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
