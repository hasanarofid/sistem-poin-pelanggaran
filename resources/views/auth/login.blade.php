<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | Sistem Poin Pelang</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #2A3B8F 0%, #5C2A8F 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        /* Background decorative circle */
        body::before {
            content: '';
            position: absolute;
            top: -200px;
            left: -200px;
            width: 400px;
            height: 400px;
            background: rgba(139, 69, 19, 0.1);
            border-radius: 50%;
            z-index: 1;
        }
        
        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }
        
        .login-card {
            background: #FFFFFF;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4A7BF7 0%, #8A4AF7 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            position: relative;
        }
        
        .logo-icon::before {
            content: '';
            width: 30px;
            height: 30px;
            background: #FFFFFF;
            border-radius: 4px;
            position: relative;
            box-shadow: 0 0 0 2px #FFFFFF;
        }
        
        .logo-icon::after {
            content: '';
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 8px;
            background: #FFFFFF;
            border-radius: 2px 2px 0 0;
        }
        
        .title {
            font-size: 24px;
            font-weight: 700;
            color: #2A3B8F;
            margin-bottom: 8px;
        }
        
        .subtitle {
            font-size: 14px;
            font-weight: 400;
            color: #555555;
            margin-bottom: 15px;
        }
        
        .divider {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #4A7BF7 0%, #8A4AF7 100%);
            margin: 0 auto;
            border-radius: 2px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #555555;
            margin-bottom: 8px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 16px 12px 45px;
            border: 1px solid #E0E0E0;
            border-radius: 12px;
            background: #F5F5F5;
            font-size: 14px;
            color: #333333;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #4A7BF7;
            background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(74, 123, 247, 0.1);
        }
        
        .form-input::placeholder {
            color: #AAAAAA;
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: #AAAAAA;
        }
        
        .login-button {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(90deg, #4A7BF7 0%, #8A4AF7 100%);
            border: none;
            border-radius: 12px;
            color: #FFFFFF;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
        }
        
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 123, 247, 0.3);
        }
        
        .login-button:active {
            transform: translateY(0);
        }
        
        .arrow-icon {
            width: 16px;
            height: 16px;
            background: #FFFFFF;
            border-radius: 2px;
            position: relative;
        }
        
        .arrow-icon::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-30%, -50%);
            width: 0;
            height: 0;
            border-left: 6px solid #4A7BF7;
            border-top: 4px solid transparent;
            border-bottom: 4px solid transparent;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
        }
        
        .copyright {
            font-size: 12px;
            color: #555555;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .form-input.error {
            border-color: #e74c3c;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-icon"></div>
                <h1 class="title">Sistem Poin Pelanggaran</h1>
                <p class="subtitle">SMKN 12 Kabupaten Tangerang</p>
                <div class="divider"></div>
            </div>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <input type="text" 
                               class="form-input @error('username') error @enderror" 
                               name="username" 
                               placeholder="Masukkan username" 
                               value="{{ old('username') }}" 
                               required 
                               autocomplete="username" 
                               autofocus>
                    </div>
                    @error('username')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18,8h-1V6A5,5 0 0,0 12,1A5,5 0 0,0 7,6V8H6A2,2 0 0,0 4,10V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V10A2,2 0 0,0 18,8M12,3A3,3 0 0,1 15,6V8H9V6A3,3 0 0,1 12,3M18,20H6V10H18V20Z"/>
                        </svg>
                        <input type="password" 
                               class="form-input @error('password') error @enderror" 
                               name="password" 
                               placeholder="Masukkan password" 
                               required 
                               autocomplete="current-password">
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="login-button">
                    <span>Masuk</span>
                    <div class="arrow-icon"></div>
                </button>
            </form>
            
            <div class="login-footer">
                <p class="copyright">@2025 Team Kesiswaan</p>
            </div>
        </div>
    </div>
</body>
</html>
