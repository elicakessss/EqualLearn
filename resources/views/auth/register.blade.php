<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EqualLearn') }} - Sign Up</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="cache-bust" content="{{ time() }}" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&family=Bubblegum+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #ffd5de 0%, #d0e6fa 40%, #d0f7d6 70%, #fff7c2 100%);
            background-attachment: fixed;
        }

        .main-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .content-wrapper {
            display: flex;
            max-width: 1200px;
            width: 100%;
            gap: 4rem;
            align-items: center;
        }

        /* Left Side - Marketing Content */
        .hero-section {
            flex: 1;
            max-width: 580px;
        }

        .brand-logo {
            font-family: 'Bubblegum Sans', cursive;
            font-size: 4rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ff6b9d 0%, #ffc3a0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            line-height: 1;
            text-shadow: 2px 2px 0 rgba(255, 255, 255, 0.3);
        }

        .hero-headline {
            font-size: 1.75rem;
            font-weight: 400;
            color: #1c1e21;
            line-height: 1.3;
            margin-bottom: 2rem;
        }

        .hero-description {
            font-size: 1.1rem;
            color: #606770;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 2rem;
        }

        .feature-card {
            background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 100%);
            border-radius: 20px;
            box-shadow: 0 6px 24px 0 rgba(254, 138, 139, 0.08), 0 1px 6px 0 rgba(208, 230, 250, 0.10);
            border: 1.5px solid #f6e6e6;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.18s cubic-bezier(.4,2,.6,1), box-shadow 0.18s;
        }

        .feature-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 12px 32px 0 rgba(254, 138, 139, 0.14), 0 2px 10px 0 rgba(208, 230, 250, 0.12);
        }

        .feature-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .feature-title {
            font-weight: 600;
            color: #1c1e21;
            margin-bottom: 0.25rem;
        }

        .feature-text {
            font-size: 0.9rem;
            color: #65676b;
        }

        /* Right Side - Register Form */
        .register-section {
            flex: 0 0 400px;
        }

        .register-form {
            background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 100%);
            border-radius: 28px;
            box-shadow: 0 8px 32px 0 rgba(254, 138, 139, 0.08), 0 1.5px 8px 0 rgba(208, 230, 250, 0.10);
            border: 1.5px solid #f6e6e6;
            padding: 32px 28px 28px 28px;
            width: 100%;
            transition: transform 0.18s cubic-bezier(.4,2,.6,1), box-shadow 0.18s;
        }

        .register-form:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 12px 32px 0 rgba(254, 138, 139, 0.14), 0 2px 10px 0 rgba(208, 230, 250, 0.12);
        }

        .form-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: #1c1e21;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #606770;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 1.1rem;
        }

        .form-group label {
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            color: #fe8a8b;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            border: 1.5px solid #ffd5de;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 1rem;
            background: #fff;
            color: #fe8a8b;
            font-weight: 600;
            font-family: 'Quicksand', sans-serif;
            transition: border 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border: 1.5px solid #fe8a8b;
            outline: none;
        }

        .form-group input::placeholder {
            color: #fe8a8b;
            opacity: 0.8;
        }

        .form-group select {
            color: #fe8a8b;
            font-weight: 600;
        }

        .signup-btn {
            background: linear-gradient(90deg, #42b883 0%, #a8e6cf 100%);
            color: #fff;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1.1rem;
            width: 100%;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px 0 rgba(66, 184, 131, 0.10);
            transition: background 0.2s, color 0.2s;
            cursor: pointer;
        }

        .signup-btn:hover {
            background: linear-gradient(90deg, #a8e6cf 0%, #42b883 100%);
            color: #42b883;
        }
        }

        .terms-text {
            font-size: 11px;
            color: #777;
            line-height: 1.3;
            margin: 1rem 0;
            text-align: center;
        }

        .divider {
            border-top: 1px solid #dadde1;
            margin: 1.5rem 0;
        }

        .login-link {
            text-align: center;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 17px;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert {
            background: #fee;
            color: #c33;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 1rem;
            border: 1px solid #fcc;
            font-size: 14px;
        }

        .alert ul {
            list-style: none;
            margin: 0;
        }

        .text-danger {
            color: #c33;
            font-size: 14px;
            margin-top: 0.25rem;
        }

        /* Responsive Design */
        @media (max-width: 980px) {
            .content-wrapper {
                flex-direction: column;
                gap: 2rem;
                text-align: center;
            }
            
            .hero-section {
                max-width: 400px;
            }
            
            .brand-logo {
                font-size: 3rem;
            }
            
            .hero-headline {
                font-size: 1.5rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .register-section {
                flex: none;
                max-width: 400px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="content-wrapper">
            <!-- Left Side - Marketing Content -->
            <div class="hero-section">
                <h1 class="brand-logo">EqualLearn</h1>
                <h2 class="hero-headline">Connect with learners and expand your knowledge around the world.</h2>
                <p class="hero-description">
                    EqualLearn helps you connect and share educational content with the people in your learning community.
                </p>
                
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">📚</div>
                        <div class="feature-title">Learning Materials</div>
                        <div class="feature-text">Access educational content worldwide</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🎯</div>
                        <div class="feature-title">Easy Access</div>
                        <div class="feature-text">Quick access to learning materials</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🌍</div>
                        <div class="feature-title">Global Community</div>
                        <div class="feature-text">Connect with learners worldwide</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <div class="feature-title">Quality Content</div>
                        <div class="feature-text">Access premium educational materials<br><span style="color: #ff6b9d; font-weight: 600; font-size: 0.8rem;">Coming Soon!</span></div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Register Form -->
            <div class="register-section">
                <div class="register-form">
                    <div class="form-header">
                        <h2>Sign Up</h2>
                        <p>It's quick and easy.</p>
                    </div>

                    @if($errors->any())
                        <div class="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input id="name" name="name" type="text" required value="{{ old('name') }}" placeholder="Enter your full name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}" placeholder="Enter your email address">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" required placeholder="Create a password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="Confirm your password">
                        </div>

                        <div class="form-group">
                            <label for="role">Account Type</label>
                            <select id="role" name="role" required>
                                <option value="">Choose your role...</option>
                                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                                <option value="creator" {{ old('role') == 'creator' ? 'selected' : '' }}>Creator</option>
                            </select>
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="signup-btn">Sign Up</button>
                    </form>

                    <div class="divider"></div>

                    <div class="login-link">
                        <a href="{{ route('welcome') }}">Already have an account?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
