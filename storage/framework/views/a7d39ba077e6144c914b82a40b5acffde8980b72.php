

<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Tingkat Pendidikan</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Tingkat Pendidikan</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Tingkat Pendidikan</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaTingkatPendidikan"><i class="fa fa-plus"></i> Tambah Tingkat Pendidikan</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Tingkat</th>
                                <th>Kode Tingkat Pendidikan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $educationLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $educationLevel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($educationLevel->id); ?></td>
                                <td><?php echo e($educationLevel->name); ?></td>
                                <td><?php echo e($educationLevel->level_code); ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editEducationLevel" data-id="<?php echo e($educationLevel->id); ?>" data-name="<?php echo e($educationLevel->name); ?>" data-level-code="<?php echo e($educationLevel->level_code); ?>"><i class="fas fa-pencil-alt"></i></button>
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

<div class="modal fade" id="kelolaTingkatPendidikan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('superadmin.education-levels.store')); ?>" method="POST" id="formKelolaProvince">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Tingkat Pendidikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tingkat Pendidikan</label>
                        <input type="name" class="form-control" id="name" name="name" placeholder="Contoh : SD ,SMP, SMA" required>
                    </div>
                    <div class="form-group">
                        <label for="level_code">Kode Tingkat Pendidikan</label>
                        <input type="level_code" class="form-control" id="level_code" name="level_code" required>
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

<div class="modal fade" id="editEducationLevel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('superadmin.education-levels.update')); ?>" method="POST" id="formKelolaProvince">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Tingkat Pendidikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tingkat Pendidikan</label>
                        <input type="name" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="level_code">Kode Tingkat Pendidikan</label>
                        <input type="level_code" class="form-control" id="level_code" name="level_code" required>
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
    $('#editEducationLevel').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var levelCode = $(e.relatedTarget).data('level-code');

        $('#editEducationLevel').find('input[name="id"]').val(id);
        $('#editEducationLevel').find('input[name="name"]').val(name);
        $('#editEducationLevel').find('input[name="level_code"]').val(levelCode);
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/superadmin/education-levels/index.blade.php ENDPATH**/ ?>