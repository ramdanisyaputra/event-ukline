

<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Admin Sekolah</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Admin Sekolah</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Admin Sekolah</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaAdminSekolah"><i class="fa fa-plus"></i> Tambah Admin Sekolah</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Sekolah</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $schoolAdmins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($admin->name); ?></td>
                                <td><?php echo e($admin->username); ?></td>
                                <td><?php echo e($admin->school->name); ?></td>
                                <td class="text-center">
                                    <div class="d-inline d-flex">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editAdminSekolah" data-id="<?php echo e($admin->id); ?>" data-name="<?php echo e($admin->name); ?>" data-username="<?php echo e($admin->username); ?>" data-school="<?php echo e($admin->school_id); ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <form action="<?php echo e(route('superadmin.school-admins.resetPassword')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>    
                                    <?php echo method_field('PUT'); ?>
                                        <input type="hidden" name="id" value="<?php echo e($admin->id); ?>">
                                        <button class="btn btn-sm btn-danger ml-1" onclick="return confirm('Apa Anda yakin ingin mereset password ?');" type="submit"><i class="fas fa-cogs"></i></button>
                                    </form>
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

<div class="modal fade" id="kelolaAdminSekolah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('superadmin.school-admins.store')); ?>" method="POST" id="formKelolaAdminSekolah">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Admin Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> <div class="form-group">
                        <label for="name">Nama Admin</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="school_id">Sekolah</label>
                        <select name="school_id" id="school_id" class="custom-select" required>
                            <option value="" selected></option>
                            <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($school->id); ?>"><?php echo e($school->name); ?></option>
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

<div class="modal fade" id="editAdminSekolah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('superadmin.school-admins.update')); ?>" method="POST" id="formKelolaAdminSekolah">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Admin Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Admin</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="school_id">Sekolah</label>
                        <select name="school_id" id="school_id" class="custom-select" required>
                            <option value="" selected></option>
                            <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($school->id); ?>"><?php echo e($school->name); ?></option>
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
    $('#editAdminSekolah').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var username= $(e.relatedTarget).data('username');
        var school_id = $(e.relatedTarget).data('school');

        $('#editAdminSekolah').find('input[name="id"]').val(id);
        $('#editAdminSekolah').find('input[name="name"]').val(name);
        $('#editAdminSekolah').find('input[name="username"]').val(username);
        $('#editAdminSekolah').find('select[name="school_id"]').val(school_id);
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/superadmin/school_admins/index.blade.php ENDPATH**/ ?>