<header class="d-flex justify-content-between align-items-center ps-3 pe-3">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link ps-0" target="_blank" href="{{ route('home') }}">Sito Pubblico</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home') }}">Dashboard</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.projects.index') }}">Elenco Progetti</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.technologies.index') }}">Elenco Tecnologie</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.types.index') }}">Elenco Tipi</a>
        </li>
    </ul>

    <form action="{{ route('logout') }}" method="POST" role="search">
        @csrf
        <button class="btn btn-light" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
    </form>
</header>
