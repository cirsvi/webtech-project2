@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if (count($items) > 0)

        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>

            @foreach($items as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->name }}</td>
                    <td><a href="/locations/update/{{ $location->id }}" class="btn btn-outline-primary btn-sm">Edit</a>
                        <form action="/locations/delete/{{ $location->id }}" method="post" class="d-inline deletion-form">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No entries found in database.</p>
    @endif

    <a href="/locations/create" class="btn btn-primary">Add new</a>

@endsection
