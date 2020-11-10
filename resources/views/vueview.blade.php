@extends('layouts.frontend_app')

@section('content')
<div id="app">

	<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link to="/login" class="nav-link">{{ __('Login') }}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/register" class="nav-link">{{ __('Register') }}</router-link>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    
                </ul>
            </div>
        </div>
    </nav>

	{{-- The way that Vue Router works is that it maps a route to a Vue component and then renders it within this tag in the application--}}
	<router-view></router-view>
</div>
@endsection

@once
    @push('scripts')
        <!-- Vue Instance -->
        <script src="{{ mix('/js/app.js')}}"></script>
    @endpush
@endonce