@extends('layout')

@section('content')

<h1>{{ $title }}</h1>

@if ($errors->any())
    <div class="alert alert-danger">Please fix the validation errors!</div>
@endif

<form
    method="post"
    action="{{ $painting->exists ? '/paintings/patch/' . $painting->id : '/paintings/put' }}">
    @csrf

    <div class="mb-3">
        <label for="painting-title" class="form-label">Title</label>

        <input
            type="text"
            id="painting-title"
            name="title"
            value="{{ old('title', $painting->title) }}"
            class="form-control @error('title') is-invalid @enderror"
        >

        @error('title')
            <p class="invalid-feedback">{{ $errors->first('title') }}</p>
        @enderror
        </div>

        <div class="mb-3">
            <label for="painting-artist" class="form-label">Artist</label>

            <select
                id="painting-artist"
                name="artist_id"
                class="form-select @error('artist_id') is-invalid @enderror"
            >
                <option value="">Choose the artist!</option>
                @foreach($artists as $artist)
                    <option
                        value="{{ $artist->id }}"
                        @if ($artist->id == old('artist_id', $painting->artist->id ?? false)) selected @endif
                    >{{ $artist->name }}</option>
                @endforeach
            </select>

            @error('artist_id')
            <p class="invalid-feedback">{{ $errors->first('artist_id') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="painting-description" class="form-label">Description</label>

            <textarea
                id="painting-description"
                name="description"
                class="form-control @error('description') is-invalid @enderror"
            >{{ old('description', $painting->description) }}</textarea>

            @error('description')
            <p class="invalid-feedback">{{ $errors->first('description') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="painting-year" class="form-label">Year</label>

            <input
                type="number" max="{{ date('Y') + 1 }}" step="1"
                id="painting-year"
                name="year"
                value="{{ old('year', $painting->year) }}"
                class="form-control @error('year') is-invalid @enderror"
            >

            @error('year')
            <p class="invalid-feedback">{{ $errors->first('year') }}</p>
            @enderror

        </div>

        // image
        <div class="mb-3">
            <div class="form-check">
                <input
                    type="checkbox"
                    id="painting-display"
                    name="display"
                    value="1"
                    class="form-check-input @error('display') is-invalid @enderror"
                    @if (old('display', $painting->display)) checked @endif
                >
                <label class="form-check-label" for="painting-display">
                    Publish
                </label>

                @error('display')
                <p class="invalid-feedback">{{ $errors->first('display') }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $painting->exists ? 'Update' : 'Create' }}
        </button>
</form>

@endsection
