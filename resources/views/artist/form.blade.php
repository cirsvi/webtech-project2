@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">Please fix the errors!</div>
    @endif

    <form method="post" action="{{ $artist->exists ? '/artists/patch/' . $artist->id : '/artists/put'}}">
        @csrf

        <div class="mb-3">
            <label for="artist-name" class="form-label">Artist name</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="artist-name"
                name="name"
                value="{{ old('name', $artist->name) }}">

            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror

        </div>

        <button type="submit" class="btn btn-primary">Save</button>

    </form>

@endsection
