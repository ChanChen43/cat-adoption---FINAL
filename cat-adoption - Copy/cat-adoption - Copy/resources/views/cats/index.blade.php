@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-200 via-purple-200 to-blue-200 py-12">
    <div class="container py-4">
        <h2 class="text-center mb-4 text-gray-800 font-extrabold text-3xl">Meet Our Cats 🐾</h2>

        <div class="row g-4">
            @forelse($cats as $cat)
                <div class="col-md-4">
                    <div class="card border-0 shadow-lg rounded-4 h-100">
                        <img src="{{ asset('storage/' . $cat->image) }}" 
                             class="card-img-top rounded-top-4 border-4 border-pink-200" 
                             alt="{{ $cat->name }}" 
                             style="height:250px; object-fit:cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $cat->name }}</h5>
                            <p class="text-muted">{{ $cat->breed ?? 'Unknown Breed' }}</p>
                            <a href="{{ route('cats.show', $cat->id) }}" 
                               class="btn btn-outline-primary w-100 rounded-pill">
                               View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-700">No cats available right now 🐱</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
