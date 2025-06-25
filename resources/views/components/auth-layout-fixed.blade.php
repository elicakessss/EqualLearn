<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EqualLearn') }}</title>
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
            background: #f0f2f5;
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
            color: #667eea;
            margin-bottom: 1rem;
            line-height: 1;
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
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
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

        /* Right Side - Login Form */
        .login-section {
            flex: 0 0 400px;
        }

        .login-form {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
        }        .login-form {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #dddfe2;
            border-radius: 6px;
            font-size: 17px;
            line-height: 16px;
            background: #f5f6f7;
            color: #1c1e21;
            transition: all 0.2s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2);
        }

        .form-group input::placeholder {
            color: #8a8d91;
            font-size: 17px;
        }

        .login-btn {
            width: 100%;
            padding: 12px 16px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 20px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-bottom: 1rem;
        }

        .login-btn:hover {
            background: #5a6fd8;
        }

        .forgot-password {
            text-align: center;
            margin: 1rem 0;
        }

        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .divider {
            border-top: 1px solid #dadde1;
            margin: 1.5rem 0;
        }

        .create-account-btn {
            display: block;
            width: auto;
            margin: 0 auto;
            padding: 12px 24px;
            background: #42b883;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 17px;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .create-account-btn:hover {
            background: #369870;
        }

        .footer-text {
            text-align: center;
            margin-top: 2rem;
            font-size: 14px;
            color: #65676b;
        }

        .footer-text a {
            color: #667eea;
            text-decoration: none;
        }

        .footer-text a:hover {
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
            
            .login-section {
                flex: none;
                max-width: 400px;
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .main-container {
                padding: 1rem;
            }
            
            .login-form {
                padding: 1.5rem;
            }
            
            .brand-logo {
                font-size: 2.5rem;
            }
            
            .hero-headline {
                font-size: 1.3rem;
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
                        <div class="feature-title">Learn Together</div>
                        <div class="feature-text">Join study groups and learn with peers</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🎯</div>
                        <div class="feature-title">Track Progress</div>
                        <div class="feature-text">Monitor your learning achievements</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🌍</div>
                        <div class="feature-title">Global Community</div>
                        <div class="feature-text">Connect with learners worldwide</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <div class="feature-title">Quality Content</div>
                        <div class="feature-text">Access premium educational materials</div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="login-section">
                <div class="login-form">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
