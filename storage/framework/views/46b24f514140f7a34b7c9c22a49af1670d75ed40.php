

<?php $__env->startSection('content'); ?>
<style>
    .table-questions img {
        max-width: 200px;
        height: auto;
    }
</style>
<section class="section">
    <div class="section-header">
        <h1>Ujian Matematika</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo e(route('school_admin.index')); ?>">Beranda</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo e(route('school_admin.exams.index')); ?>">Kumpulan Ujian</a></div>
            <div class="breadcrumb-item">Soal</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Ujian</h4>
                        <div class="card-header-action dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="fa fa-cog"></i> Pengaturan</a>
                            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <li class="dropdown-title">Pengaturan</li>
                                <li><a href="#editExam" data-toggle="modal" data-target="#editExam" class="dropdown-item">Ubah</a></li>
                                <li class="dropdown-title">Aksi</li>
                                <li><a href="#" class="dropdown-item">Lihat nilai</a></li>
                                <?php if(!$exam->shared): ?>
                                <li>
                                    <form action="<?php echo e(route('school_admin.exams.update_status')); ?>" method="POST" id="examUpdateStatus">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <input type="hidden" name="id" value="<?php echo e($exam->id); ?>">
                                        <input type="hidden" name="status" value="<?php echo e($exam->status == 'published' ? 'drafted' : 'published'); ?>">
                                    </form>
                                    <a href="#" onclick="document.getElementById('examUpdateStatus').submit()" class="dropdown-item"><?php echo e($exam->status == 'published' ? 'Arsipkan' : 'Publikasikan'); ?></a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 py-1">
                                Judul
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                <?php echo e($exam->name); ?>

                            </div>
                            <div class="col-md-4 py-1">
                                Mata Pel.
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                <?php echo e($exam->examClass->first()->subject->name); ?>

                            </div>
                            <div class="col-md-4 py-1">
                                Jenis Ujian
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                <?php echo e($exam->examType->name); ?>

                            </div>
                            <div class="col-md-4 py-1">
                                Jenis Ujian
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                <?php echo e($exam->shared ? 'Serentak' : 'Mandiri'); ?>

                            </div>
                            <div class="col-md-4 py-1">
                                Tanggal
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                <?php echo e(\Carbon\Carbon::parse($exam->started_at)->isoFormat('dddd, DD MMMM YYYY')); ?>

                            </div>
                            <div class="col-md-4 py-1">
                                Waktu
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                <?php echo e(\Carbon\Carbon::parse($exam->started_at)->isoFormat('HH:mm')); ?> - <?php echo e(\Carbon\Carbon::parse($exam->expired_at)->isoFormat('HH:mm')); ?>

                            </div>
                            <div class="col-md-4 py-1">
                                Durasi
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                <?php echo e($exam->duration); ?> Menit
                            </div>
                            <div class="col-md-4 py-1">
                                Peserta Kelas
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                <?php
                                $strClassess = '';
                                foreach ($selectedClassess as $class) {
                                    $strClassess .= "$class->name, ";
                                }
                                $strClassess = rtrim($strClassess, ', ');
                                ?>

                                <?php echo e($strClassess ?? '-'); ?>

                            </div>
                            <div class="col-md-4 py-1">
                                Kode Akses
                            </div>
                            <div class="col-md-8 font-weight-bold py-1 text-primary">
                                <?php echo e($exam->access_code); ?>

                            </div>
                            <div class="col-md-4 py-1">
                                Soal Diacak :
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                <?php echo e($exam->randomized == 1 ? 'Diacak' : 'Tidak Diacak'); ?>

                            </div>
                            <div class="col-md-4 py-1">
                                Total Soal
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                <?php echo e(count($exam->examQuestions)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-secondary">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Status</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo e($exam->status == 'published' ? 'Dipublikasi' : 'Diarsipkan'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-secondary">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Jenis Ujian</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo e($exam->shared ? 'Serentak' : 'Mandiri'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-secondary">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Soal</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo e($exam->examQuestions->count()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-secondary">
                                <i class="far fa-building"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Kelas</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo e($selectedClassess->count()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(!$exam->shared): ?>
        <div class="card">
            <div class="card-header">
                <h4>Daftar Soal</h4>
                <div class="card-header-action dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="fa fa-cog"></i> Pengaturan</a>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <li class="dropdown-title">Pengaturan</li>
                        <li><a href="<?php echo e(route('school_admin.exams.questions.pratinjau', $exam->id)); ?>" class="dropdown-item">Pratinjau</a></li>
                            <?php if($exam->status != 'published'): ?>
                            <li><a href="<?php echo e(route('school_admin.exams.questions.create', $exam->id)); ?>" class="dropdown-item">Buat soal</a></li>
                            <li><a data-toggle="modal" data-target="#import" class="dropdown-item">Impor soal (.xlsx)</a></li>
                            <?php endif; ?>
                        <li><a href="<?php echo e(route('school_admin.exams.questions.export', $exam->id)); ?>" class="dropdown-item">Ekspor soal (.xlsx)</a></li>
                        <li><a href="<?php echo e(route('school_admin.exams.questions.pdf', $exam->id)); ?>" target="_blank" class="dropdown-item">Ekspor soal (.pdf)</a></li>
                            <?php if($exam->status != 'published'): ?>
                            <li><a href="#" data-toggle="modal" data-target="#confirmDeleteAll" class="dropdown-item text-danger">Hapus semua <i class="fa fa-exclamation-circle"></i></a></li>
                            <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-questions">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tipe</th>
                                <th>Soal</th>
                                <th>Opsi</th>
                                <th>Jawaban</th>
                                <th>Poin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $exam->examQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="align-top py-2"><?php echo e(++$key); ?></td>
                                <td class="align-top py-2"><?php echo e($question->question_type); ?></td>
                                <td class="align-top py-2"><?php echo $question->question; ?></td>
                                <td class="align-top py-2">
                                    <?php if($question->option): ?>
                                    <ol type="a" class="pl-0">
                                        <?php $__currentLoopData = json_decode($question->option); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo $option; ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ol>
                                    <?php else: ?>
                                    -
                                    <?php endif; ?>
                                </td>
                                <td class="align-top py-2">
                                    <?php echo $question->answer; ?>

                                </td>
                                <td class="align-top py-2">
                                    <?php echo e($question->poin ?? 'Belum dipublikasi'); ?>

                                </td>
                                <td class="align-top py-2">
                                <?php if($exam->status != 'published'): ?>
                                    <a href="<?php echo e(route('school_admin.exams.questions.edit', [$exam->id, $question->id])); ?>" class="btn btn-sm btn-light d-block" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                                    <button class="btn btn-sm btn-danger mt-2 d-block" data-toggle="modal" data-target="#confirmDelete" data-url="<?php echo e(route('school_admin.exams.questions.delete', [$exam->id, $question->id])); ?>" title="Hapus"><i class="fa fa-trash"></i></button>
                                <?php else: ?>
                                    Tidak ada aksi
                                <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td class="text-center" colspan="7">Tidak ada data</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>                    
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="editExam" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('school_admin.exams.update')); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Ujian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <input type="hidden" name="id" value="<?php echo e($exam->id); ?>">
                    <input type="hidden" name="shared" value="<?php echo e($exam->shared); ?>">
                    <?php if(!$exam->shared): ?>
                    <div class="form-group">
                        <label for="name">Judul</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo e($exam->name); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="subject_id">Mata Pelajaran</label>
                        <select name="subject_id" id="subject_id" class="custom-select">
                            <option value=""></option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($subject->id); ?>" <?php echo e($subject->id == $exam->examClass->first()->subject_id ? 'selected' : ''); ?>><?php echo e($subject->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php if(!$exam->shared): ?>
                    <div class="form-group">
                        <label for="exam_type_id">Jenis Ujian</label>
                        <select name="exam_type_id" id="exam_type_id" class="custom-select">
                            <option value=""></option>
                            <?php $__currentLoopData = $exam_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($exam_type->id); ?>" <?php echo e($exam_type->id == $exam->exam_type_id ? 'selected' : ''); ?>><?php echo e($exam_type->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="started_at">Dimulai Pada</label>
                        <input type="datetime-local" name="started_at" id="started_at" class="form-control" value="<?php echo e(date('Y-m-d\TH:i', strtotime($exam->started_at))); ?>">
                    </div>
                    <div class="form-group">
                        <label for="expired_at">Berakhir Pada</label>
                        <input type="datetime-local" name="expired_at" id="expired_at" class="form-control" value="<?php echo e(date('Y-m-d\TH:i', strtotime($exam->expired_at))); ?>">
                    </div>
                    <div class="form-group">
                        <label for="duration">Durasi</label>
                        <input type="number" name="duration" id="duration" class="form-control" value="<?php echo e($exam->duration); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="class_ids">Kelas yang Diizinkan</label>
                        <select name="class_ids[]" id="class_ids" class="js-example-basic-multiple" multiple>
                            <option value=""></option>
                            <?php $__currentLoopData = $selectedClassess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($class->id); ?>"
                                    <?php $__currentLoopData = json_decode($exam->examClass->first()->class_ids); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($class_id == $class->id ? 'selected' : ''); ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    ><?php echo e($class->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php if(!$exam->shared): ?>
                    <div class="form-group">
                        <label for="access_code">Kode Akses <i class="fa fa-question-circle"></i></label>
                        <input type="text" name="access_code" id="access_code" class="form-control" value="<?php echo e($exam->access_code); ?>">
                    </div>
                    <div class="form-group">
                        <label for="randomized">Acak Soal <i class="fa fa-question-circle"></i></label>
                        <select name="randomized" id="randomized" class="custom-select" required>
                            <option value="" disabled selected></option>
                            <option value="0" <?php echo e($exam->randomized == 0 ? 'selected' : ''); ?>>Tidak Diacak</option>
                            <option value="1" <?php echo e($exam->randomized == 1 ? 'selected' : ''); ?>>Diacak</option>
                        </select>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('school_admin.exams.questions.import',$exam->id)); ?>" method="POST" id="formkelolaStudents" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><span>Import</span> Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <h6 for="file">Download Panduan</h6>
                        <a href="<?php echo e(asset('panduan/Panduan Import Soal.xlsx')); ?>" class="nav-link">Download Panduan Import Soal Berikut</a>
                    </div>
                    <div class="form-group">
                        <label for="file">Data Excel</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
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
                    <p>Apakah yakin Anda ingin menghapus soal ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeleteAll" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('school_admin.exams.questions.delete_all', $exam->id)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah yakin Anda ingin menghapus <strong>semua soal ujian</strong> ini?</p>
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/school_admin/exams/questions/index.blade.php ENDPATH**/ ?>