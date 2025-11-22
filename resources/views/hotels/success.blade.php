@extends('layouts.app')

@section('content')

<div class="hero-wrap js-fullheight" style="margin-top: -25px; background-image: url('{{ asset('assets/images/room-1.jpg') }}'); background-size: cover; background-position: center;">
    <div class="overlay"></div>
    <div class="container py-5">
        <div class="row align-items-center justify-content-start">
            <div class="col-md-7 ftco-animate text-white">
                <h2 class="subheading">You Booked This Room Successfully</h2>
                <h1 class="mb-4"></h1>
                <div class="text-center">
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-4 py-2">Go Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hero-wrap .overlay {
        background: rgba(0,0,0,0.45);
    }

    .hero-wrap h2 {
        font-size: 1.75rem;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .hero-wrap h2 {
            font-size: 1.25rem;
        }
    }
</style>

@endsection
