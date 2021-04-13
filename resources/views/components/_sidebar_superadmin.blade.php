<ul class="sidebar-menu">
    <li class="menu-header">Beranda</li>
    <li class="nav-item {{ request()->is('superadmin') ? 'active' : '' }}">
        <a href="{{ route('superadmin.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Beranda</span></a>
    </li>
    <li class="menu-header">Data Utama</li>
    <li class="nav-item {{ request()->is('superadmin/provinces*') ? 'active' : '' }}">
        <a href="{{ route('superadmin.provinces.index') }}" class="nav-link"><i class="fas fa-map"></i><span>Pronvinsi</span></a>
    </li>
    <li class="nav-item {{ request()->is('superadmin/regencies*') ? 'active' : '' }}">
        <a href="{{ route('superadmin.regencies.index') }}" class="nav-link"><i class="fas fa-map-pin"></i><span>Kab./Kota</span></a>
    </li>
    <li class="menu-header">Data Lainnya</li>
    <li class="nav-item {{ request()->is('superadmin/grades*') ? 'active' : '' }}">
        <a href="{{ route('superadmin.grades.index') }}" class="nav-link"><i class="fas fa-align-center"></i><span>Master Kelas</span></a>
    </li>
    <li class="nav-item {{ request()->is('superadmin/education-levels*') ? 'active' : '' }}">
        <a href="{{ route('superadmin.index') }}" class="nav-link"><i class="fas fa-book-open"></i><span>Tingkat Pendidikan</span></a>
    </li>
    <li class="menu-header">Data Sekolah</li>
    <li class="nav-item {{ request()->is('superadmin/schools*') ? 'active' : '' }}">
        <a href="{{ route('superadmin.index') }}" class="nav-link"><i class="fas fa-school"></i><span>Kelola Sekolah</span></a>
    </li>
    <li class="nav-item {{ request()->is('superadmin/school-admins*') ? 'active' : '' }}">
        <a href="{{ route('superadmin.index') }}" class="nav-link"><i class="fas fa-users"></i><span>Admin Sekolah</span></a>
    </li>
    <li class="menu-header">Fitur Lainnya</li>
    <li class="nav-item {{ request()->is('superadmin/faqs*') ? 'active' : '' }}">
        <a href="{{ route('superadmin.index') }}" class="nav-link"><i class="fas fa-question-circle"></i><span>FAQ</span></a>
    </li>
</ul>