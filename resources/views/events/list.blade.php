<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Agenda</title>
    <link rel="icon" type="image/png" href="https://img.pikbest.com/origin/09/27/06/70epIkbEsTkz9.png!sw800">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: rgb(48, 21, 0);
            color: #333;
            margin: 0;
            padding: 0;
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

        .container {
            background-color: rgba(255, 145, 0, 0.5);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
            max-width: 900px;
            margin: 20px auto;
            transform: translateZ(0);
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            font-size: 2rem;
            color: #ffffff;
            text-align: center;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.5s ease-in-out;
        }

        .btn {
            margin-bottom: 10px;
            box-shadow: 0 4px 10px rgba(129, 74, 74, 0.1);
        }

        .btn-secondary {
            background-color: #291a00;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #352200;
        }

        .btn-secondary:focus {
            background-color: #352200 !important;
            box-shadow: 0 0 0 .2rem rgba(43, 21, 0, 0.5) !important;
        }

        .btn-primary {
            background-color: #291a00;
            border: none;
        }

        .btn-primary:hover {
            background-color: #352200;
        }

        .btn-primary:focus {
            background-color: #352200;
            box-shadow: 0 0 0 .2rem rgba(43, 21, 0, 0.5) !important;
        }

        .btn-primary:active {
            background-color: #352200 !important;
        }

        .input-group {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            color: #fff;
            background-color: #291a00;
            border-radius: 5px;
            overflow: hidden;
        }

        .input-group .form-control {
            border: none;
            color: #fff;
            background-color: #582900;
        }

        .input-group-append .btn {
            border: none;
        }

        .table-container {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #7c3a0080;
            color: #fff !important;
            padding: 0;
            margin: 0;
        }

        thead th {
            position: sticky;
            top: 0;
            background-color: #582900;
            color: #fff;
            z-index: 10;
            text-align: center;
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

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 10px;
                margin: 10px;
            }

            h1 {
                font-size: 1.25rem;
            }

            .btn {
                margin-bottom: 8px;
            }
        }
    </style>
</head>

<body>

    <video autoplay muted loop id="backgroundVideo">
        <source src="{{ asset('background.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="eventModalLabel">
                        <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p class="lead mb-4">Apakah yakin ingin menghapus data ini?</p>
                    <i class="fas fa-trash-alt fa-4x text-danger"></i>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary btn-lg px-4" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-danger btn-lg px-4" id="removeEventBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h1 class="mb-4">Daftar Agenda</h1>
        <a href="{{ url('/calendar') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        <form method="GET" action="{{ route('events.search') }}" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="query" placeholder="Cari..."
                    value="{{ request()->query('query') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                </div>
            </div>
        </form>

        <div class="table-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Ruangan</th>
                        <th>Baju</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>
                                @if ($event->image)
                                    <img src="{{ asset('images/' . $event->image) }}" alt="Event Image"
                                        style="width: 100px; height: auto;">
                                @else
                                    Tidak ada gambar
                                @endif
                            </td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->category }}</td>
                            <td>{{ $event->start }}</td>
                            <td class="end-date" data-date="{{ $event->end }}">{{ $event->end }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-id="{{ $event->id }}">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada agenda</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.end-date').each(function() {
                var originalDate = $(this).data('date');
                var date = new Date(originalDate);

                if (!isNaN(date.getTime())) {
                    date.setDate(date.getDate() - 1);

                    var formattedDate = date.toISOString().split('T')[0];
                    $(this).text(formattedDate);
                } else {
                    console.error("Invalid date:", originalDate);
                }
            });

            $('.btn-danger').click(function() {
                var eventId = $(this).data('id');
                $('#eventModal').modal('show');
                $('#removeEventBtn').data('id', eventId);
            });

            $('#removeEventBtn').click(function() {
                var eventId = $(this).data('id');
                var row = $('button[data-id="' + eventId + '"]').closest('tr');

                $.ajax({
                    url: '/events/' + eventId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 5000,
                            extendedTimeOut: 1000,
                            tapToDismiss: true,
                            positionClass: 'toast-top-right',
                            preventDuplicates: true,
                            newestOnTop: true,
                        };

                        row.remove();
                        $('#eventModal').modal('hide');
                        toastr.error('Berhasil menghapus acara');
                        location.reload();
                    },
                    error: function(xhr) {
                        toastr.error('Gagal menghapus acara');
                    }
                });
            });
        });
    </script>


</body>

</html>
