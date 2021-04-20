<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') - Event UKLINE</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('main/plugins/izitoast/dist/css/iziToast.min.css') }}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('main/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/components.css') }}">

    <style>
        .btn-transparent {
            color: #6C757D;
        }

        .exam-card .exam-card-title {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            height: 88px;
            padding: 10px 20px;
        }

        .exam-card .exam-card-title h4 {
            text-overflow: ellipsis;
            overflow: hidden;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            display: -webkit-box;
        }
    </style>
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="index.html" class="navbar-brand sidebar-gone-hide">{{ config('app.name', 'Laravel') }}</a>
                <div class="navbar-nav">
                    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                </div>
                <form class="form-inline ml-auto">
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('main/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->guard(session()->get('role'))->user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('student.profile.index') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profil Peserta
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" onclick="document.getElementById('logoutForm').submit()" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </a>
                            <div class="mt-4 mb-4 p-3 hide-sidebar-mini d-none">
                                <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-lg btn-block btn-icon-split">
                                        <i class="fas fa-rocket"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ request()->is('student') ? 'active' : '' }}">
                            <a href="{{ route('student.index') }}" class="nav-link"><i class="fas fa-home"></i><span>Beranda</span></a>
                        </li>
                        <li class="nav-item {{ request()->is('student/profile') ? 'active' : '' }}">
                            <a href="{{ route('student.profile.index') }}" class="nav-link"><i class="far fa-user"></i><span>Profil Peserta</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Dibuat oleh <a href="https://ukline.id/">UKLINE</a>
                </div>
                <div class="footer-right">
                    1.1.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('main/plugins/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('main/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('main/js/scripts.js') }}"></script>
    <script src="{{ asset('main/js/custom.js') }}"></script>

    @if (session()->has('alert'))
    <script>
        iziToast.error({
            title: 'Peringatan!',
            message: "{{ session()->get('alert') }}",
            position: 'topCenter'
        });
    </script>
    @endif

    @if (session()->has('success'))
    <script>
        iziToast.success({
            title: 'Berhasil!',
            message: "{{ session()->get('success') }}",
            position: 'topCenter'
        });
    </script>
    @endif

    @if (session()->has('exam_finish'))
    <script>
        localStorage.removeItem('exam_storages');
    </script>
    @endif

    @stack('script')
</body>

</html>