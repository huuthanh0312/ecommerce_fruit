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
                    <input type="checkbox" class="form-check-label " id="CheckDefaultMainEdit">
                    <label for="CheckDefaultMainEdit" class="form-label text-primary ">Permission All</label>                                                       
                </div>
                <hr>
                <div class="row">              
                    @foreach ($permission_groups as $permission)
                        <div class="col-lg-6 border d-flex">
                            @php
                                $permission_group_name = App\Models\User::getPermissionGroupName($permission->group_name);
                            @endphp
                            <div class="col-md-6 p-2">
                                <input type="checkbox" class="form-check-label checkboxPerInputAllEdit" data-group-edit="{{$permission->group_name}}" id="groupNameEdit{{$permission->group_name}}" 
                                    {{ App\Models\User::roleHasPermissions($role, $permission_group_name) ? 'checked' : '' }}>
                                <label for="groupNameEdit{{$permission->group_name}}" class="form-label text-primary">{{$permission->group_name}}</label>
                            </div>
                           
                            <div class="col-md-6 p-2" >
                                @foreach ($permission_group_name as $item)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-label flexCheckDefaultEdit checkboxEdit{{$permission->group_name}}" name="permission[]"
                                                 id="flexCheckDefaultEdit{{$item->id}}" value="{{ $item->id}}" data-group-edit="{{$permission->group_name}}"
                                                  {{$role->hasPermissionTo($item->name) ? 'checked' : ''}}>
                                        <label for="flexCheckDefaultEdit{{$item->id}}" class="form-label">{{ $item->name}}</label>
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

<script>
    $(document).ready(function(){
        $('#CheckDefaultMainEdit').click(function(){
        if($(this).is(":checked")){
            $('input[type=checkbox]').prop('checked', true);
            }else{
                $('input[type=checkbox]').prop('checked', false);
            }
        });
        $('.checkboxPerInputAllEdit').on('change', function(){
            var groupName = $(this).data('group-edit');
            var checkBoxInput  = `.checkboxEdit${groupName}`;
            
            if($(this).is(":checked")){
                $(checkBoxInput).prop('checked', true);
            } else{
                $(checkBoxInput).prop('checked', false);
            }
            //check all 
            var sumCheckAll = 0;
            var checkAll = 0;
            $('.checkboxPerInputAllEdit').each(function(){ 
                if($(this).is(":checked")){
                    checkAll += 1;
                }
                sumCheckAll += 1;
            })
            if(sumCheckAll  === checkAll){
                $("#CheckDefaultMain").prop('checked', true);
            } else{
                $("#CheckDefaultMain").prop('checked', false);
            }
        })

        $('.flexCheckDefaultEdit').on('change', function(){
            var groupName = $(this).data('group-edit');
            var checkBoxInput  = `.checkboxEdit${groupName}`;
            var sumCheck = 0;
            var check = 0;
            $(checkBoxInput).each(function(){ 
                if($(this).is(":checked")){
                    check += 1;
                }
                sumCheck += 1;
            })
            
            var checkBoxInputAll  = `#groupNameEdit${groupName}`;
            if(sumCheck === check){
                $(checkBoxInputAll).prop('checked', true);
            } else{
                $(checkBoxInputAll).prop('checked', false);
            }
            //check all 
            var sumCheckAll = 0;
            var checkAll = 0;
            $('.checkboxPerInputAllEdit').each(function(){ 
                if($(this).is(":checked")){
                    checkAll += 1;
                }
                sumCheckAll += 1;
            })
            if(sumCheckAll  === checkAll){
                $("#CheckDefaultMainEdit").prop('checked', true);
            } else{
                $("#CheckDefaultMainEdit").prop('checked', false);
            }
        })        
    })
</script>