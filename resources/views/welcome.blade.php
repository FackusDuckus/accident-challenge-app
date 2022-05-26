@extends('layouts.app')

@section('content')
    <div class="absolute top-0 left-0 ml-4 mt-4">
        <div>
            <a href="{{ backpack_url('/') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Admin Portal</a>
        </div>
        @auth
            <div class='font-bold text-gray-600 pl-20'>Welcome {{Auth::user()->name}} !</div>
        @endauth
    </div>
    <div class="absolute top-0 right-0 mt-4 mr-4">
        @if (Route::has('login'))
            <div class="space-x-4">
                @auth
                    <a
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                    >
                        Log out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    @auth
    <div class='flex flex-row justify-center min-h-screen  py-12 bg-gray-50 sm:px-6 lg:px-8 border-2'>
    
    
        <div class='flex flex-col align-left m-4 border-2 min-w-[700px] min-h-[600px] datamap-holder' id='container'>
        </div>
        @livewire('covid-map')
    </div>
    @else
        <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">


                <div class="flex items-center justify-center">
                    <div class="flex flex-col justify-around">
                        <div class="space-y-6">
                            <a href="{{ route('home') }}">
                                <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
                            </a>

                            <h1 class="text-5xl font-extrabold tracking-wider text-center text-gray-600">
                                Covid Mapper
                            </h1>
                            <h2 class="font-bold text-center text-gray-600">
                                Please login to launch application.
                            </h2>

                        </br>
                            <h3 class="font-bold text-center text-gray-600">
                                By Mark deGroat, using:
                            </h3>
                            <ul class="list-reset">
                                <li class="inline px-4">
                                    <a href="https://tailwindcss.com" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Tailwind CSS</a>
                                </li>
                                <li class="inline px-4">
                                    <a href="https://github.com/alpinejs/alpine" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Alpine.js</a>
                                </li>
                                <li class="inline px-4">
                                    <a href="https://laravel.com" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Laravel</a>
                                </li>
                                <li class="inline px-4">
                                    <a href="https://laravel-livewire.com" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Livewire</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

        </div>
    @endauth
@endsection
