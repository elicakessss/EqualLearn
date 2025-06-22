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

        .logo {
            font-size: 36px;
            font-weight: bold;
            color: #FF0000;
            margin-bottom: 20px;
            text-decoration: none;
        }

        .auth-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #AAAAAA;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            background: #1F1F1F;
            border: 1px solid #333333;
            border-radius: 4px;
            color: #FFFFFF;
            margin-bottom: 0.5rem;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #FF0000;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background: #CC0000;
        }

        .text-danger {
            color: #FF0000;
            font-size: 0.875rem;
        }

        .text-center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .alert {
            padding: 10px;
            background: #FF3333;
            color: white;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <a href="{{ route('welcome') }}" class="logo">EqualLearn</a>

    <div class="auth-container">
        {{ $slot }}
    </div>
</body>
</html>
