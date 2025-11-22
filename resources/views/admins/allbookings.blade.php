@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card shadow-lg">
            <div class="card-body">

                {{-- Alerts --}}
                @foreach (['update', 'delete'] as $msg)
                    @if(session()->has($msg))
                        <div class="alert alert-success">
                            {{ session()->get($msg) }}
                        </div>
                    @endif
                @endforeach

                <h5 class="card-title mb-4 d-inline">Bookings</h5>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                {{--<th>Email</th>--}}
                                <th>Check In</th>
                                <th>Check Out</th>
                                {{--<th>Phone</th>--}}
                                <th>Hotel</th>
                                <th>Room</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Change Status</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <th scope="row">{{ $booking->id }}</th>
                                    <td>{{ $booking->name }}</td>
                                    {{--<td>{{ $booking->email }}</td>--}}
                                    <td>{{ $booking->check_in }}</td>
                                    <td>{{ $booking->check_out }}</td>
                                    {{--<td>{{ $booking->phone_number }}</td>--}}
                                    <td>{{ $booking->hotel_name }}</td>
                                    <td>{{ $booking->room_name }}</td>
                                    <td>{{ $booking->status }}</td>
                                    <td>Rp{{ number_format($booking->price, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('bookings.edit.status', $booking->id) }}" 
                                           class="btn btn-warning btn-sm text-center">Change Status</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('bookings.delete', $booking->id) }}" 
                                           class="btn btn-danger btn-sm text-center">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> {{-- /.table-responsive --}}

            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
    }

    table th, table td {
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 20px 10px;
        }
    }
</style>

@endsection
