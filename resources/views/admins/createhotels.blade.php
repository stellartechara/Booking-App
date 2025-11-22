@extends('layouts.admin')

@section('content')

<div class="row mt-4">
    <div class="col-md-8 mx-auto">
        <div class="card shadow-sm border-0 rounded-lg">
            <div class="card-body">

                <h5 class="card-title mb-4">Create Hotels</h5>

                <form method="POST" action="{{ route('hotels.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- NAME --}}
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Hotel Name">
                        @if($errors->has('name'))
                            <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    {{-- IMAGE --}}
                    <div class="mb-3">
                        <input type="file" name="image" class="form-control">
                        @if($errors->has('image'))
                            <div class="alert alert-danger mt-2">{{ $errors->first('image') }}</div>
                        @endif
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Hotel description..."></textarea>
                        @if($errors->has('description'))
                            <div class="alert alert-danger mt-2">{{ $errors->first('description') }}</div>
                        @endif
                    </div>

                    {{-- LOCATION --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="Location">
                        @if($errors->has('location'))
                            <div class="alert alert-danger mt-2">{{ $errors->first('location') }}</div>
                        @endif
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit" class="btn btn-primary mt-3 px-4">
                        Create
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
