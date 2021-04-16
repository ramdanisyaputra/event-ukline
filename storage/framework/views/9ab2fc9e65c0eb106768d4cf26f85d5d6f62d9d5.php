<ul class="sidebar-menu">
    <li class="menu-header">Beranda</li>
    <li class="nav-item <?php echo e(request()->is('question_writer') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('question_writer.index')); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Beranda</span></a>
    </li>
    <li class="menu-header">Data Utama</li>
    <li class="nav-item <?php echo e(request()->is('question_writer/exam*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('question_writer.exams.index')); ?>" class="nav-link"><i class="fas fa-book"></i><span>Kumpulan Ujian</span></a>
    </li>
</ul><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/components/_sidebar_question_writer.blade.php ENDPATH**/ ?>