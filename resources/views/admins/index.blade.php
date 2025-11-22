@extends('layouts.admin')

@section('content')

<div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-lg border-0 rounded-lg h-100 hover-shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Hotels</h5>
                <p class="card-text display-6">{{ $hotelsCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-lg border-0 rounded-lg h-100 hover-shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Rooms</h5>
                <p class="card-text display-6">{{ $roomsCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-lg border-0 rounded-lg h-100 hover-shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Admins</h5>
                <p class="card-text display-6">{{ $adminsCount }}</p>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important;
    }
</style>

@endsection
