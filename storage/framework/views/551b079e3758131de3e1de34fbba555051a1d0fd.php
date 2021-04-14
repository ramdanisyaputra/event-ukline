<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Regensi</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Regensi</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Regensi</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaRegen"><i class="fa fa-plus"></i> Tambah Regensi</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Regensi</th>
                                <th>Pronvisi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $regencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $regency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($regency->regency_code); ?></td>
                                <td><?php echo e($regency->name); ?></td>
                                <td><?php echo e($regency->province->name); ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editRegen" data-id="<?php echo e($regency->id); ?>" data-name="<?php echo e($regency->name); ?>" data-province="<?php echo e($regency->province_id); ?>" data-regency-code="<?php echo e($regency->regency_code); ?>"><i class="fas fa-pencil-alt"></i></button>
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

<div class="modal fade" id="kelolaRegen" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('superadmin.regencies.store')); ?>" method="POST" id="formKelolaRegen">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Regensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Regensi</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Contoh: Kota Bekasi atau Kabupaten Bekasi">
                    </div>
                    <div class="form-group">
                        <label for="regency_code">Kode Regensi</label>
                        <input type="text" class="form-control" id="regency_code" name="regency_code" required>
                    </div>
                    <div class="form-group">
                        <label for="province_id">Provinsi</label>
                        <select name="province_id" id="province_id" class="custom-select" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($province->id); ?>"><?php echo e($province->name); ?></option>
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

<div class="modal fade" id="editRegen" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('superadmin.regencies.update')); ?>" method="POST" id="formKelolaRegen">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Regensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Regensi</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Contoh: Kota Bekasi atau Kabupaten Bekasi">
                    </div>
                    <div class="form-group">
                        <label for="regency_code">Kode Regensi</label>
                        <input type="text" class="form-control" id="regency_code" name="regency_code" required>
                    </div>
                    <div class="form-group">
                        <label for="province_id">Provinsi</label>
                        <select name="province_id" id="province_id" class="custom-select" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($province->id); ?>"><?php echo e($province->name); ?></option>
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
    $('#editRegen').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var regencyCode= $(e.relatedTarget).data('regency-code');
        var provinceId = $(e.relatedTarget).data('province');

        $('#editRegen').find('input[name="id"]').val(id);
        $('#editRegen').find('input[name="name"]').val(name);
        $('#editRegen').find('input[name="regency_code"]').val(regencyCode);
        $('#editRegen').find('select[name="province_id"]').val(provinceId);
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/ukline/event-ukline/resources/views/superadmin/regencies/index.blade.php ENDPATH**/ ?>