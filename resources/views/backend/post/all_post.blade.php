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
                    <li class="breadcrumb-item active" aria-current="page">Posts</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('post.add')}}" class="btn btn-outline-primary px-5 radius-30">Add Post</a>
            </div>
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
                            <th class="text-center">Title</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $key => $item)

                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{$item->title}}</td>
                            <td>{{Str::limit($item->description, 25)}}</td>d
                            <td>
                                @if (Auth::user()->can('post.action'))
                                <a href="{{route('post.edit', $item->id)}}" class="btn btn-outline-warning radius-30" title="Edit">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <a href="{{route('post.delete', $item->id)}}" id="delete" class="btn btn-outline-danger radius-30" title="Delete">
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
@endsection