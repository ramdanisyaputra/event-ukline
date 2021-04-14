

<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Ujian</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Ujian</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Kelola Ujian</h4>
                <div class="card-header-action">
                    <a class="btn btn-primary" href="<?php echo e(route('question_writer.exams.questions.create')); ?>" ><i class="fa fa-plus"></i> Tambah Ujian</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Poin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $examQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($question->question); ?></td>
                                <td><?php echo e($question->poin); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('question_writer.exams.edit', $question->id)); ?>" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i> </a>
                                    <a href="<?php echo e(route('question_writer.exams.show', $question->id)); ?>" class="btn btn-success btn-sm"> <i class="fas fa-eye"></i> </a>
                                    <a href="<?php echo e(route('question_writer.exams.questions.index', $question->id)); ?>" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/question_writer/question_exams/index.blade.php ENDPATH**/ ?>