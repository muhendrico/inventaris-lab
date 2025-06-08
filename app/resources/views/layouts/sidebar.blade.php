<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('inventaris.index') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-laptop"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Inventaris Lab</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->is('inventaris*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('inventaris.index') }}">
            <i class="fas fa-boxes"></i>
            <span>Data Inventaris</span>
        </a>
    </li>

    <!-- Kategori -->
    <li class="nav-item {{ request()->is('kategori*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kategori.index') }}">
            <i class="fas fa-tags"></i>
            <span>Kategori</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Logout -->
    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn nav-link text-start">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </li>

</ul>
