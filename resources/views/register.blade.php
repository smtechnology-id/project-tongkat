<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Register || Tongkat - Tugas Akhir Mahasiswa Teknik Lingkungan Universitas Udayana</title>

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
    <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">

            <form action="{{ route('registerPost') }}" method="post">
                @csrf
                <div class="logo">
                    <a href="{{ route('login') }}">Tongkat</a>
                </div>
                <p class="auth-description">Silahkan isi form dibawah ini untuk mendaftar.<br>Sudah punya akun? <a
                        href="{{ route('login') }}">Masuk</a></p>
                @if (session('success'))
                <div class="alert alert-custom" role="alert">
                    <div class="custom-alert-icon icon-primary"><i class="material-icons-outlined">done</i></div>
                    <div class="alert-content">
                        <span class="alert-title">{{ session('success') }}</span>
                    </div>
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-custom" role="alert">
                    <div class="custom-alert-icon icon-warning"><i class="material-icons-outlined">error</i></div>
                    <div class="alert-content">
                        <span class="alert-title">{{ session('error') }}</span>
                    </div>
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-custom" role="alert">
                    <div class="custom-alert-icon icon-warning"><i class="material-icons-outlined">error</i></div>
                    <div class="alert-content">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="auth-credentials m-b-xxl">
                    <div class="row">
                        <div class="col-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control m-b-md" id="name" aria-describedby="name"
                                placeholder="Name" required>
                        </div>
                        <div class="col-6">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control m-b-md" id="nim" aria-describedby="nim"
                                placeholder="NIM" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="telephone" class="form-label">Telephone</label>
                            <input type="text" name="telephone" class="form-control m-b-md" id="telephone"
                                aria-describedby="telephone" placeholder="Telephone" required>
                        </div>
                        <div class="col-6">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control m-b-md" id="email"
                                aria-describedby="email" placeholder="example@neptune.com" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="signInPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="signInPassword"
                                aria-describedby="signInPassword"
                                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                id="password_confirmation" aria-describedby="password_confirmation"
                                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                        </div>
                    </div>
                </div>

                <div class="auth-submit">
                    <button type="submit" class="btn btn-primary">Register</button>
                    <a href="{{ route('login') }}" class="auth-forgot-password float-end">Sudah punya akun? Masuk</a>
                </div>
                <div class="divider"></div>
            </form>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>