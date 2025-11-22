@extends('layouts.admin')

@section('content')

<div class="row mt-4">
    <div class="col">
        <div class="card shadow-sm border-0 rounded-lg">
            <div class="card-body">

                {{-- ALERT SECTION --}}
                <div class="mb-3">
                    @foreach (['success', 'update', 'delete'] as $msg)
                        @if(session()->has($msg))
                            <div class="alert alert-success">
                                {{ session()->get($msg) }}
                            </div>
                        @endif
                    @endforeach
                </div>

                {{-- HEADER --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Hotels</h5>
                    <a href="{{ route('hotels.create') }}" class="btn btn-primary">
                        Create Hotel
                    </a>
                </div>

                {{-- TABLE --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th class="text-center">Update</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($hotels as $hotel)
                            <tr>
                                <th scope="row">{{ $hotel->id }}</th>
                                <td>{{ $hotel->name }}</td>
                                <td>{{ $hotel->location }}</td>
                                <td>{{ $hotel->description }}</td>

                                <td class="text-center">
                                    <a href="{{ route('hotels.edit', $hotel->id) }}" 
                                       class="btn btn-warning btn-sm text-white px-3">
                                        Update
                                    </a>
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('hotels.delete', $hotel->id) }}" 
                                       class="btn btn-danger btn-sm px-3">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
