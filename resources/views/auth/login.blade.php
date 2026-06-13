<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title>Login | Finance Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('backend/Admin/dist/assets/images/favicon.ico') }}">
    <link href="{{ asset('backend/Admin/dist/assets/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/Admin/dist/assets/css/icons.min.css') }}" rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: system-ui, -apple-system, Segoe UI, Roboto;

            /* FINANCE STYLE BACKGROUND */
            background:
                radial-gradient(circle at 10% 20%, rgba(16, 185, 129, 0.15), transparent 40%),
                radial-gradient(circle at 90% 10%, rgba(59, 130, 246, 0.18), transparent 45%),
                radial-gradient(circle at 50% 90%, rgba(2, 132, 199, 0.12), transparent 50%),
                #0b1220;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        /* FINTECH CARD */
        .login-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.35);
            padding: 32px;
            position: relative;
            overflow: hidden;
        }

        /* subtle grid pattern */
        .login-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.03) 1px, transparent 1px);
            background-size: 24px 24px;
            opacity: 0.4;
            pointer-events: none;
        }

        .content {
            position: relative;
        }

        .logo {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .subtitle {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 22px;
        }

        .form-group {
            position: relative;
            margin-bottom: 14px;
        }

        .form-control {
            border-radius: 14px;
            padding: 12px 14px 12px 42px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
            background: #fff;
        }

        .icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            color: #94a3b8;
        }

        .btn-login {
            border-radius: 14px;
            padding: 12px;
            font-weight: 700;
            border: none;

            background: linear-gradient(135deg, #10b981, #059669);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.25);
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(16, 185, 129, 0.35);
        }

        .top-badge {
            display: inline-block;
            font-size: 11px;
            background: rgba(16, 185, 129, 0.12);
            color: #059669;
            padding: 5px 10px;
            border-radius: 999px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .footer-text {
            margin-top: 14px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.8);
        }

        .footer-text a {
            color: #34d399;
            font-weight: 600;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <div class="login-card">

            <div class="content">

                <!-- HEADER -->
                <div class="text-center">
                    <div class="top-badge">Secure Finance Access</div>
                    <img src="{{ asset('backend/Admin/dist/assets/images/logo-sm.png') }}" class="logo"
                        alt="logo">
                    <h2 class="title">Finance Login</h2>
                    <p class="subtitle">Access your financial dashboard securely</p>
                </div>

                <!-- ERROR -->
                @if ($errors->any())
                    <div class="alert alert-danger rounded-3">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- FORM -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="form-group">
                        <span class="icon">📧</span>
                        <input type="email" name="email" class="form-control" placeholder="Email address"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <span class="icon">🔒</span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">

                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-login w-100 text-white">
                        Access Dashboard
                    </button>
                </form>
            </div>

        </div>

        <div class="text-center footer-text">
            Secure system for financial management platform
        </div>

    </div>

</body>

</html>
