@extends('admin.layouts.main')

@section('content')
<h1 class="text-2xl font-bold">
    Profile
    <a href="{{ route('users.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Back</a>
</h1>

<div class="w-full max-w-sm mt-3 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
    <div class="flex flex-col items-center px-4 pt-4 pb-4">
        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie image"/>
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</span>
    </div>
</div>
   
@endsection