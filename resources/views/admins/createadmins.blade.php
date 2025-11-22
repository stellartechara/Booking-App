@extends('layouts.admin')

@section('content')

<div class="row d-flex justify-content-center mt-5">
    <div class="col-md-6">

        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-body">

                <h5 class="card-title mb-4">Create Admins</h5>

                <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            placeholder="Email">
                    </div>

                    <!-- Name -->
                    <div class="form-group mb-3">
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control" 
                            placeholder="Name">
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-4">
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control" 
                            placeholder="Password">
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary w-100">
                        Create
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

<style>
    .card {
        padding: 25px;
    }
</style>

@endsection
