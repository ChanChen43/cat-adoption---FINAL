@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 py-12">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-10 text-center">📋 Manage Applications</h1>

        <div class="bg-white rounded-3xl shadow-2xl p-6 border border-pink-200">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-200 rounded-xl overflow-hidden">
                    <thead class="bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 text-white">
                        <tr>
                            <th class="p-3 text-left">Cat</th>
                            <th class="p-3 text-left">Applicant</th>
                            <th class="p-3 text-left">Salary</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $app)
                            <tr class="border-b hover:bg-pink-50 transition">
                                <td class="p-3 font-medium text-gray-800">{{ $app->cat->name }}</td>
                                <td class="p-3 text-gray-700">
                                    <div>{{ $app->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $app->user->email }}</div>
                                </td>
                                <td class="p-3 text-gray-700">PHP {{ number_format($app->salary, 2) }}</td>
                                <td class="p-3">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        {{ $app->status === 'approved' ? 'bg-green-100 text-green-700' : ($app->status === 'declined' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                        {{ ucfirst($app->status) }}
                                    </span>
                                </td>
                                <td class="p-3 text-center">
                                    <form method="POST" action="{{ route('admin.applications.updateStatus', $app->id) }}" class="inline-block">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" name="status" value="approved" class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition">Approve</button>
                                        <button type="submit" name="status" value="declined" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition">Decline</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-3 text-center text-gray-500">No applications found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
