<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informasi Kontak</title>
    <link rel="icon" type="image/png" href="https://img.pikbest.com/origin/09/27/06/70epIkbEsTkz9.png!sw800">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #a2c2e9, #f6d365);
            font-family: Arial, sans-serif;
        }

        .map-container {
            width: 100%;
            height: 400px;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }

        .container {
            max-width: 800px;
            width: 100%;
        }

        .contact-info {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-info h1 {
            text-align: center;
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 20px;
        }

        .contact-info p {
            display: flex;
            padding-left: 25%;
            text-align: justify;
            font-size: 1.1rem;
        }

        .contact-info .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #007bff;
            color: #ffffff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer p {
            margin: 0;
        }
    </style>
    <meta http-equiv="Content-Security-Policy"
        content="default-src 'self'; img-src 'self' https://img.pikbest.com; script-src 'self' https://code.jquery.com https://cdnjs.cloudflare.com https://stackpath.bootstrapcdn.com; style-src 'self' https://stackpath.bootstrapcdn.com;">
</head>

<body>
    <div class="container">
        <div class="contact-info">
            <h1>Kontak</h1>
            <p><strong>Email:</strong> <a href="mailto:kun.faris.7d@gmail.com">kun.faris.7d@gmail.com</a></p>
            <p><strong>Nomor:</strong> 0878-1497-5934</p>
            <p><strong>Instagram:</strong> @kunfarisalmalik</p>
            <p><strong>Alamat:</strong> Andara, Jakarta Selatan, Indonesia</p>
            <div class="btn-container">
                <a href="{{ url('/') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
