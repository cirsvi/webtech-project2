@extends('layout')

@section('content')

<h1>{{ $title }}</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">Please fix the validation errors!</div>
@endif

<form
    method="post"
    action="{{ $painting->exists ? '/paintings/patch/' . $painting->id : '/paintings/put' }}"
    enctype="multipart/form-data">
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
            <label for="painting-style" class="form-label">Style</label>

            <select
                id="painting-style"
                name="style_id"
                class="form-select @error('style_id') is-invalid @enderror"
            >
                <option value="">Choose the style!</option>
                @foreach($styles as $style)
                    <option
                        value="{{ $style->id }}"
                        @if ($style->id == old('style_id', $painting->style->id ?? false)) selected @endif
                    >{{ $style->name }}</option>
                @endforeach
            </select>

            @error('style_id')
            <p class="invalid-feedback">{{ $errors->first('style_id') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="painting-location" class="form-label">Location</label>

            <select
                id="painting-location"
                name="location_id"
                class="form-select @error('location_id') is-invalid @enderror"
            >
                <option value="">Choose the location!</option>
                @foreach($locations as $location)
                    <option
                        value="{{ $location->id }}"
                        @if ($location->id == old('location_id', $painting->location->id ?? false)) selected @endif
                    >{{ $location->name }}</option>
                @endforeach
            </select>

            @error('location_id')
            <p class="invalid-feedback">{{ $errors->first('location_id') }}</p>
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

        <div class="mb-3">
            <label for="painting-image" class="form-label">Image</label>

            @if ($painting->image)
                <img
                    src="{{ asset('images/' . $painting->image) }}"
                    class="img-fluid img-thumbnail d-block mb-2"
                    alt="{{ $painting->title }}"
                >
            @endif

            <input
                type="file" accept="image/png, image/webp, image/jpeg"
                id="painting-image"
                name="image"
                class="form-control @error('image') is-invalid @enderror"
            >

            @error('image')
            <p class="invalid-feedback">{{ $errors->first('image') }}</p>
            @enderror

            {{--Additional code bit:--}}
            <small class="text-muted">Accepted formats: PNG, WEBP, JPEG</small>
        </div>

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
