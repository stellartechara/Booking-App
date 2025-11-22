@extends('layouts.admin')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Login</h5>
                <form method="POST" action="{{ route('check.login') }}">
                    @csrf
                    <!-- Email input -->
                    <div class="form-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>

                    <!-- Password input -->
                    <div class="form-group mb-4">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <!-- Submit button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
    }

    .btn-primary {
        font-weight: 600;
    }

    @media (max-width: 576px) {
        .col-md-5 {
            width: 90%;
        }
    }
</style>

@endsection
