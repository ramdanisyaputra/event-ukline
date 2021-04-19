<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Mata Pelajaran</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Mata Pelajaran</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Mata Pelajaran</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaMatapelajaran"><i class="fa fa-plus"></i> Tambah Mata Pelajaran</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($subject->name); ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editSubject" data-id="<?php echo e($subject->id); ?>" data-name="<?php echo e($subject->name); ?>" data-school-id="<?php echo e($subject->school_id); ?>"><i class="fas fa-pencil-alt"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="kelolaMatapelajaran" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('school_admin.subjects.store')); ?>" method="POST" id="formKelolaProvince">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Mata Pelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Mata Pelajaran</label>
                        <input type="name" class="form-control" id="name" name="name" required>
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

<div class="modal fade" id="editSubject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('school_admin.subjects.update')); ?>" method="POST" id="formKelolaProvince">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Mata Pelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Mata Pelajaran</label>
                        <input type="name" class="form-control" id="name" name="name" required>
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
    $('#editSubject').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');

        $('#editSubject').find('input[name="id"]').val(id);
        $('#editSubject').find('input[name="name"]').val(name);
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/ukline/event-ukline/resources/views/school_admin/subjects/index.blade.php ENDPATH**/ ?>