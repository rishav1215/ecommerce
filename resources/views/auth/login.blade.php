<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #28a745;
            --primary-dark: #218838;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .login-header h2 {
            font-weight: 700;
            color: var(--dark-color);
        }

        .login-header p {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .form-control {
            height: 45px;
            border-radius: 8px;
            padding-left: 40px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
        }

        .input-group-text {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #6c757d;
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            height: 45px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }

        .social-login .btn {
            height: 40px;
            border-radius: 8px;
            font-weight: 500;
            color: #6c757d;
            border-color: #e0e0e0;
            transition: all 0.3s;
        }

        .social-login .btn:hover {
            background-color: #f8f9fa;
            border-color: var(--primary-color);
            color: var(--primary-dark);
        }

        .login-footer a {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #6c757d;
        }

        small a {
            color: var(--primary-color);
            font-size: 0.85rem;
        }

        small a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Welcome Back</h2>
            <p>Sign in to your account to continue</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3 position-relative">
                <i class="fas fa-envelope input-group-text"></i>
                <input type="email" name="email" class="form-control ps-5" placeholder="Email Address" required>
            </div>
            <div class="mb-3 position-relative">
                <i class="fas fa-lock input-group-text"></i>
                <input type="password" name="password" class="form-control ps-5 " placeholder="Password" required>
                <small class="text-end d-block mt-1">
                    <a href="">Forgot password?</a>
                </small>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>
            </div>
        </form>

        <div class="divider">or continue with</div>

        <div class="social-login mb-4">
            <div class="row g-2">
                <div class="col-6">
                    <button class="btn btn-outline-primary w-100">
                        <i class="fab fa-google me-2"></i> Google
                    </button>
                </div>
                <div class="col-6">
                    <button class="btn btn-outline-primary w-100">
                        <i class="fab fa-facebook-f me-2"></i> Facebook
                    </button>
                </div>
            </div>
        </div>

        <div class="login-footer text-center">
            Don't have an account? <a href="{{ route('register') }}">Register here</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>