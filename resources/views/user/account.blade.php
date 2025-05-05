@extends('layout.main')

@section('content')

<div class="flex items-center justify-center mt-25 bg-gray-100">
    <div class="bg-white shadow-lg rounded-xl p-6 w-full max-w-md">
        <!-- Profile Section -->
        <div class="flex items-center space-x-4">
          <i class="bi bi-person-circle text-5xl text-gray-500"></i>
          <div>
            <h2 class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
            <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
          </div>
        </div>
    
        <hr class="my-4">
    
        <!-- Account Info -->
        <div class="space-y-2">
          <div class="flex justify-between text-gray-600">
            <span>Username:</span>
            <span>{{ Auth::user()->name }}</span>
          </div>
          <div class="flex justify-between text-gray-600">
            <span>Role:</span>
            <span>{{ Auth::user()->roles }}</span>
          </div>
        </div>
    
        <hr class="my-4">
    
        <!-- Actions -->
        <div class="flex justify-center space-x-2">
            <form action="/logout" method="POST" class="inline">
                @csrf
                <button class="text-white font-semibold p-2 rounded-md px-45 bg-red-500 hover:bg-red-600">Logout</button>
            </form>
        </div>
      </div>
</div>

  @endsection