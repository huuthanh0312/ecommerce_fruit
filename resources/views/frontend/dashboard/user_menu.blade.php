
@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp


<div class="card mb-4">
    <div class="card-body text-center">
        <img src="{{(!empty($profileData->photo)) ? url($profileData->photo) : url('upload/no_image.jpg')}}"
            alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
        <h5 class="my-3">{{$profileData->name}}</h5>
        <p class="text-muted">{{$profileData->phone}}</p>
        <p class="text-muted">{{$profileData->address}}</p>
        
    </div>
</div>
<div class="card mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush rounded-3 center" >
            <li class="list-group-item d-flex  align-items-center p-3">
                
                <a href="{{route('dashboard')}}"><i class="fab fa-github fa-lg text-warning"></i> User Dashboard</a>
            </li>
            <li class="list-group-item d-flex align-items-center p-3">
                
                <a href=""> <i class="fab fa-first-order fa-lg"></i>Order Details </a>
            </li>
            <li class="list-group-item d-flex align-items-center p-3">
                
                <a href="{{route('user.profile')}}"><i class="fa fa-user fa-lg "></i> User Profile </a>
            </li>
            <li class="list-group-item d-flex align-items-center p-3">
                
                <a href="{{route('user.change.password')}}"><i class="fa fa-key fa-lg "></i> Change Password</a>
            </li>                           
            <li class="list-group-item d-flex align-items-center p-3">
                
                <a href="{{route('user.logout')}}" class="text-danger"><i class="fas fa-map-marker-alt fa-lg" ></i> Logout </a>
            </li>
        </ul>
    </div>
</div>