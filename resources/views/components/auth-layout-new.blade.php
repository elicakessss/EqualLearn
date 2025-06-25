<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EqualLearn') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans:wght@400;700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Floating decorative elements */
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }

        .floating-element {
            position: absolute;
            border-radius: 20px;
            opacity: 0.7;
        }

        .element-1 {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            top: 10%;
            left: 5%;
            animation: float1 6s ease-in-out infinite;
        }

        .element-2 {
            width: 150px;
            height: 80px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            top: 60%;
            left: 10%;
            animation: float2 8s ease-in-out infinite;
            border-radius: 50px;
        }

        .element-3 {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            top: 20%;
            right: 8%;
            animation: float3 7s ease-in-out infinite;
            border-radius: 50%;
        }

        .element-4 {
            width: 120px;
            height: 60px;
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            top: 70%;
            right: 15%;
            animation: float1 9s ease-in-out infinite;
        }

        .element-5 {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            top: 40%;
            left: 15%;
            animation: float2 5s ease-in-out infinite;
            border-radius: 50%;
        }

        @keyframes float1 {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }

        @keyframes float2 {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(-10deg); }
        }

        @keyframes float3 {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(15deg); }
        }

        /* Split Screen Layout */
        .split-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* Left Side - Hero Content */
        .left-side {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            position: relative;
            min-height: 100vh;
        }

        .hero-content {
            max-width: 500px;
            z-index: 3;
        }

        .brand-title {
            font-family: 'Bubblegum Sans', cursive;
            font-size: 3.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.5rem;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            font-weight: 600;
            color: #a8b3ff;
            margin-bottom: 1.5rem;
            letter-spacing: 2px;
        }

        .hero-description {
            font-size: 1.1rem;
            color: #d1d8ff;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .features-list {
            margin-bottom: 2rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            color: #fff;
            font-size: 1rem;
        }

        .feature-icon {
            font-size: 1.2rem;
            margin-right: 12px;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px;
            border-radius: 50%;
        }

        .cta-button {
            background: linear-gradient(135deg, #ff6b9d, #ffc3a0);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 107, 157, 0.4);
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 157, 0.6);
        }

        /* 3D Phone Mockup */
        .phone-mockup {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%) rotate(5deg);
            z-index: 5;
        }

        .phone-frame {
            width: 180px;
            height: 360px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 25px;
            padding: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: 2px solid #fff;
        }

        .phone-screen {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 15px;
            overflow: hidden;
            position: relative;
        }

        .app-header {
            text-align: center;
            color: #fff;
            font-size: 0.8rem;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .lesson-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .lesson-icon {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .lesson-card h3 {
            color: #333;
            font-size: 0.9rem;
            margin-bottom: 3px;
        }

        .lesson-card p {
            color: #666;
            font-size: 0.7rem;
        }

        /* Right Side - Auth Form */
        .right-side {
            flex: 1;
            background: linear-gradient(135deg, #ffeef8 0%, #f0f4ff 100%);
            padding: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .auth-container {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 10;
        }

        /* Form Styles */
        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .auth-title {
            font-family: 'Bubblegum Sans', cursive;
            font-size: 2.2rem;
            color: #ff6b9d;
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            color: #6b7280;
            font-size: 1rem;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #374151;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            color: #374151;
            background: white;
            transition: all 0.3s ease;
            font-family: 'Quicksand', sans-serif;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #ff91a4;
            box-shadow: 0 0 0 3px rgba(255, 145, 164, 0.1);
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #ff6b9d 0%, #ffc3a0 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 157, 0.4);
        }

        .text-muted {
            text-align: center;
            color: #6b7280;
            font-size: 0.95rem;
        }

        .link {
            color: #ff6b9d;
            text-decoration: none;
            font-weight: 600;
        }

        .link:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .alert ul {
            list-style: none;
            margin: 0;
        }

        .alert li {
            margin-bottom: 0.25rem;
        }

        .text-danger {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Responsive Design - Mobile First */
        @media (max-width: 768px) {
            .split-container {
                flex-direction: column;
            }
            
            .left-side {
                min-height: 40vh;
                padding: 30px 20px;
                text-align: center;
            }
            
            .right-side {
                padding: 30px 20px;
                min-height: 60vh;
            }
            
            .phone-mockup {
                display: none;
            }
            
            .brand-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 0.9rem;
            }
            
            .auth-container {
                padding: 30px;
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .left-side {
                padding: 20px 15px;
            }
            
            .right-side {
                padding: 20px 15px;
            }
            
            .brand-title {
                font-size: 1.8rem;
            }
            
            .auth-container {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <!-- Split Screen Layout -->
    <div class="split-container">
        <!-- Left Side - Hero Content -->
        <div class="left-side">
            <!-- Floating decorative elements -->
            <div class="floating-elements">
                <div class="floating-element element-1"></div>
                <div class="floating-element element-2"></div>
                <div class="floating-element element-3"></div>
                <div class="floating-element element-4"></div>
                <div class="floating-element element-5"></div>
            </div>

            <div class="hero-content">
                <h1 class="brand-title">EqualLearn</h1>
                <h2 class="hero-subtitle">EDUCATIONAL LEARNING PLATFORM</h2>
                <p class="hero-description">
                    Discover a new way of learning with our innovative platform, designed
                    specifically for your learning journey
                </p>
                
                <div class="features-list">
                    <div class="feature-item">
                        <span class="feature-icon">✨</span>
                        Age-appropriate content
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">🎯</span>
                        Interactive learning experiences
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">📊</span>
                        Progress tracking for parents
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">🎓</span>
                        Educational videos from trusted creators
                    </div>
                </div>

                <button class="cta-button">Get Started</button>
            </div>

            <!-- 3D Phone Mockup -->
            <div class="phone-mockup">
                <div class="phone-frame">
                    <div class="phone-screen">
                        <div class="app-header">equallearn.com</div>
                        <div class="app-content">
                            <div class="lesson-card">
                                <div class="lesson-icon">🎵</div>
                                <h3>Reading Adventure</h3>
                                <p>Music & Dance</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Auth Form -->
        <div class="right-side">
            <div class="auth-container">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
