@extends('dashboard/layouts/main')

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <div class="text-center m-3 border p-3">
                    @if ($user->image)
                        <img src="{{ asset('img/user-images/' . $user->image) }}" class="img-thumbnail" style="
                        width: 200px;
                        height: 200px;
                        object-fit: cover;
                        border: 6px solid rgba(255, 255, 255, 0.15);
                        margin: 0 auto;">
                    @else
                        <img src="{{ asset('img/user-images/' . $image) }}" class="img-thumbnail" style="
                        width: 200px;
                        height: 200px;
                        object-fit: cover;
                        border: 6px solid rgba(255, 255, 255, 0.15);
                        margin: 0 auto;">
                    @endif
                    <h5 class="mt-3">{{ $user->name }}</h5>
                    <h6 class="text-muted">{{ $user->email }} ({{ $user->username }})</h6>
                    <p class="text-muted">{{ $user->phone }}</p>
                    <p class="text-muted">{{ $user->address }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection