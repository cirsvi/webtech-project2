@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">Please fix the errors!</div>
    @endif

    <form method="post"
          action="{{ $location->exists ? '/locations/patch/' . $location->id : '/locations/put' }}">
        @csrf

        <div class="mb-3">
            <label for="location-name" class="form-label">Location name</label>

            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="location-name"
                name="name"
                value="{{ old('name', $location->name) }}">

            @error('name')
            <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror

        </div>

        <button type="submit" class="btn btn-primary">Save</button>

    </form>
@endsection
