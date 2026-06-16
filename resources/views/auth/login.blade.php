<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | Finance Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('backend/Admin/dist/assets/images/logo.png') }}">
    <link href="{{ asset('backend/Admin/dist/assets/css/style.min.css') }}" rel="stylesheet">

    <style>
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --text: #0f172a;
        --muted: #64748b;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;

        background:
            radial-gradient(circle at 20% 20%, rgba(16, 185, 129, 0.25), transparent 40%),
            radial-gradient(circle at 80% 30%, rgba(59, 130, 246, 0.25), transparent 45%),
            radial-gradient(circle at 50% 90%, rgba(99, 102, 241, 0.15), transparent 50%),
            #0b1220;
    }

    /* FLOATING LIGHTS */
    body::before,
    body::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        filter: blur(90px);
        opacity: 0.4;
        z-index: 0;
        animation: floatGlow 8s ease-in-out infinite;
    }

    body::before {
        background: #10b981;
        top: 10%;
        left: 10%;
    }

    body::after {
        background: #3b82f6;
        bottom: 10%;
        right: 10%;
        animation-delay: 2s;
    }

    @keyframes floatGlow {

        0%,
        100% {
            transform: translateY(0px) scale(1);
        }

        50% {
            transform: translateY(-20px) scale(1.1);
        }
    }

    /* WRAPPER ANIMATION */
    .auth-wrapper {
        width: 100%;
        max-width: 420px;
        padding: 20px;
        z-index: 2;

        animation: fadeUp 0.8s ease forwards;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.96);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* CARD 3D */
    .auth-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border-radius: 22px;
        padding: 36px;
        position: relative;
        overflow: hidden;

        box-shadow:
            0 40px 90px rgba(0, 0, 0, 0.45),
            inset 0 1px 0 rgba(255, 255, 255, 0.5);

        transition: 0.3s ease;
    }

    .auth-card:hover {
        transform: translateY(-6px) rotateX(2deg) rotateY(-2deg);
        box-shadow:
            0 60px 120px rgba(0, 0, 0, 0.5);
    }

    /* subtle grid */
    .auth-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(to right, rgba(0, 0, 0, 0.03) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(0, 0, 0, 0.03) 1px, transparent 1px);
        background-size: 26px 26px;
        opacity: 0.25;
        pointer-events: none;
    }

    .content {
        position: relative;
    }

    /* HEADER ANIMATION */
    .badge {
        display: inline-block;
        font-size: 11px;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(16, 185, 129, 0.15);
        color: var(--primary-dark);
        font-weight: 700;

        animation: pop 0.6s ease;
    }

    @keyframes pop {
        from {
            transform: scale(0.8);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    h1 {
        margin: 0;
        font-size: 26px;
        font-weight: 900;
        color: var(--text);

        animation: fadeIn 0.7s ease;
    }

    .subtitle {
        margin: 6px 0 22px;
        font-size: 13px;
        color: var(--muted);

        animation: fadeIn 0.9s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ALERT */
    .alert {
        background: rgba(239, 68, 68, 0.12);
        color: #991b1b;
        padding: 10px 12px;
        border-radius: 12px;
        font-size: 13px;
        margin-bottom: 14px;
        animation: shake 0.4s ease;
    }

    @keyframes shake {
        0% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-4px);
        }

        50% {
            transform: translateX(4px);
        }

        75% {
            transform: translateX(-2px);
        }

        100% {
            transform: translateX(0);
        }
    }

    /* INPUT */
    .group {
        margin-bottom: 14px;
    }

    .input {
        width: 100%;
        padding: 14px;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        font-size: 14px;
        outline: none;
        transition: 0.25s ease;
        background: #fff;
    }

    .input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        transform: scale(1.02);
    }

    /* META */
    .meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        color: var(--muted);
        margin-bottom: 16px;
    }

    /* BUTTON + RIPPLE */
    .btn {
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 14px;
        font-weight: 800;
        color: #fff;
        cursor: pointer;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));

        position: relative;
        overflow: hidden;

        transition: 0.25s ease;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 40px rgba(16, 185, 129, 0.35);
    }

    .btn:active {
        transform: scale(0.97);
    }

    /* ripple */
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transform: scale(0);
        animation: ripple 0.6s linear;
    }

    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    </style>
</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-card">

            <div class="content">

                <div class="badge">Secure Finance System</div>
                <h1>Welcome back</h1>
                <div class="subtitle">Sign in to continue dashboard</div>

                @if ($errors->any())
                <div class="alert">
                    {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="group">
                        <input type="email" name="email" class="input" placeholder="Email address" required>
                    </div>

                    <div class="group">
                        <input type="password" name="password" class="input" placeholder="Password" required>
                    </div>

                    <div class="meta">
                        <label>
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn" id="btn">
                        Sign in
                    </button>

                </form>

            </div>

        </div>
    </div>

    <!-- RIPPLE SCRIPT -->
    <script>
    const btn = document.getElementById("btn");

    btn.addEventListener("click", function(e) {
        const circle = document.createElement("span");
        circle.classList.add("ripple");

        const rect = this.getBoundingClientRect();
        circle.style.left = (e.clientX - rect.left) + "px";
        circle.style.top = (e.clientY - rect.top) + "px";

        this.appendChild(circle);

        setTimeout(() => circle.remove(), 600);
    });
    </script>

</body>

</html>