

<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Kumpulan Ujian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo e(route('school_admin.index')); ?>">Beranda</a></div>
            <div class="breadcrumb-item">Kumpulan Ujian</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Ujian</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#examType"><i class="fa fa-plus"></i> Tambah Ujian</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Mata Pelajaran</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <?php
                                    \Carbon\Carbon::setLocale('id')
                                ?>
                                <td><span class="font-weight-bold"><?php echo e($exam->exam->name); ?></span> <span class="badge badge-light p-1 ml-1"><?php echo e(ucwords($exam->exam->shared ? 'Serentak' : 'Mandiri')); ?></span></td>
                                <td><?php echo e(\Carbon\Carbon::parse($exam->exam->started_at)->isoFormat('dddd, DD MMMM Y')); ?></td>
                                <td><?php echo e($exam->exam->duration); ?> menit</td>
                                <td><span class="badge badge-<?php echo e($exam->exam->status == 'published' ? 'primary' : 'light'); ?>"><?php echo e(ucwords($exam->exam->status == 'published' ? 'dipublikasi' : 'diarsipkan')); ?></span></td>
                                <td><?php echo e($exam->subject->name); ?></td>
                                <td>
                                    <div class="d-inline d-flex">
                                    <a href="<?php echo e(route('school_admin.exams.questions.index', $exam->exam->id)); ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                    <button class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#confirmDelete" data-url="<?php echo e(route('school_admin.exams.delete', $exam->id)); ?>" title="Hapus"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="examType" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Jenis Ujian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?php echo e(route('school_admin.exams.create_private')); ?>" class="py-5 font-weight-bold bg-light text-primary d-block text-center text-decoration-none rounded shadow-sm">Mandiri</a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo e(route('school_admin.exams.create_public')); ?>" class="py-5 font-weight-bold bg-light text-primary d-block text-center text-decoration-none rounded shadow-sm">Serentak</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah yakin Anda ingin menghapus ujian ini ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    $('#confirmDelete').on('show.bs.modal', (e) => {
        var url = $(e.relatedTarget).data('url');

        $(e.currentTarget).find('form').attr('action', url);
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/school_admin/exams/index.blade.php ENDPATH**/ ?>