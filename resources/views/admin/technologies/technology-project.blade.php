@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="alert alert-danger" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-5">Elenco Progetti per tecnologia</h1>

    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Tecnologia</th>
            </tr>
        </thead>

        <tbody>
            @foreach($technologies as $technology)
                <tr>
                    <td>{{ $technology->id }}</td>
                    <td>{{ $technology->name }}</td>
                    <td>
                    <ul class="list-group">
                        @foreach($technology?->projects as $project)
                            <a href="{{ route('admin.projects.show', $project) }}">{{ $project?->name }}</a>
                        @endforeach
                    </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
