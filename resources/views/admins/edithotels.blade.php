@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Update Hotel</h5>

                <form method="POST" action="{{ route('hotels.update', $hotel->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-outline mb-4 mt-4">
                        <input type="text" 
                               name="name" 
                               value="{{ old('name', $hotel->name) }}" 
                               class="form-control" 
                               placeholder="Hotel Name">
                    </div>
                    @error('name')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror


                    <div class="form-group mb-4">
                        <label>Description</label>
                        <textarea class="form-control" 
                                  name="description" 
                                  rows="3">{{ old('description', $hotel->description) }}</textarea>
                    </div>
                    @error('description')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror


                    <div class="form-outline mb-4">
                        <label>Location</label>
                        <input type="text" 
                               name="location" 
                               value="{{ old('location', $hotel->location) }}" 
                               class="form-control" 
                               placeholder="Location">
                    </div>
                    @error('location')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="btn btn-primary mb-4">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
