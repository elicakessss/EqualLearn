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
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
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

        .element-6 {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            top: 80%;
            left: 40%;
            animation: float3 10s ease-in-out infinite;
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

        .landing-container {
            min-height: 100vh;
            display: flex;
            position: relative;
            z-index: 2;
        }

        /* Left Section - Landing Content */
        .landing-content {
            flex: 1;
            padding: 60px 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: transparent;
            position: relative;
            overflow: hidden;
        }

        /* 3D Illustration Elements */
        .illustration-container {
            position: absolute;
            top: 50%;
            right: 10%;
            transform: translateY(-50%);
            width: 300px;
            height: 300px;
            z-index: 1;
        }

        .phone-mockup {
            position: absolute;
            width: 180px;
            height: 320px;
            background: linear-gradient(145deg, #ffffff, #f0f0f0);
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-15deg);
            z-index: 3;
        }

        .phone-screen {
            position: absolute;
            top: 20px;
            left: 15px;
            right: 15px;
            bottom: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            overflow: hidden;
        }

        .screen-content {
            padding: 20px 15px;
            color: white;
            font-size: 12px;
        }

        .screen-header {
            background: rgba(255,255,255,0.2);
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }

        .screen-cards {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .screen-card {
            background: rgba(255,255,255,0.15);
            padding: 8px;
            border-radius: 6px;
            font-size: 10px;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .shape-1 {
            position: absolute;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ff6b9d, #ffc3a0);
            border-radius: 20px;
            top: 20%;
            left: 20%;
            animation: float1 8s ease-in-out infinite;
            box-shadow: 0 10px 20px rgba(255, 107, 157, 0.3);
        }

        .shape-2 {
            position: absolute;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            border-radius: 50%;
            top: 70%;
            left: 70%;
            animation: float2 6s ease-in-out infinite;
            box-shadow: 0 10px 20px rgba(79, 172, 254, 0.3);
        }

        .shape-3 {
            position: absolute;
            width: 100px;
            height: 40px;
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            border-radius: 20px;
            top: 60%;
            left: 10%;
            animation: float3 7s ease-in-out infinite;
            box-shadow: 0 10px 20px rgba(67, 233, 123, 0.3);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 500px;
        }

        .logo {
            font-family: 'Bubblegum Sans', cursive;
            font-size: 3.5rem;
            font-weight: 700;
            color: #ff6b9d;
            margin-bottom: 1rem;
            text-shadow: 0 4px 8px rgba(255, 107, 157, 0.3);
        }

        .hero-title {
            font-family: 'Bubblegum Sans', cursive;
            font-size: 3.2rem;
            font-weight: 700;
            color: #6366f1;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            letter-spacing: -0.02em;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: #6b7280;
            margin-bottom: 2rem;
            line-height: 1.6;
            font-weight: 500;
        }

        .features {
            list-style: none;
        }

        .features li {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            color: #4a5568;
            font-weight: 500;
        }

        .features li::before {
            content: '🎯';
            margin-right: 12px;
            font-size: 1.2rem;
        }

        .get-started-btn {
            display: inline-block;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            margin-top: 2rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            border: none;
            cursor: pointer;
        }

        .get-started-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
            text-decoration: none;
            color: white;
        }

        /* Right Section - Auth Form */
        .auth-section {
            flex: 0 0 450px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
        }

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
            border-color: #ff6b9d;
            box-shadow: 0 0 0 3px rgba(255, 107, 157, 0.1);
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
        }

        .alert {
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

        /* Responsive Design */
        @media (max-width: 1024px) {
            .landing-container {
                flex-direction: column;
            }
            
            .landing-content {
                padding: 40px 40px 20px 40px;
                min-height: 50vh;
            }
            
            .auth-section {
                flex: none;
                padding: 40px;
            }
            
            .hero-title {
                font-size: 2.2rem;
            }
            
            .logo {
                font-size: 2.8rem;
            }
        }

        @media (max-width: 768px) {
            .landing-content {
                padding: 30px 30px 20px 30px;
                text-align: center;
            }
            
            .auth-section {
                padding: 30px;
            }
            
            .hero-title {
                font-size: 1.8rem;
            }
            
            .logo {
                font-size: 2.2rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <div class="floating-element element-1"></div>
        <div class="floating-element element-2"></div>
        <div class="floating-element element-3"></div>
        <div class="floating-element element-4"></div>
        <div class="floating-element element-5"></div>
        <div class="floating-element element-6"></div>
    </div>

    <div class="landing-container">
        <!-- Left Section - Landing Content -->
        <div class="landing-content">
            <!-- 3D Illustration -->
            <div class="illustration-container">
                <div class="floating-shapes">
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                    <div class="shape-3"></div>
                </div>
                <div class="phone-mockup">
                    <div class="phone-screen">
                        <div class="screen-content">
                            <div class="screen-header">EqualLearn</div>
                            <div class="screen-cards">
                                <div class="screen-card">🎨 Art & Creativity</div>
                                <div class="screen-card">🔬 Science Fun</div>
                                <div class="screen-card">📚 Reading Adventures</div>
                                <div class="screen-card">🎵 Music & Dance</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-content">
                <h1 class="logo">EqualLearn</h1>
                <h2 class="hero-title">EDUCATIONAL LEARNING PLATFORM</h2>
                <p class="hero-subtitle">Discover amazing learning content designed specifically for young minds. Safe, fun, and educational videos from trusted creators.</p>
                
                <ul class="features">
                    <li>Safe & age-appropriate content</li>
                    <li>Interactive learning experiences</li>
                    <li>Progress tracking for parents</li>
                    <li>Educational videos from trusted creators</li>
                </ul>

                <a href="{{ route('register') }}" class="get-started-btn">Get Started</a>
            </div>
        </div>

        <!-- Right Section - Auth Form -->
        <div class="auth-section">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
