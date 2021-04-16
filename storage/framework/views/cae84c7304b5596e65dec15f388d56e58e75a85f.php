<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('main/plugins/jqvmap/dist/jqvmap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('main/plugins/izitoast/dist/css/iziToast.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('main/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('main/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css')); ?>">


    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('main/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('main/css/components.css')); ?>">
    <!-- Faq CSS -->
    <link href="<?php echo e(url('main/select2/dist/css/select2.min.css')); ?>" rel="stylesheet"/>

    <style>
        .select2-selection.select2-selection--multiple {
            min-height: 42px;
            border-color: #e4e6fc;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #95a0f4;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="../main/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?php echo e(auth()->guard(session()->get('role'))->user()->name); ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" onclick="document.getElementById('logoutForm').submit()" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html"><?php echo e(config('app.name', 'LARAVEL')); ?></a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html"><?php echo e(config('app.abbr', 'UK')); ?></a>
                    </div>
                    <?php if(session()->get('role') == 'user'): ?>
                        <?php echo $__env->make('components._sidebar_superadmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
                    <?php elseif(session()->get('role') == 'school_admin'): ?>
                        <?php echo $__env->make('components._sidebar_school_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
                    <?php elseif(session()->get('role') == 'question_writer'): ?>
                        <?php echo $__env->make('components._sidebar_question_writer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
                    <?php endif; ?>


                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <form action="<?php echo e(route('logout')); ?>" method="POST" id="logoutForm">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary btn-lg btn-block btn-icon-split">
                                <i class="fas fa-rocket"></i> Keluar
                            </button>
                        </form>
                    </div>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
            <?php echo $__env->yieldContent('content'); ?>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; <?php echo e(date('Y')); ?>

                    <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval
                        Azhar</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>
</body>
<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?php echo e(asset('main/js/stisla.js')); ?>"></script>

<!-- JS Libraies -->
<script src="<?php echo e(asset('main/plugins/chart.js/dist/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('main/plugins/jqvmap/dist/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(asset('main/plugins/jqvmap/dist/maps/jquery.vmap.world.js')); ?>"></script>
<script src="<?php echo e(asset('main/plugins/chocolat/dist/js/jquery.chocolat.min.js')); ?>"></script>
<script src="<?php echo e(asset('main/plugins/izitoast/dist/js/iziToast.min.js')); ?>"></script>
<script src="<?php echo e(asset('main/plugins/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('main/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('main/plugins/datatables.net-select-bs4/js/select.bootstrap4.min.js')); ?>"></script>
<!-- Template JS File -->
<script src="<?php echo e(asset('main/js/scripts.js')); ?>"></script>
<script src="<?php echo e(asset('main/js/custom.js')); ?>"></script>


<!-- Page Specific JS File -->
<script src="<?php echo e(asset('main/js/page/index-0.js')); ?>"></script>

<script src="<?php echo e(url('main/select2/dist/js/select2.min.js')); ?>"></script>

<script>
    $(document).ready(function() {
        if ($(document).find('.js-example-basic-multiple').length > 0) {
            $('.js-example-basic-multiple').select2();
        }
    });

    $(document).ready(function() {
        $('#table-1').DataTable();
    } );
</script>

<?php if(session()->has('alert')): ?>
<script>
    iziToast.error({
        title: 'Peringatan!',
        message: "<?php echo e(session()->get('alert')); ?>",
        position: 'topCenter'
    });
</script>
<?php endif; ?>

<?php if(session()->has('success')): ?>
<script>
    iziToast.success({
        title: 'Berhasil!',
        message: "<?php echo e(session()->get('success')); ?>",
        position: 'topCenter'
    });
</script>
<?php endif; ?>

<?php echo $__env->yieldPushContent('script'); ?>

</html><?php /**PATH /opt/lampp/htdocs/ukline/event-ukline/resources/views/layouts/main.blade.php ENDPATH**/ ?>