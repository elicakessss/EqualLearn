<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EqualLearn') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Roboto, Arial, sans-serif;
            background-color: #0F0F0F;
            color: #FFFFFF;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 800px;
            width: 90%;
            text-align: center;
            padding: 20px;
        }

        .logo {
            font-size: 36px;
            font-weight: bold;
            color: #FF0000;
            margin-bottom: 40px;
        }

        .role-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 40px;
        }

        .role-card {
            background: #1F1F1F;
            border-radius: 12px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.2s;
            text-decoration: none;
            color: #FFFFFF;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            border: 2px solid transparent;
        }

        .role-card:hover {
            transform: translateY(-4px);
            background: #282828;
            border-color: #3EA6FF;
        }

        .role-card i {
            font-size: 48px;
            color: #3EA6FF;
        }

        .role-title {
            font-size: 24px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .role-description {
            color: #AAAAAA;
            font-size: 16px;
            line-height: 1.5;
        }

        .welcome-text {
            font-size: 20px;
            color: #AAAAAA;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .container {
                padding: 16px;
            }

            .logo {
                font-size: 28px;
                margin-bottom: 24px;
            }

            .welcome-text {
                font-size: 18px;
                margin-bottom: 24px;
            }

            .role-cards {
                gap: 16px;
            }

            .role-card {
                padding: 24px;
            }
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="logo">EqualLearn</div>

        <div class="welcome-text">
            Welcome to EqualLearn! Choose how you want to use the platform.<br>
            Are you here to learn or to share knowledge?
        </div>

        <div class="role-cards">
            <a href="{{ route('register', ['role' => 'student']) }}" class="role-card">
                <i class="fas fa-graduation-cap"></i>
                <div>
                    <div class="role-title">I'm a Student</div>
                    <p class="role-description">Watch and learn from educational videos designed for Filipino and Brazilian kids</p>
                </div>
            </a>

            <a href="{{ route('register', ['role' => 'creator']) }}" class="role-card">
                <i class="fas fa-chalkboard-teacher"></i>
                <div>
                    <div class="role-title">I'm a Creator</div>
                    <p class="role-description">Create and share educational content to help kids learn and grow</p>
                </div>
            </a>
        </div>

        <div style="margin-top: 40px; color: #AAAAAA;">
            Already have an account? <a href="{{ route('login') }}" style="color: #3EA6FF; text-decoration: none;">Sign in</a>
        </div>
    </div>
</body>
</html>
