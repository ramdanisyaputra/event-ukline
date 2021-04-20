

<?php $__env->startSection('content'); ?>
<style>
.set-button{
    font-size: 14px;
    letter-spacing: normal;
    padding: 10px 20px;
    color: #6c757d;
}
</style>
<section class="section">
    <div class="section-header">
        <h1><?php echo e($class->name); ?> Peserta <?php echo e($exam->name); ?></h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item"><?php echo e($class->name); ?> Peserta <?php echo e($exam->name); ?></div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4><?php echo e($class->name); ?> Peserta <?php echo e($exam->name); ?></h4>
                <div class="card-header-action">
                    <a href="<?php echo e(route('school_admin.exam-scores.exportExam', [$exam->id,$class->id])); ?>" class="btn btn-success">Export Excel</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Nilai</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $class->students()->orderBy('name', 'ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($key + 1); ?></td>
                                <td><?php echo e($student->nisn); ?></td>
                                <td><?php echo e($student->nis); ?></td>
                                <td><?php echo e($student->name); ?></td>
                                <?php
                                    $examScore = $student->examScores()->where('exam_id', $exam->id)->first();
                                ?>
                                <td>
                                    <?php echo e($examScore ? \Carbon\Carbon::parse($examScore->time_start)->isoFormat('dddd, DD MMMM  YYYY HH:mm') : '-'); ?>

                                </td>
                                <td>
                                    <?php echo e($examScore ? \Carbon\Carbon::parse($examScore->time_finish)->isoFormat('dddd, DD MMMM YYYY HH:mm') : '-'); ?>

                                </td>
                                <td>
                                    <?php echo e($examScore->score ?? 'Belum Mengerjakan'); ?>

                                </td>
                                <td class="text-center">
                                    <div class="d-inline d-flex">
                                        <a href="<?php echo e(route('school_admin.exam-scores.indexScore', $exam->id)); ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        <?php if($examScore != null): ?>
                                        <button class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#confirmDelete" data-url="<?php echo e(route('school_admin.exam-scores.deleteScoreStudent', $examScore->id)); ?>" title="Hapus"><i class="fa fa-trash"></i></button>
                                        <?php else: ?>
                                        <?php endif; ?>
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
                    <p>Apakah yakin Anda ingin menghapus nilai siswa ini?</p>
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/school_admin/exams/exam-scores/index-score-exam.blade.php ENDPATH**/ ?>