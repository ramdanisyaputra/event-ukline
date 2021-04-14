

<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Master Kelas</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Master Kelas</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Master Kelas</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaMasterKelas"><i class="fa fa-plus"></i> Tambah Master Kelas</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Number</th>
                                <th>Roman</th>
                                <th>Tingkat Pendidikan</th>
                                <th>Tahun Ajaran</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($grade->id); ?></td>
                                <td><?php echo e($grade->number); ?></td>
                                <td><?php echo e($grade->roman); ?></td>
                                <td><?php echo e($grade->educationLevel->name); ?></td>
                                <td><?php echo e($grade->school_year); ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editGrade" data-id="<?php echo e($grade->id); ?>" data-number="<?php echo e($grade->number); ?>" data-roman="<?php echo e($grade->roman); ?>" data-education-level="<?php echo e($grade->education_level_id); ?>" data-school-year="<?php echo e($grade->school_year); ?>"><i class="fas fa-pencil-alt"></i></button>
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

<div class="modal fade" id="kelolaMasterKelas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('superadmin.grades.store')); ?>" method="POST" id="formKelolaProvince">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Master Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="number">Nomor Kelas</label>
                        <input type="number" class="form-control" id="number" name="number" required placeholder="Contoh: 1,2,3,4,5,6,7,8,9,10,11,12">
                    </div>
                    <div class="form-group">
                        <label for="roman">Romawi Kelas</label>
                        <input type="text" class="form-control" id="roman" name="roman" required>
                    </div>
                    <div class="form-group">
                        <label for="school_year">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="school_year" name="school_year" required>
                    </div>
                    <div class="form-group">
                        <label for="education_level_id">Tingkat Pendidikan</label>
                        <select name="education_level_id" id="education_level_id" class="custom-select" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $educationLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $educationLevel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($educationLevel->id); ?>"><?php echo e($educationLevel->name); ?></option>
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

<div class="modal fade" id="editGrade" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('superadmin.grades.update')); ?>" method="POST" id="formKelolaProvince">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Master Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label for="number">Nomor Kelas</label>
                        <input type="number" class="form-control" id="number" name="number" required placeholder="Contoh: 1,2,3,4,5,6,7,8,9,10,11,12">
                    </div>
                    <div class="form-group">
                        <label for="roman">Romawi Kelas</label>
                        <input type="text" class="form-control" id="roman" name="roman" required>
                    </div>
                    <div class="form-group">
                        <label for="school_year">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="school_year" name="school_year" required>
                    </div>
                    <div class="form-group">
                        <label for="education_level_id">Tingkat Pendidikan</label>
                        <select name="education_level_id" id="education_level_id" class="custom-select" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $educationLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $educationLevel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($educationLevel->id); ?>"><?php echo e($educationLevel->name); ?></option>
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
    $('#editGrade').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var number = $(e.relatedTarget).data('number');
        var roman = $(e.relatedTarget).data('roman');
        var educationLevelId = $(e.relatedTarget).data('education-level');
        var school_year= $(e.relatedTarget).data('school-year');

        $('#editGrade').find('input[name="id"]').val(id);
        $('#editGrade').find('input[name="number"]').val(number);
        $('#editGrade').find('input[name="roman"]').val(roman);
        $('#editGrade').find('select[name="education_level_id"]').val(educationLevelId);
        $('#editGrade').find('input[name="school_year"]').val(school_year);
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/superadmin/grades/index.blade.php ENDPATH**/ ?>