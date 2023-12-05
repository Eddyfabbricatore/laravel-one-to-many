@extends('layouts.admin')

@section('content')
    <h1 class="mb-5">{{ $title }}</h1>

    {{-- $errors->any() resituisce true se è presente almeno un errore nel form --}}
    @if($errors->any())
        <div class="alert alert-danger" role=alert>
            <ul>
                {{-- $errors->all() è una funzione che restituisce tutti gli errori presenti nel form sotto forma di array --}}
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method($method)

        <div class="row d-flex">
            <div class="col-3 mb-3">
                <label class="form-label" for="name">Nome Progetto</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name', $project?->name) }}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-3 mb-3">
                <label class="form-label" for="image">Immagine Progetto</label>
                <input
                  class="form-control @error('image') is-invalid @enderror"
                  type="file"
                  id="image"
                  name="image"
                  value="{{ old('image', $project?->image) }}"
                  onchange="showImage(event)">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <!-- In caso di errore nel caricamento dell'immagine non carico nulla -->
                <img class="w-50 h-50" id="thumb" onerror="this.src=''" src="{{ asset('storage/' . $project?->image) }}" alt="{{ $project?->name }}">
            </div>

            <div class="col-3 mb-3">
                <label class="form-label" for="name">Descrizione Progetto</label>
                <input class="form-control @error('description') is-invalid @enderror" type="text" id="description" name="description" value="{{ old('description', $project?->description) }}">
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-3 mb-3">
                <label class="form-label" for="type_id">Tipologia Progetto</label>

                <select class="form-select" id="type_id" name="type_id">
                    <option value="">Seleziona una tipologia</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id', $project?->type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-3 mb-3">
                <label class="form-label" for="name">Data Progetto</label>
                <input class="form-control @error('date') is-invalid @enderror" type="text" id="date" name="date" value="{{ old('date', $project?->date) }}">
                @error('date')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Invia</button>
            </div>

            <div class="col-auto">
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </div>
    </form>
@endsection

<script>
    function showImage(event){
        const thumb = document.getElementById('thumb');

        // Associo a src l'immagine caricata
        thumb.src = URL.createObjectURL(event.target.files[0]);
    }
</script>