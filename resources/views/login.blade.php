<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="https://img.pikbest.com/origin/09/27/06/70epIkbEsTkz9.png!sw800">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        #backgroundVideo {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .login-container {
            background: rgba(49, 22, 0, 0.8);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            color: #fff;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            text-align: center;
        }

        .form-group {
            color: #fff;
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 96.5%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input:focus {
            border-color: #007bff;
        }

        .form-group button {
            width: 100%;
            padding: 0.5rem;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .back {
            width: 100%;
            padding: 0.5rem;
            border: none;
            border-radius: 4px;
            background-color: #4a4a4a;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
        }

        .back:hover {
            background-color: #232323;
        }

        .error-message {
            color: red;
            margin-top: 1rem;
            text-align: center;
        }

        /* Responsive Styles */
        @media (max-width: 600px) {
            .login-container {
                padding: 1rem;
                max-width: 90%;
            }

            h1 {
                font-size: 1.25rem;
            }

            .form-group input {
                padding: 0.4rem;
            }

            .form-group button {
                padding: 0.4rem;
                font-size: 0.875rem;
            }

            .back {
                padding: 0.4rem;
                font-size: 0.875rem;
            }
        }
    </style>
</head>

<body>
    <video autoplay muted loop id="backgroundVideo">
        <source src="{{ asset('background.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="login-container">
        <h1>Login</h1>
        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>Email atau kata sandi yang Anda masukkan tidak sesuai. Mohon periksa kembali dan coba lagi.</p>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ url('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="button">Login</button>
            </div>
        </form>
        <button class="button back"><a href="{{ url('') }}"
                style="text-decoration: none; color:#fff;">Kembali</a></button>
    </div>
</body>

</html>
