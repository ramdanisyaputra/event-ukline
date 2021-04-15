

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
                <h4>Daftar Ujian</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaStudent"><i class="fa fa-plus"></i> Tambah Ujian</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1"> 
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Mulai Pada</th>
                                <th>Berakhir Pada</th>
                                <th>Kode Akses</th>
                                <th>Jenis Ujian</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($exam->name); ?></td>
                                <td><?php echo e($exam->started_at); ?></td>
                                <td><?php echo e($exam->expired_at); ?></td>
                                <td><?php echo e($exam->access_code); ?></td>
                                <td><?php echo e($exam->examType->name); ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editExam" data-id="<?php echo e($exam->id); ?>" data-name="<?php echo e($exam->name); ?>" data-started-at="<?php echo e(date('Y-m-d\TH:i', strtotime($exam->started_at))); ?>" data-expired-at="<?php echo e(date('Y-m-d\TH:i', strtotime($exam->expired_at))); ?>" data-access-code="<?php echo e($exam->access_code); ?>" data-duration="<?php echo e($exam->duration); ?>" data-exam-type-id="<?php echo e($exam->exam_type_id); ?>"><i class="fas fa-pencil-alt"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="kelolaStudent" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('question_writer.exams.store')); ?>" method="POST" id="formKelolaExam">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Ujian</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="started_at">Dimulai Pada</label>
                        <input type="datetime-local" class="form-control" name="started_at" id="started_at">
                    </div>
                    <div class="form-group">
                        <label for="expired_at">Berakhir Pada</label>
                        <input type="datetime-local" class="form-control" name="expired_at" id="expired_at">
                    </div>
                    <div class="form-group">
                        <label for="duration">Durasi</label>
                        <input type="number" class="form-control" name="duration" id="duration">
                    </div>
                    <div class="form-group">
                        <label for="access_code">Kode Akses</label>
                        <input type="text" class="form-control" name="access_code" id="access_code">
                    </div>
                    <div class="form-group">
                        <label for="exam_type_id">Jenis Ujian</label>
                        <select name="exam_type_id" id="exam_type_id" class="form-control" required>
                            <option value=""> ~ Pilih ~</option>
                            <?php $__currentLoopData = $examTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($exam->id); ?>"><?php echo e($exam->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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


<div class="modal fade" id="editExam" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('question_writer.exams.update')); ?>" method="POST" id="formKelolaExam">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Ujian</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="started_at">Dimulai Pada</label>
                        <input type="datetime-local" class="form-control" name="started_at" id="started_at">
                    </div>
                    <div class="form-group">
                        <label for="expired_at">Berakhir Pada</label>
                        <input type="datetime-local" class="form-control" name="expired_at" id="expired_at">
                    </div>
                    <div class="form-group">
                        <label for="duration">Durasi</label>
                        <input type="number" class="form-control" name="duration" id="duration">
                    </div>
                    <div class="form-group">
                        <label for="access_code">Kode Akses</label>
                        <input type="text" class="form-control" name="access_code" id="access_code">
                    </div>
                    <div class="form-group">
                        <label for="exam_type_id">Jenis Ujian</label>
                        <select name="exam_type_id" id="exam_type_id" class="form-control" required>
                            <option value=""> ~ Pilih ~</option>
                            <?php $__currentLoopData = $examTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($exam->id); ?>"><?php echo e($exam->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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

<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>
<script>
    $('#editExam').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var startedAt= $(e.relatedTarget).data('started-at');
        var expiredAt= $(e.relatedTarget).data('expired-at');
        var duration= $(e.relatedTarget).data('duration');
        var accessCode= $(e.relatedTarget).data('access-code');
        var examTypeId= $(e.relatedTarget).data('exam-type-id');

        $('#editExam').find('input[name="id"]').val(id);
        $('#editExam').find('input[name="name"]').val(name);
        $('#editExam').find('input[name="started_at"]').val(startedAt);
        $('#editExam').find('input[name="expired_at"]').val(expiredAt);
        $('#editExam').find('input[name="duration"]').val(duration);
        $('#editExam').find('input[name="access_code"]').val(accessCode);
        $('#editExam').find('select[name="exam_type_id"]').val(examTypeId);
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/question_writer/exams/index.blade.php ENDPATH**/ ?>