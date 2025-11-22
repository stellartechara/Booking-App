@extends('layouts.admin')

@section('content')

<div class="row mt-4">
    <div class="col">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-body">

                {{-- Alert Success --}}
                @if(session()->has('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title m-0">Admins</h5>
                    <a href="{{ route('admins.create') }}" class="btn btn-primary">
                        + Create Admin
                    </a>
                </div>

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle bg-white rounded">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($admins as $admin)
                            <tr>
                                <th scope="row">{{ $admin->id }}</th>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Extra Style --}}
<style>
    table tbody tr:hover {
        background-color: #f7f7f7;
        transition: 0.2s ease-in-out;
    }
</style>

@endsection
