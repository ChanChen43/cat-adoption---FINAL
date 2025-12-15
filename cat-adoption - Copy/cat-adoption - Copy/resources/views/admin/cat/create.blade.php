@extends('layouts.admin')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12" style="background: linear-gradient(to bottom right, #ffe4e6, #fff0f5);">
    <div class="w-full max-w-xl bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">🐾 Add a New Furry Friend</h1>

        <form action="{{ isset($cat) ? route('admin.cats.update', $cat->id) : route('admin.cats.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @if(isset($cat))
                @method('PUT')
            @endif
            <div>
                <label class="block font-medium text-gray-700 mb-1">Cat Name 🐱</label>
                <input type="text" name="name" value="{{ old('name', $cat->name ?? '') }}" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-pink-200 focus:outline-none" placeholder="Enter the cat's name" required>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Age 🎂</label>
                    <input type="number" name="age" value="{{ old('age', $cat->age ?? '') }}" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-pink-200 focus:outline-none" required>
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Breed 🐾</label>
                    <input type="text" name="breed" value="{{ old('breed', $cat->breed ?? '') }}" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-pink-200 focus:outline-none" required>
                </div>
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-1">Description 📝</label>
                <textarea name="description" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-pink-200 focus:outline-none" placeholder="Write a short description...">{{ old('description', $cat->description ?? '') }}</textarea>
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-1">Image 🖼️</label>
                <input type="file" name="image" class="w-full">
                @if(isset($cat) && $cat->image)
                    <p class="mt-2 text-sm text-gray-500">Current Image: <a href="{{ asset('storage/' . $cat->image) }}" target="_blank" class="text-blue-500 underline">View</a></p>
                @endif
            </div>
            <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 w-full">
                {{ isset($cat) ? 'Update Cat' : 'Add Cat' }}
            </button>
        </form>
    </div>
</div>
@endsection
