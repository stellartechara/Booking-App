@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="hero-wrap js-fullheight" style="margin-top: -25px; background-image: url('{{ asset('assets/images/room-1.jpg') }}'); background-size: cover; background-position: center;">
    <div class="overlay"></div>
    <div class="container py-5">
        <div class="row align-items-center justify-content-start">
            <div class="col-md-7 ftco-animate pt-5 mt-5">
                <h2 class="subheading text-white">My Bookings</h2>
                <h1 class="mb-4 text-white">Daftar Reservasi Anda</h1>
                <p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Go Home</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Booking Table Section -->
<section class="ftco-section bg-light py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h3 class="mb-3">Detail Reservasi</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive shadow rounded bg-white">
                    <table class="table table-hover mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Check In</th>
                                <th scope="col">Check Out</th>
                                <th scope="col">Days</th>
                                <th scope="col">Price</th>
                                <th scope="col">Room Name</th>
                                <th scope="col">Hotel Name</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <th scope="row">{{ $booking->name }}</th>
                                <td>{{ $booking->email }}</td>
                                <td>{{ $booking->phone_number }}</td>
                                <td>{{ $booking->check_in }}</td>
                                <td>{{ $booking->check_out }}</td>
                                <td>{{ $booking->days }}</td>
                                <td>{{ $booking->price }}</td>
                                <td>{{ $booking->room_name }}</td>
                                <td>{{ $booking->hotel_name }}</td>
                                <td>{{ $booking->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Scroll horizontal untuk mobile */
    .table-responsive {
        overflow-x: auto;
    }
    .table th, .table td {
        white-space: nowrap;
    }

    /* Section spacing */
    .ftco-section {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    /* Shadow & border radius untuk tabel */
    .table-responsive {
        border-radius: 0.5rem;
    }

    /* Heading lebih menonjol */
    h3 {
        font-weight: 600;
        color: #343a40;
    }
</style>

@endsection
