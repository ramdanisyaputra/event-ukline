<ul class="sidebar-menu">
    <li class="menu-header">Beranda</li>
    <li class="nav-item <?php echo e(request()->is('superadmin') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('superadmin.index')); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Beranda</span></a>
    </li>
    <li class="menu-header">Data Utama</li>
    <li class="nav-item <?php echo e(request()->is('superadmin/provinces*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('superadmin.provinces.index')); ?>" class="nav-link"><i class="fas fa-map"></i><span>Provinsi</span></a>
    </li>
    <li class="nav-item <?php echo e(request()->is('superadmin/regencies*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('superadmin.regencies.index')); ?>" class="nav-link"><i class="fas fa-map-pin"></i><span>Kab./Kota</span></a>
    </li>
    <li class="menu-header">Data Lainnya</li>
    <li class="nav-item <?php echo e(request()->is('superadmin/education-levels*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('superadmin.education-levels.index')); ?>" class="nav-link"><i class="fas fa-book-open"></i><span>Tingkat Pendidikan</span></a>
    </li>
    <li class="nav-item <?php echo e(request()->is('superadmin/grades*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('superadmin.grades.index')); ?>" class="nav-link"><i class="fas fa-align-center"></i><span>Master Kelas</span></a>
    </li>
    <li class="nav-item <?php echo e(request()->is('superadmin/exam-types*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('superadmin.exam-types.index')); ?>" class="nav-link"><i class="fas fa-bookmark "></i><span>Tipe Ujian</span></a>
    </li>
    <li class="nav-item <?php echo e(request()->is('superadmin/question-writers*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('superadmin.question-writers.index')); ?>" class="nav-link"><i class="fas fa-user-circle"></i><span>Penulis Soal</span></a>
    </li>
    <li class="menu-header">Data Sekolah</li>
    <li class="nav-item <?php echo e(request()->is('superadmin/schools*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('superadmin.schools.index')); ?>" class="nav-link"><i class="fas fa-school"></i><span>Kelola Sekolah</span></a>
    </li>
    <li class="nav-item <?php echo e(request()->is('superadmin/school-admins*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('superadmin.school-admins.index')); ?>" class="nav-link"><i class="fas fa-users"></i><span>Admin Sekolah</span></a>
    </li>
    <li class="menu-header">Fitur Lainnya</li>
    <li class="nav-item <?php echo e(request()->is('superadmin/tags*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('superadmin.tags.index')); ?>" class="nav-link"><i class="fas fa-tags"></i><span>Kategori</span></a>
    </li>
    <li class="nav-item <?php echo e(request()->is('superadmin/faqs*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('superadmin.faqs.index')); ?>" class="nav-link"><i class="fas fa-question-circle"></i><span>FAQ</span></a>
    </li>
</ul><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/components/_sidebar_superadmin.blade.php ENDPATH**/ ?>