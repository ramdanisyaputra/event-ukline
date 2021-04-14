<ul class="sidebar-menu">
    <li class="menu-header">Beranda</li>
    <li class="nav-item <?php echo e(request()->is('school_admin') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('school_admin.index')); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Beranda</span></a>
    </li>
    <li class="menu-header">Data Utama</li>
    <li class="nav-item <?php echo e(request()->is('school_admin/subjects*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('school_admin.subjects.index')); ?>" class="nav-link"><i class="fas fa-book"></i><span>Matapelajaran</span></a>
    </li>
    <li class="nav-item <?php echo e(request()->is('school_admin/regencies*') ? 'active' : ''); ?>">
        <a href="" class="nav-link"><i class="fas fa-university"></i><span>Data Kelas</span></a>
    </li>
    <li class="menu-header">Data Lainnya</li>
    <li class="nav-item <?php echo e(request()->is('school_admin/education-levels*') ? 'active' : ''); ?>">
        <a href="" class="nav-link"><i class="fas fa-user"></i><span>Data Siswa</span></a>
    </li>
    <li class="nav-item <?php echo e(request()->is('school_admin/grades*') ? 'active' : ''); ?>">
        <a href="" class="nav-link"><i class="fas fa-laptop"></i><span>Data Ujian</span></a>
    </li>
    <li class="nav-item <?php echo e(request()->is('school_admin/exam-types*') ? 'active' : ''); ?>">
        <a href="" class="nav-link"><i class="fas fa-newspaper "></i><span>Data Nilai</span></a>
    </li>
</ul><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/components/_sidebar_school_admin.blade.php ENDPATH**/ ?>