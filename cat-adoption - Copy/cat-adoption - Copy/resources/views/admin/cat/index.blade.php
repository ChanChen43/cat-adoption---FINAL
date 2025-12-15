@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 py-12">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-10 text-center">🐾 Manage Cats</h1>

        <div class="bg-white rounded-3xl shadow-2xl p-6 border border-pink-200">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-2xl font-semibold text-gray-700">Cat List</h2>
                <a href="{{ route('admin.cats.create') }}"
                   class="bg-pink-500 text-white px-5 py-2 rounded-2xl font-semibold hover:bg-pink-600 transition transform hover:-translate-y-0.5 shadow-md">
                   ➕ Add New Cat
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-200 rounded-xl overflow-hidden">
                    <thead class="bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 text-white">
                        <tr>
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">Breed</th>
                            <th class="p-3 text-left">Age</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cats as $cat)
                            <tr class="border-b hover:bg-pink-50 transition">
                                <td class="p-3 font-medium text-gray-800">{{ $cat->name }}</td>
                                <td class="p-3 text-gray-700">{{ $cat->breed }}</td>
                                <td class="p-3 text-gray-700">{{ $cat->age }}</td>
                                <td class="p-3">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        {{ $cat->available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $cat->available ? 'Available' : 'Adopted' }}
                                    </span>
                                </td>
                                <td class="p-3 text-center">
                                    <a href="{{ route('admin.cats.edit', $cat->id) }}"
                                       class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition">
                                       ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.cats.destroy', $cat->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition"
                                                onclick="return confirm('Are you sure you want to delete this cat?');">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-3 text-center text-gray-500">No cats found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert Notification -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('adopted_cat'))
<script>
Swal.fire({
    title: '💖 Adopted!',
    text: "{{ session('adopted_cat') }} has found a loving home!",
    icon: 'success',
    confirmButtonText: 'Aww 🥰'
});
</script>
@endif
@endsection
