@extends('layouts.admin')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Create Rooms</h5>

                <form method="POST" action="{{ route('rooms.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="name" class="form-control" placeholder="Room name" value="{{ old('name') }}">
                        @error('name')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="file" name="image" class="form-control" accept="image/*">
                        @error('image')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="price" class="form-control" placeholder="Price" value="{{ old('price') }}">
                        @error('price')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="max_persons" class="form-control" placeholder="Max Persons" value="{{ old('max_persons') }}">
                        @error('max_persons')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="num_beds" class="form-control" placeholder="Number of Beds" value="{{ old('num_beds') }}">
                        @error('num_beds')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="size" class="form-control" placeholder="Size" value="{{ old('size') }}">
                        @error('size')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="view" class="form-control" placeholder="View" value="{{ old('view') }}">
                        @error('view')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <select name="hotel_id" class="form-control">
                            <option value="">Choose Hotel</option>
                            @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                    {{ $hotel->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('hotel_id')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mb-4 text-center">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Biar responsive dan card rapi di desktop & mobile */
    .card {
        border-radius: 12px;
    }

    .form-control {
        border-radius: 8px;
    }

    button.btn-block {
        width: 100%;
        padding: 12px;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 20px 15px;
        }
    }
</style>

@endsection
