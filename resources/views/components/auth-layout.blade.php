<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EqualLearn') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Comic+Neue:wght@700&family=Bubblegum+Sans&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Quicksand', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #ffd5de 0%, #d0e6fa 40%, #d0f7d6 70%, #fff7c2 100%);
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .main-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            width: 100vw;
        }
        .brand-title {
            font-family: 'Bubblegum Sans', 'Comic Neue', cursive;
            font-size: 2.5rem;
            color: #ff91a4;
            margin-bottom: 18px;
            letter-spacing: 1px;
            text-shadow: 2px 2px 0 #fff7c2, 0 2px 8px #ffd5de;
            text-align: center;
        }
        .container, .card {
            max-width: 420px;
            width: 95%;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.07);
            padding: 40px 32px 32px 32px;
            position: relative;
        }
        h2 {
            font-family: 'Quicksand', sans-serif;
            color: #333;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 22px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-size: 15px;
            font-weight: 600;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 14px 16px;
            border-radius: 8px;
            border: 1px solid #ddd;
            color: #333;
            font-size: 15px;
            font-family: 'Quicksand', sans-serif;
            transition: all 0.2s ease;
        }
        input:focus, select:focus {
            border-color: #ff91a4;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 145, 164, 0.15);
        }
        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            background: #ff91a4;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 10px;
            font-family: 'Quicksand', sans-serif;
        }
        .btn:hover {
            background: #ff7a92;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 145, 164, 0.3);
        }
        .btn:active {
            transform: translateY(0);
        }
        .text-muted {
            color: #777;
            margin-top: 25px;
            font-size: 15px;
            text-align: center;
        }
        .link {
            color: #ff91a4;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .link:hover {
            color: #ff7a92;
            text-decoration: underline;
        }
        .alert {
            padding: 15px;
            background: #fff5f6;
            color: #ff5757;
            border-radius: 8px;
            border-left: 4px solid #ff91a4;
            margin-bottom: 25px;
            text-align: left;
            font-size: 15px;
        }
        .alert ul {
            margin-left: 10px;
            list-style-type: none;
        }
    </style>
</head>
<body>
    <div class="main-section">
        <div class="brand-title">Equal Learn</div>
        <div class="container">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
