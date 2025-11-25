@extends('frontend.app')

@section('title', 'Home')

@section('content')
<style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 3rem;
            margin-top: 10%;
        }
        .btn-custom {
            padding: 15px 30px;
            font-size: 1.1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }
</style>

<div class="container d-flex align-items-center justify-content-center h-100">
    <div class="login-container">
        <h1 class="text-center mb-4">Welcome</h1>
        <p class="text-center text-muted mb-5">Please select your login type</p>
        
        <div class="d-grid gap-3">
            <a href="#" class="btn btn-primary btn-custom">
                <i class="bi bi-person"></i> Employee Login
            </a>
            <a href="{{ route('login') }}" class="btn btn-success btn-custom">
                <i class="bi bi-shield-lock"></i> Administrative Login
            </a>
        </div>
    </div>
</div>

@endsection