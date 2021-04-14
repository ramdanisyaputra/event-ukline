

<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Sekolah</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Sekolah</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Sekolah</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaSekolah"><i class="fa fa-plus"></i> Tambah Sekolah</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kepala Sekolah</th>
                                <th>Regensi</th>
                                <th>Tingkat Pendidikan</th>
                                <th>Alamat</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($school->name); ?></td>
                                <td><?php echo e($school->headmaster_name); ?></td>
                                <td><?php echo e($school->regency->name); ?></td>
                                <td><?php echo e($school->educationLevel->name); ?></td>
                                <td><?php echo e($school->address); ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editSekolah" data-id="<?php echo e($school->id); ?>" data-name="<?php echo e($school->name); ?>" data-headmaster-name="<?php echo e($school->headmaster_name); ?>" data-regency="<?php echo e($school->regency_id); ?>" data-education-level="<?php echo e($school->education_level_id); ?>" data-address="<?php echo e($school->address); ?>"><i class="fas fa-pencil-alt"></i></button>
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

<div class="modal fade" id="kelolaSekolah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('superadmin.schools.store')); ?>" method="POST" id="formKelolaSekolah">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Sekolah</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name')); ?>" required placeholder="Contoh: SMP 1">
                    </div>
                    <div class="form-group">
                        <label for="headmaster_name">Kepala Sekolah</label>
                        <input type="text" class="form-control" id="headmaster_name" name="headmaster_name" value="<?php echo e(old('headmaster_name')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control" id="address" name="address" required><?php echo e(old('address')); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="regency_id">Regensi</label>
                        <select name="regency_id" id="regency_id" class="custom-select" required>
                            <option value="" selected></option>
                            <?php $__currentLoopData = $regencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $regency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($regency->id); ?>"><?php echo e($regency->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="education_level_id">Tingkat Pendidikan</label>
                        <select name="education_level_id" id="education_level_id" class="custom-select" required>
                            <option value="" selected></option>
                            <?php $__currentLoopData = $educationLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($education->id); ?>"><?php echo e($education->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status Event</label>
                        <select name="status" id="status" class="custom-select" required>
                            <option value="" selected> </option>
                            <option value="tryout">Try Out</option>
                            <option value="resmi">Resmi</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="active_status">Status Sekolah</label>
                        <select name="active_status" id="active_status" class="custom-select" required>
                            <option value="" selected> </option>
                            <option value="0">Tidak Aktif</option>
                            <option value="1">Aktif</option>
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

<div class="modal fade" id="editSekolah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('superadmin.schools.update')); ?>" method="POST" id="formKelolaSekolah">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Sekolah</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Contoh: SMP 1">
                    </div>
                    <div class="form-group">
                        <label for="headmaster_name">Kepala Sekolah</label>
                        <input type="text" class="form-control" id="headmaster_name" name="headmaster_name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control" id="address" name="address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="regency_id">Regensi</label>
                        <select name="regency_id" id="regency_id" class="custom-select" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $regencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $regency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($regency->id); ?>"><?php echo e($regency->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="education_level_id">Tingkat Pendidikan</label>
                        <select name="education_level_id" id="education_level_id" class="custom-select" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $educationLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($education->id); ?>"><?php echo e($education->name); ?></option>
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
    $('#editSekolah').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var headmasterName= $(e.relatedTarget).data('headmaster-name');
        var regencyId = $(e.relatedTarget).data('regency');
        var educationLevelId = $(e.relatedTarget).data('education-level');
        var address = $(e.relatedTarget).data('address');

        $('#editSekolah').find('input[name="id"]').val(id);
        $('#editSekolah').find('input[name="name"]').val(name);
        $('#editSekolah').find('input[name="headmaster_name"]').val(headmasterName);
        $('#editSekolah').find('textarea[name="address"]').val(address);
        $('#editSekolah').find('select[name="regency_id"]').val(regencyId);
        $('#editSekolah').find('select[name="education_level_id"]').val(educationLevelId);
        $('#editSekolah').find('select[name="address"]').val(address);
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/superadmin/schools/index.blade.php ENDPATH**/ ?>