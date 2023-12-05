@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="alert alert-danger" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-5">Elenco progetti per tipologia</h1>

    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Tipologia</th>
            </tr>
        </thead>

        <tbody>
            @foreach($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->name }}</td>
                    <td>
                    <ul class="list-group">
                        @foreach($type?->projects as $project)
                            <a href="{{ route('admin.projects.show', $project) }}">{{ $project?->name }}</a>
                        @endforeach
                    </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
