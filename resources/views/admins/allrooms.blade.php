@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">

                {{-- Alert success --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Alert delete --}}
                @if(session('delete'))
                    <div class="alert alert-success">
                        {{ session('delete') }}
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title mb-0">Rooms</h5>
                    <a href="{{ route('rooms.create') }}" class="btn btn-primary">Create Room</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Max Persons</th>
                                <th>Size</th>
                                <th>View</th>
                                <th>Beds</th>
                                <th>Hotel</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rooms as $room)
                                <tr>
                                    <td>{{ $room->id }}</td>
                                    <td>{{ $room->name }}</td>

                                    {{-- Image --}}
                                    <td>
                                        <img src="{{ asset('assets/images/'.$room->image) }}"
                                            width="60" height="50"
                                            style="object-fit: cover; border-radius: 6px;">
                                    </td>

                                    <td>Rp{{ number_format($room->price, 0, ',', '.') }}</td>
                                    <td>{{ $room->max_persons }}</td>
                                    <td>{{ $room->size }}</td>
                                    <td>{{ $room->view }}</td>
                                    <td>{{ $room->num_beds }}</td>
                                    {{-- Hotel name instead of ID --}}
                                    <td>{{ $room->hotel->name ?? 'Unknown' }}</td>
                                    {{-- Delete --}}
                                    <td>
                                        <a href="{{ route('rooms.delete', $room->id) }}"
                                           class="btn btn-danger btn-sm">
                                           Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted">
                                        No rooms found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
