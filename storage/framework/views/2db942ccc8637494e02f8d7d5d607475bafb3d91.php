

<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Pratinjau Soal</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo e(route('school_admin.index')); ?>">Beranda</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo e(route('school_admin.exams.index')); ?>">Kumpulan Ujian</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo e(route('school_admin.exams.questions.index', $exam->id)); ?>"><?php echo e($exam->name); ?></a></div>
            <div class="breadcrumb-item">Pratinjau</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Pratinjau Soal <?php echo e($exam->name); ?> </h4>
            </div>
            <div class="card-body">
                <div>
                    <table>
                        <tr>
                            <td>Judul Ujian</td>
                            <td class="px-2">:</td>
                            <td><?php echo e($exam->name); ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Ujian</td>
                            <td class="px-2">:</td>
                            <td><?php echo e($exam->examType->name); ?></td>
                        </tr>
                        <tr>
                            <td>Durasi Ujian</td>
                            <td class="px-2">:</td>
                            <td><?php echo e($exam->duration); ?> Menit</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pelaksanaan</td>
                            <td class="px-2">:</td>
                            <td><?php echo e(\Carbon\Carbon::parse($exam->started_at)->isoFormat('dddd, DD MMMM YYYY')); ?></td>
                        </tr>
                    </table>
                    <hr>
                    <div class="mt-3">
                        <ol class="pl-4">
                        <?php $__currentLoopData = $examQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $examQuestion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="pb-3">
                                <div class="ml-2">
                                    <?php echo $examQuestion->question; ?>

                                </div>
                                <?php if($examQuestion->question_type == 'PG'): ?>
                                <ol type="a" class="pl-3">
                                    <?php $__currentLoopData = json_decode($examQuestion->option); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="<?php echo e($key == $examQuestion->answer ? 'text-primary font-weight-bold' : ''); ?>"><?php echo $option; ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ol>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/school_admin/exams/questions/pratinjau.blade.php ENDPATH**/ ?>