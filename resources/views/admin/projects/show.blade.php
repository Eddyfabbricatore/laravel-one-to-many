@php
    use App\Functions\Helper;
@endphp

@extends('layouts.admin')

@section('content')
    <h1 class="mb-5">{{ $project->name }}</h1>

    <div class="card mb-3" style="width: 80vw;">
        <div class="row">
            <div class="col">
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ $project->name }}</h5>

                    <div class="image w-50">
                        <img class="img-fluid" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}">
                        <p>{{ $project->image_original_name }}</p>
                    </div>

                    <p class="card-text">{{ $project->description }}</p>

                    <p class="card-text">{{ Helper::formatDate($project->date) }}</p>
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.btn_prev_next')
@endsection
