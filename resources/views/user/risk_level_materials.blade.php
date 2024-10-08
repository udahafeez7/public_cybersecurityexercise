@extends('layouts.app')

@section('content')
    <div class="row mb-4 pb-2">
        @foreach ($materials as $material)
            <div class="col-md-6">
                <div class="card offer-card shadow-sm">
                    <div class="card-body">
                        <img src="{{ asset('frontend/img/list/' . $material->image) }}" class="img-fluid w-100"
                            alt="{{ $material->title }}">
                        <h6 class="card-subtitle mt-3 mb-2 text-block">{{ $material->title }}</h6>
                        <a href="{{ route('user.materials') }}" class="card-link">KNOW MORE</a>
                        <a href="#" class="card-link">COPY CODE</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
