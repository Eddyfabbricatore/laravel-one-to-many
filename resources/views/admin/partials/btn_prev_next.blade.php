<div class="btn-box d-flex justify-content-center p-3 gap-4">
    @if($prevProject)
        <a class="btn btn-primary" href="{{ route('admin.projects.show', $prevProject->id) }}">Progetto Precedente</a>
    @endif

    @if($nextProject)
        <a class="btn btn-primary" href="{{ route('admin.projects.show', $nextProject->id) }}">Progetto Successivo</a>
    @endif
</div>
