<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Tambah Ujian Serentak</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo e(route('school_admin.index')); ?>">Beranda</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo e(route('school_admin.exams.index')); ?>">Kumpulan Ujian</a></div>
            <div class="breadcrumb-item">Tambah Ujian Serentak</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Ujian Serentak</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Pilih Ujian</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="" id="" class="custom-select">

                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Mata Pelajaran</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="" id="" class="custom-select">

                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Kelas yang diizinkan</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="" id="" class="custom-select">

                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/ukline/event-ukline/resources/views/school_admin/exams/create_public.blade.php ENDPATH**/ ?>