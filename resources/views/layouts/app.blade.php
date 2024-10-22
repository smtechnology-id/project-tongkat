<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="SISTEM INFORMASI TONGKAT - Tugas Akhir Mahasiswa Teknik Lingkungan Universitas Udayana">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>DASHBOARD || Tongkat</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/pace/pace.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>


    <!-- Theme Styles -->
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <link rel="icon" type="{{ asset('assets/images/logo-udayana.png') }}" sizes="32x32"
        href="{{ asset('assets/images/logo-udayana.png') }}" />
    <link rel="icon" type="{{ asset('assets/images/logo-udayana.png') }}" sizes="16x16"
        href="{{ asset('assets/images/logo-udayana.png') }}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <div class="app-sidebar">
            <div class="logo">
                <a href="" class="logo-icon"><span class="logo-text">Tongkat</span></a>
                <div class="sidebar-user-switcher user-activity-online">
                    <a href="#">

                        <img src="{{ asset('assets/images/user.png') }}">

                        <span class="activity-indicator"></span>
                        <span class="user-info-text">{{ Auth::user()->name }}<br><span class="user-state-info">
                                @if (Auth::user()->role == 'admin')
                                Administrator
                                @elseif (Auth::user()->role == 'user')
                                Mahasiswa
                                @endif
                            </span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="app-menu">
                <ul class="accordion-menu">
                    <li class="sidebar-title">
                        Tongkat
                    </li>
                    @if (Auth::user()->role == 'admin')
                    <li class="@yield('active_dashboard')">
                        <a href="{{ route('admin.dashboard') }}" class="active"><i
                                class="material-icons-two-tone">dashboard</i>Dashboard</a>
                    </li>
                    {{-- 
                    <li class="@yield('active_data_setting')">
                        <a href="#"><i class="material-icons-two-tone">settings</i>Setting<i
                                class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('admin.sekolah') }}">Data Sekolah</a>
                                <a href="{{ route('admin.kelas') }}">Data Kelas</a>
                                <a href="{{ route('admin.jadwal') }}">Data Jadwal Laporan</a>
                                <a href="{{ route('admin.standart_hb') }}">Standart Hb</a>
                            </li>
                        </ul>
                    </li> --}}
                    <li class="sidebar-title">
                        Data User (Mahasiswa)
                    </li>
                    <li class="@yield('active_user')">
                        <a href="{{ route('admin.user') }}" class="active"><i
                                class="material-icons-two-tone">people</i>Account Mahasiswa</a>
                    </li>


                    @elseif (Auth::user()->role == 'user')
                    <li class="@yield('active_dashboard')">
                        <a href="{{ route('user.dashboard') }}" class="active"><i
                                class="material-icons-two-tone">dashboard</i>Dashboard</a>
                    </li>
                    <li class="@yield('active_proposal')">
                        <a href="{{ route('user.proposal') }}" class="active"><i
                                class="material-icons-two-tone">dashboard</i>Proposal</a>
                    </li>
                    
                    @endif


                    <li class="sidebar-title">
                        Account
                    </li>
                    <li class="@yiend('active')">
                        <a href="{{ route('logout') }}" class="active"><i
                                class="material-icons-two-tone">logout</i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="app-container">
            <div class="search">
                <form>
                    <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
                </form>
                <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
            </div>
            <div class="app-header">
                <nav class="navbar navbar-light navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="navbar-nav" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link hide-sidebar-toggle-button" href="#"><i
                                            class="material-icons">first_page</i></a>
                                </li>
                                <li class="nav-item dropdown hidden-on-mobile">
                                    <a class="nav-link dropdown-toggle" href="#" id="addDropdownLink" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="material-icons">add</i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="addDropdownLink">
                                        @if (Auth::user()->level == 'admin')
                                        <li><a class="dropdown-item" href="#">New Account Duta Belia</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">New Account Guru</a></li>
                                        <li><a class="dropdown-item" href="#">New Account Puskesmas</a></li>
                                        @elseif(Auth::user()->level == 'duta')
                                        <li><a class="dropdown-item" href="#">New Data Siswa</a></li>
                                        <li><a class="dropdown-item" href="#">New Laporan</a></li>
                                        @endif

                                    </ul>
                                </li>

                            </ul>

                        </div>
                        <div class="d-flex">
                            <ul class="navbar-nav">

                                {{-- <li class="nav-item hidden-on-mobile">
                                    <a class="nav-link nav-notifications-toggle" id="notificationsDropDown" href="#"
                                        data-bs-toggle="dropdown">4</a>
                                    <div class="dropdown-menu dropdown-menu-end notifications-dropdown"
                                        aria-labelledby="notificationsDropDown">
                                        <h6 class="dropdown-header">Notifications</h6>
                                        <div class="notifications-dropdown-list">
                                            <a href="#">
                                                <div class="notifications-dropdown-item">
                                                    <div class="notifications-dropdown-item-image">
                                                        <span class="notifications-badge bg-info text-white">
                                                            <i class="material-icons-outlined">campaign</i>
                                                        </span>
                                                    </div>
                                                    <div class="notifications-dropdown-item-text">
                                                        <p class="bold-notifications-text">Donec tempus nisi sed erat
                                                            vestibulum, eu suscipit ex laoreet</p>
                                                        <small>19:00</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notifications-dropdown-item">
                                                    <div class="notifications-dropdown-item-image">
                                                        <span class="notifications-badge bg-danger text-white">
                                                            <i class="material-icons-outlined">bolt</i>
                                                        </span>
                                                    </div>
                                                    <div class="notifications-dropdown-item-text">
                                                        <p class="bold-notifications-text">Quisque ligula dui,
                                                            tincidunt nec pharetra eu, fringilla quis mauris</p>
                                                        <small>18:00</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notifications-dropdown-item">
                                                    <div class="notifications-dropdown-item-image">
                                                        <span class="notifications-badge bg-success text-white">
                                                            <i class="material-icons-outlined">alternate_email</i>
                                                        </span>
                                                    </div>
                                                    <div class="notifications-dropdown-item-text">
                                                        <p>Nulla id libero mattis justo euismod congue in et metus</p>
                                                        <small>yesterday</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notifications-dropdown-item">
                                                    <div class="notifications-dropdown-item-image">
                                                        <span class="notifications-badge">
                                                            <img src="{{ asset('assets/images/avatars/avatar.png') }}"
                                                                alt="">
                                                        </span>
                                                    </div>
                                                    <div class="notifications-dropdown-item-text">
                                                        <p>Praesent sodales lobortis velit ac pellentesque</p>
                                                        <small>yesterday</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notifications-dropdown-item">
                                                    <div class="notifications-dropdown-item-image">
                                                        <span class="notifications-badge">
                                                            <img src="{{ asset('assets/images/avatars/avatar.png') }}"
                                                                alt="">
                                                        </span>
                                                    </div>
                                                    <div class="notifications-dropdown-item-text">
                                                        <p>Praesent lacinia ante eget tristique mattis. Nam sollicitudin
                                                            velit sit amet auctor porta</p>
                                                        <small>yesterday</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li> --}}
                                <li class="nav-item hidden-on-mobile">
                                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="page-description">
                                    <h1>@yield('page_name')</h1>
                                </div>
                            </div>
                        </div>
                        @if (session('success'))
                        <div class="alert alert-custom" role="alert">
                            <div class="custom-alert-icon icon-primary"><i class="material-icons-outlined">done</i>
                            </div>
                            <div class="alert-content">
                                <span class="alert-title">{{ session('success') }}</span>
                            </div>
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-custom" role="alert">
                            <div class="custom-alert-icon icon-warning"><i class="material-icons-outlined">error</i>
                            </div>
                            <div class="alert-content">
                                <span class="alert-title">{{ session('error') }}</span>
                            </div>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-custom" role="alert">
                            <div class="custom-alert-icon icon-warning"><i class="material-icons-outlined">error</i>
                            </div>
                            <div class="alert-content">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('popup'))
    <script>
        alert("{{ session('success') }}");
    </script>
    @endif

    <!-- Javascripts -->
    <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
</body>

</html>