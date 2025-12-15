@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 py-12">
    <div class="max-w-6xl mx-auto px-6">
        <h1 class="text-4xl font-bold text-gray-800 text-center mb-10">🐾 Meet Our Adorable Cats</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($cats as $cat)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                    <!-- Cat Image -->
                    <div class="flex-shrink-0">
                        <img src="{{ asset(
                            Str::startsWith($cat->image, 'cats/')
                                ? 'storage/'.$cat->image     {{-- new uploads in storage --}}
                                : $cat->image                {{-- old images in public/images/cats --}}
                        ) }}" alt="{{ $cat->name }}" class="w-full h-56 object-cover border-b-4 border-pink-300">
                    </div>

                    <!-- Cat Info -->
                    <div class="p-6 text-center flex flex-col justify-between flex-1">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $cat->name }}</h2>
                            <p class="text-gray-500">{{ $cat->breed }} • {{ $cat->age }} {{ $cat->age_unit ?? '' }}</p>
                            <p class="mt-3 text-gray-600">{{ Str::limit($cat->description, 60) }}</p>
                        </div>

                        <a href="{{ route('cats.show', $cat->id) }}"
                           class="inline-block mt-4 px-5 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600 transition">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
