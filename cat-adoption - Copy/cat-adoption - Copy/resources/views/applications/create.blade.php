@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 py-12 flex justify-center items-start">
    <div class="max-w-5xl w-full bg-white shadow-lg rounded-2xl overflow-hidden flex flex-col md:flex-row">
        <!-- Left: Cat Image -->
        <div class="md:w-1/2 bg-gray-100 flex justify-center items-center p-6">
            <img src="{{ asset('storage/' . $cat->image) }}"
                 alt="{{ $cat->name }}"
                 class="rounded-xl w-full max-w-sm object-cover shadow-md">
        </div>

        <!-- Right: Cat Info + Form -->
        <div class="md:w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-pink-600 mb-4">{{ $cat->name }}</h2>

            <ul class="text-gray-700 space-y-2 mb-6">
                <li><strong>Breed:</strong> {{ $cat->breed }}</li>
                <li><strong>Age:</strong> {{ $cat->age }} {{ Str::contains($cat->age, 'year') ? '' : 'year(s)' }}</li>
            </ul>

            <p class="text-gray-600 mb-6">{{ $cat->description }}</p>

            <!-- Adoption Form -->
            <form action="{{ route('applications.store', $cat->id) }}" method="POST" class="space-y-4">
                @csrf

                <!-- Monthly Salary -->
                <div>
                    <label for="salary" class="block text-gray-700 font-medium mb-1">Monthly Salary (PHP):</label>
                    <input id="salary" name="salary" type="number" required placeholder="Enter your monthly salary"
                           class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-pink-300">
                </div>

                <!-- Adoption Fee -->
                <div>
                    <label for="adoption_fee" class="block text-gray-700 font-medium mb-1">Adoption Fee (PHP 500):</label>
                    <input id="adoption_fee" name="adoption_fee" type="number" required placeholder="Enter PHP 500"
                           class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-pink-300">
                </div>

                <input type="hidden" name="payment_status" value="1">
                <input type="hidden" name="status" value="pending">

                <div class="flex space-x-4">
                    <button type="submit"
                            class="bg-pink-500 text-white px-6 py-2 rounded-full hover:bg-pink-600 transition">
                        Apply for Adoption 💕
                    </button>

                    <a href="{{ route('adopt.index') }}"
                       class="bg-gray-200 text-gray-700 px-6 py-2 rounded-full hover:bg-gray-300 transition">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
