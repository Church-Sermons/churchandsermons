@section('title', 'Page Not Found')

@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex flex-column justify-content-center align-items-center pt-5 w-100 h-100 text-center">
            <h3 class="text-center display-1 text-primary">404!</h3>
            <h3 class="font-weight-bold">Oops!Page Not Found</h3>
            <p class="lead">The page you are looking for is not available or has been moved</p>
            <a href="{{ route('home') }}" class="btn btn-lg btn-primary shadow-sm">Back To Home</a>
        </div>
    </div>
@endsection
