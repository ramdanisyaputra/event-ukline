<ul class="sidebar-menu">
    <li class="menu-header">Beranda</li>
    <li class="nav-item {{ request()->is('question_writer') ? 'active' : '' }}">
        <a href="{{ route('question_writer.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Beranda</span></a>
    </li>
    <li class="menu-header">Data Utama</li>
    <li class="nav-item {{ request()->is('question_writer/exam*') ? 'active' : '' }}">
        <a href="{{route('question_writer.exams.index')}}" class="nav-link"><i class="fas fa-book"></i><span>Kumpulan Ujian</span></a>
    </li>
</ul>