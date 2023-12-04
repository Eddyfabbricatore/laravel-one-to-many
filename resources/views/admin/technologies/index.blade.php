@extends('layouts.admin')

@section('content')
    <h1 class="mb-5">Elenco Tecnologie</h1>

    <div class="row">
        <div class="col">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(@session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if(@session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.technologies.store') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nuova tecnologia" name="name">
                    <button class="btn btn-outline-secondary" type="submit" id="new_technology">Crea</button>
                </div>
            </form>

            <table class="table table-bordered table-striped table-hover mb-5">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($technologies as $technology)
                        <tr>
                            <td>
                                <form
                                  action="{{ route('admin.technologies.update', $technology) }}"
                                  method="POST"
                                  id="form-edit-{{ $technology->id }}">
                                    @csrf
                                    @method('PUT')
                                    <input class="form-hidden" type="text" value="{{ $technology->name }}" name="name">
                                </form>
                            </td>
                            <td class="d-flex">
                                <button class="btn btn-warning me-3" onclick="submitForm({{ $technology->id }})" id="button-addon2"><i class="fa-solid fa-pencil"></i></button>

                                @include('admin.partials.form_delete', [
                                    'route' => route('admin.technologies.destroy', $technology),
                                    'message' => 'Sei sicuro di voler eliminare questa tecnologia'
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $technologies->links() }}

    <script>
        function submitForm(id){
            const form = document.getElementById('form-edit-' + id);
            form.submit();
        }
    </script>
@endsection
