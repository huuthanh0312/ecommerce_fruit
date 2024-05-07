@extends('admin.admin_dashboard')
@section('admin')

<div class="container-xxl flex-grow-1 container-p-y">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Posts</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('post.all')}}" class="btn btn-outline-primary px-5 radius-30">All Post</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="card">
        <div class="card-header">
            <h3>Update Post</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('post.update')}}" method="post" id="myForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$post->id}}">
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="title" class="form-label text-dark">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}" />
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="title" class="form-label text-dark">Description</label>
                        <textarea name="description" id="content_tindy">{{$post->description}}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection