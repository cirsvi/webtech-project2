@extends('layout')

@section('content')

<h1>{{ $title }}</h1>

 @if (count($items) > 0)

     <table class="table table-sm table-hover table-striped">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Year</th>
                    <th>Displayed</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            @foreach($items as $painting)
                <tr>
                    <td>{{ $painting->id }}</td>
                    <td>{{ $painting->title }}</td>
                    <td>{{ $painting->artist->name }}</td>
                    <td>{{ $painting->year }}</td>
                    <td>{!! $painting->display ? '&#x2714;' : '&#x274C;' !!}</td>
                    <td>
                        <a
                            href="/paintings/update/{{ $painting->id }}"
                            class="btn btn-outline-primary btn-sm"
                        >Edit</a> /<form
                            method="post"
                            action="/paintings/delete/{{ $painting->id }}"
                            class="d-inline deletion-form"
                        >
                            @csrf
                            <button
                                type="submit"
                                class="btn btn-outline-danger btn-sm"
                            >Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    @else
        <p>No entries found in database.</p>
    @endif

<a href="/paintings/create" class="btn btn-primary">Add new painting</a>

@endsection
