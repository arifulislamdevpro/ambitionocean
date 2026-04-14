<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap and AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <!-- Custom PNG Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('image/transparentlogo.png') }}">
    <style>
        .login-side-image {
            /* Beautiful background image from Unsplash */
            background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1200&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
        .bg-overlay {
            background-color: rgba(0, 0, 0, 0.4);
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: white;
            text-align: center;
            padding: 2rem;
        }
        .login-form-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f6f9;
        }
        .login-box-custom {
            width: 100%;
            max-width: 450px;
            padding: 3rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .logo-img {
            max-height: 80px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="hold-transition">
    <div class="row m-0 vh-100">
        <!-- LEFT SIDE IMAGE -->
        <div class="col-md-6 col-lg-7 d-none d-md-block login-side-image p-0">
            <div class="bg-overlay">
                <h1 class="display-4 font-weight-bold">AMBITION OCEAN</h1>
                <p class="lead">Providing the best solutions for your organization.</p>
            </div>
        </div>
        
        <!-- RIGHT SIDE LOGIN FORM -->
        <div class="col-md-6 col-lg-5 p-0 login-form-container">
            <div class="login-box-custom">
                <div class="text-center mb-4">
                    <!-- Your transparent logo -->
                    <img src="{{ asset('image/transparentlogo.png') }}" alt="Logo" class="logo-img">
                    <h3 class="font-weight-bold text-dark">Welcome Back</h3>
                    <p class="text-muted">Sign in to your account</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text bg-white">
                                <span class="fas fa-envelope text-primary"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-4">
                        <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text bg-white">
                                <span class="fas fa-lock text-primary"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row align-items-center mb-4">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label text-muted" for="remember">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm">Forgot Password?</a>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-sm">
                        Sign In <i class="fas fa-sign-in-alt ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
