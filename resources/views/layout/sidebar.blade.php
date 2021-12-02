<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book-open"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Perpus</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (Auth::check())
        @if (Auth::user()->level == 'admin')
            @php
                $namaMenu = 'Admin Menu';
                $menuPinjaman = 'Tabel Pinjaman';
                $linkPinjaman = route('pinjam.index');
            @endphp
        @else
            @php
                $namaMenu = 'Member Menu';
                $menuPinjaman = 'Pinjaman Saya';
                $linkPinjaman = route('home.pinjaman', Auth::user()->id);
            @endphp
        @endif
    <li class="nav-item active">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home Perpus</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{ $namaMenu }}</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ $namaMenu }}</h6>
                <a class="collapse-item" href="{{ $linkPinjaman }}">{{ $menuPinjaman }}</a>
                
                @if (Auth::user()->level == 'admin')                
                    <a class="collapse-item" href="{{ route('book.index') }}">Tabel Buku</a>
                @endif
            </div>
        </div>
    </li>
    @else
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('login') }}">
            <i class="fas fa-fw fa-key"></i>
            <span>Login</span></a>
    </li>
    @endif
    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->