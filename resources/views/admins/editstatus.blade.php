@extends('layouts.admin')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title mb-4">Update Status</h5>

                <p>Current Status: <b>{{ $booking->status }}</b></p>

                <form method="POST" action="{{ route('bookings.update.status', $booking->id) }}">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="status">Choose new status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">-- Select Status --</option>
                            <option value="Processing" {{ $booking->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                            <option value="Booked successfully" {{ $booking->status == 'Booked successfully' ? 'selected' : '' }}>Booked successfully</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
    }
    @media (max-width: 768px) {
        .card-body {
            padding: 20px 15px;
        }
    }
</style>

@endsection
