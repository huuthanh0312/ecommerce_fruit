@php
$posts = App\Models\Post::latest()->limit(4)->get();
@endphp


<div class="container-fluid service py-5">
    <div class="text-center mx-auto mb-5" style="max-width: 800px;">
        <h1 class="display-4">Chính Sách Công Ty</h1>
    </div>
    <div class="container">
        <div class="bg-light p-5 rounded">
            <div class="row g-4 justify-content-center">
                @foreach ($posts as $item)
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter bg-white rounded p-5">
                        <i class="fa fa-users text-secondary"></i>
                        
                        <a href="{{ route('policy', $item->title_slug)}}">
                            <h4>{{$item->title}}</h4>
                        </a> 
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>