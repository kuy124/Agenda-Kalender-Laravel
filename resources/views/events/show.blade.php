<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Agenda</title>
    <link rel="icon" type="image/png" href="https://img.pikbest.com/origin/09/27/06/70epIkbEsTkz9.png!sw800">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e2e2e2 0%, #c3cfe2 100%);
            padding-top: 20px;
            font-family: 'Roboto', sans-serif;
            overflow-x: hidden;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            margin: 0 auto;
            animation: fadeIn 1s ease-in-out;
            position: relative;
            z-index: 1;
        }

        h1 {
            font-size: 3rem;
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: slideDown 0.5s ease-in-out;
        }

        .event-details p {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 15px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .event-details p:hover {
            background-color: #e2e6ea;
        }

        .event-details p strong {
            color: #007bff;
        }

        .btn {
            border-radius: 8px;
            text-transform: uppercase;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .back-btn {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>{{ $event->title }}</h1>
        <div class="event-details">
            <p><strong>Mulai:</strong> {{ $event->start }}</p>
            <p><strong>Selesai:</strong> <span id="end-date">{{ $event->end }}</span></p>
            <p><strong>Deskripsi:</strong> {{ $event->description }}</p>
            <p><strong>Ruangan:</strong> {{ $event->location }}</p>
            <p><strong>Baju:</strong> {{ $event->category }}</p>
        </div>
        <div class="back-btn">
            <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var endDateElement = document.getElementById('end-date');
            var endDate = new Date(endDateElement.textContent);

            endDate.setDate(endDate.getDate() - 1);
            var formattedDate = endDate.toISOString().split('T')[0];
            endDateElement.textContent = formattedDate;
        });
    </script>
</body>

</html>
