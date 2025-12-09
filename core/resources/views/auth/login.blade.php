<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Premium Bootstrap 5 Landing Page Template">
    <meta name="keywords" content="Saas, Software, multi-uses, HTML, Clean, Modern">
    <meta name="author" content="Shreethemes">
    <meta name="email" content="support@shreethemes.in">
    <meta name="website" content="https://shreethemes.in">
    <meta name="Version" content="v5.0.0">
    <title>{{ __('backend.signedInToControl') }}</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/libs/tiny-slider/tiny-slider.css" rel="stylesheet">
    <link href="assets/libs/tobii/css/tobii.min.css" rel="stylesheet">
    <link href="assets/libs/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-green.min.css" id="bootstrap-style" class="theme-opt" rel="stylesheet" type="text/css">
    <link href="assets/css/style-green.min.css" id="color-opt" class="theme-opt" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .container-btn {
            width: 50px !important;
            height: 50px !important;
            align-items: center;
            justify-content: center;
            display: flex !important;
            padding: 0px !important;
        }

        /* handle variable */
        :root {
            --primary-color: #3164F5;
        }

        .back-to-home {
            position: fixed;
            z-index: 9999;
            display: flex;
            align-items: start;
            top: 20px;
            right: 20px;
            gap: 5px;
        }

        .registration-page-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .registration-container {
            min-height: 100vh;
            background: #F9F9F9 !important;
            display: flex;
            align-items: center;
            justify-content: start;
            width: 38%;
        }

        .registration-card {
            background: #f8cb25;
            overflow: hidden;
            max-width: 600px;
            width: 100%;
            height: auto;
            z-index: 3;
            min-height: 100vh;
        }

        .container-img {
            width: 64%;
            position: relative;
        }

        .reg-bg {
            height: 100vh;
            width: 100%;
            object-fit: cover;
        }

        .container-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .step-content {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            text-align: center !important;
            display: flex;
            justify-content: center;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 17px;
            transition: all 0.3s ease;
            text-align: center;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(49, 100, 245, 0.25);
            outline: none;
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-floating > label {
            text-align: center !important;
            width: 100%;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(49, 100, 245, 0.4);
        }

        .btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .alert {
            border-radius: 10px;
            border: none;
            margin-top: 15px;
        }

        .loading {
            display: none;
        }

        .loading.show {
            display: inline-block;
        }

        .text-center h5 {
            color: #333;
            font-weight: 700;
        }

        .text-muted {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="back-to-home">
        <a href="{{ getBackendPath() }}" class="container-btn btn btn-icon btn-primary">
            <i class="fa fa-home" aria-hidden="true" style="font-size: 21px;"></i>
        </a>
        <div>
            @if (app()->getLocale() == 'en' || !in_array(request()->segment(1), ['ar', 'en']))
                <li class="d-grid">
                    <a href="/ar/tenant/register" class="container-btn btn btn-icon btn-primary" onclick="setTheme('style-rtl')">
                        <i class="fa fa-earth" aria-hidden="true" style="font-size: 21px;"></i>
                    </a>
                </li>
            @else
                <li class="d-grid">
                    <a href="/en/tenant/register" class="container-btn btn btn-icon btn-primary" onclick="setTheme('style')">
                        <i class="fa fa-earth" aria-hidden="true" style="font-size: 21px;"></i>
                    </a>
                </li>
            @endif
        </div>
        <div>
            <button class="btn btn-icon btn-primary" onclick="setTheme('style')">المطورون</button>
        </div>
    </div>

    <div class="registration-page-container">
        <div class="registration-container">
            <div class="registration-card">
                <a href="{{ getBackendPath() }}">
                    <img src="{{ asset('assets/dashboard/images/logo-taif.png') }}"
                        style="text-align: center;
                        width: 250px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: auto;
                        margin-top: 77px;"
                        alt="Logo">
                </a>
                
                <div class="step-content">
                    <div class="text-center mb-4" style="padding-top: 43px">
                        <h5 class="mb-3">{{ __('backend.signedInToControl') }}</h5>
                        <p class="text-muted">أدخل بيانات تسجيل الدخول للوصول إلى حسابك</p>
                    </div>

                    <form id="login-form" method="POST" action="{{ url('/' . getBackendPath() . '/login') }}">
                        @csrf
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-floating">
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="{{ __('backend.connectEmail') }}" 
                                   required 
                                   autofocus>
                            <label for="email">{{ __('backend.connectEmail') }}</label>
                        </div>

                        <div class="form-floating">
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="{{ __('backend.connectPassword') }}" 
                                   required>
                            <label for="password">{{ __('backend.connectPassword') }}</label>
                        </div>

                        @if (config('smartend.nocaptcha_status'))
                            <div class="form-group">
                                {!! NoCaptcha::renderJs(@Helper::currentLanguage()->code) !!}
                                {!! NoCaptcha::display() !!}
                            </div>
                        @endif

                        <div class="mb-3 text-center">
                            <label class="form-check-label">
                                <input type="checkbox" name="remember" class="form-check-input"> 
                                {{ __('backend.keepMeSignedIn') }}
                            </label>
                        </div>

                        <div class="alert alert-danger" id="login-error" style="display: none;"></div>

                        <button class="btn btn-primary w-100" style="margin-top: 20px;" type="submit" id="login-submit">
                            <span class="loading" id="login-loading">
                                <i class="fas fa-spinner fa-spin"></i> {{ __('tenant_registration.loading') }}...
                            </span>
                            <span id="login-text">{{ __('backend.signIn') }}</span>
                        </button>
                    </form>

                    @if (Helper::GeneralWebmasterSettings('register_status'))
                        <div class="text-center mt-3">
                            <a href="{{ url('/' . getBackendPath() . '/register') }}" class="text-primary">
                                <i class="fa fa-user-plus"></i> {{ __('backend.createNewAccount') }}
                            </a>
                        </div>
                    @endif

                    @if (config('smartend.mail_driver') != '' && config('smartend.mail_username') != '' && config('smartend.mail_password'))
                        <div class="text-center mt-3">
                            <a href="{{ url('/' . getBackendPath() . '/password/reset') }}" class="text-primary">
                                {{ __('backend.forgotPassword') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="container-img">
            <img src="{{ asset('assets/dashboard/images/gif44.gif') }}" class="reg-bg" alt="">
            <div class="container-text">
                <img style="width: 150px;" src="{{ asset('assets/image/white-logo.png') }}" alt="">
                <div style="display: flex; flex-direction: column;">
                    <span style="color: white; font-size: 19px;">{{ __('tenant_registration.login-word') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- javascript -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <!-- Main Js -->
    <script src="{{ asset('assets/js/plugins.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('login-form');
            const loginSubmit = document.getElementById('login-submit');
            const loginLoading = document.getElementById('login-loading');
            const loginText = document.getElementById('login-text');
            const loginError = document.getElementById('login-error');

            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    // Hide previous errors
                    loginError.style.display = 'none';
                    
                    // Show loading state
                    loginSubmit.disabled = true;
                    loginLoading.classList.add('show');
                    loginText.style.display = 'none';
                });
            }
        });
    </script>
</body>

</html>
