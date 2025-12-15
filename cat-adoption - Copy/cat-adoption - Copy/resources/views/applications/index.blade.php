@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-200 via-purple-200 to-blue-200 py-12">
    <div class="max-w-6xl mx-auto px-6">
        <h1 class="text-4xl font-bold text-gray-800 text-center mb-10">📋 My Adoption Applications</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6 text-center shadow-md">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6 text-center shadow-md">
                {{ session('error') }}
            </div>
        @endif

        @if(session('status_message'))
            <div class="bg-blue-100 text-blue-800 p-4 rounded-lg mb-6 text-center shadow-md">
                {{ session('status_message') }}
            </div>
        @endif

        @if($applications->isEmpty())
            <p class="text-center text-gray-700">You haven't applied for any cats yet. 🐾</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($applications as $application)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">
                        <div class="w-full h-60 overflow-hidden border-b-4 border-pink-300">
                            <img src="{{ asset('storage/' .$application->cat->image) }}"
                                 alt="{{ $application->cat->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 text-center">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $application->cat->name }}</h2>
                            <p class="text-gray-500">{{ $application->cat->breed }} • {{ $application->cat->age }} {{ $application->cat->age_unit ?? '' }}</p>
                            <p class="mt-3 text-gray-600">Salary: <span class="font-semibold">PHP {{ number_format($application->salary, 2) }}</span></p>
                            <p class="mt-1 text-gray-600">Payment Status:
                                <span class="font-semibold {{ $application->payment_status ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $application->payment_status ? 'Paid' : 'Not Paid' }}
                                </span>
                            </p>
                            <p class="mt-3 text-gray-600">Status:
                                <span class="@if($application->status == 'approved') text-green-600
                                             @elseif($application->status == 'rejected') text-red-600
                                             @else text-yellow-600 @endif font-semibold">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
