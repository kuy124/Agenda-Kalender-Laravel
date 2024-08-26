<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Kun Faris</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="https://img.pikbest.com/origin/09/27/06/70epIkbEsTkz9.png!sw800">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            scroll-behavior: smooth;
            background-color: #2d1100;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 20px;
            margin: 40px auto;
            max-width: 1200px;
        }

        .container {
            background-color: rgba(49, 22, 0, 0.8);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            max-width: 900px;
            margin: 30px auto;
            transform: translateZ(0);
        }

        .container-sidebar {
            width: 400px;
            background-color: rgba(49, 22, 0, 0.8);
            border-radius: 10px;
            padding: 30px;
            margin: 30px auto;
        }

        .container,
        .container-sidebar,
        h1 {
            color: #fff !important;
        }

        h1 {
            font-size: 2.5rem;
            color: #582900;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #calendar {
            margin-top: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: rgba(255, 145, 0, 0.5);
            color: #fff;
            padding: 15px;
        }

        .modal-content {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            border: none;
        }

        .close {
            color: #fff;
        }

        .close:hover {
            color: #fff;
        }

        .modal-header {
            background-color: #582900;
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .modal-body,
        .modal-footer {
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .btn {
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #291a00;
            border-color: #291a00;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:active {
            background-color: #582900 !important;
            border-color: #582900 !important;
            box-shadow: 0 0 0 .2rem rgba(43, 21, 0, 0.5) !important;
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 .2rem rgba(43, 21, 0, 0.5) !important;
        }

        .btn-primary:hover {
            background-color: #291a00;
            border-color: #291a00;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
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

        #calendar .fc-event {
            color: #fff;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
            transition: all 0.3s ease;
        }

        #calendar .fc-header {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        #calendar .fc-event:hover {
            transform: scale(1.05);
            background-color: #391b00;
        }

        #calendar .fc-day-grid-event {
            border-radius: 5px;
        }

        .fc-event {
            background-color: #291a00 !important;
            border: 1px solid #291a00 !important;
        }

        .fc-event .fc-title {
            display: block;
            white-space: normal;
        }

        .fc-event .fc-room {
            font-size: 0.85em;
            color: #fff;
        }

        .fc-content {
            text-align: center;
            background-color: #582900;
            border: 1px solid #391b00 !important;
        }

        .fc-today {
            color: #ffffff;
            background-color: #2c140068 !important;
        }

        .toast-info {
            background-color: rgba(255, 145, 0, 0.5);
        }

        .clock {
            text-align: center;
            font-size: 3rem;
            font-weight: bold;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            background-color: #2e1d00;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .details {
            overflow-y: auto;
            padding: 20px;
            max-height: 440px;
            margin-bottom: 10px;
            border-radius: 20px;
            background-color: rgba(255, 145, 0, 0.5);
        }

        hr {
            border: 1px solid white;
        }

        /* Responsive Styles */
        @media (min-width: 768px) {
            .container-wrapper {
                flex-direction: row;
                /* Horizontal layout on medium screens and up */
            }

            .container {
                max-width: 70%;
                margin: 30px auto;
            }

            .container-sidebar {
                width: 30%;
                padding: 30px;
            }

            h1 {
                font-size: 2.5rem;
                margin-bottom: 30px;
            }

            #calendar {
                margin-top: 30px;
            }
        }

        @media (min-width: 992px) {
            .container-wrapper {
                margin: 40px auto;
                gap: 20px;
            }

            .container {
                max-width: 80%;
            }

            .container-sidebar {
                width: 35%;
                padding: 30px;
            }

            h1 {
                font-size: 3rem;
                margin-bottom: 40px;
            }

            #calendar {
                margin-top: 40px;
            }
        }

        /* Adjustments for small devices */
        @media (max-width: 576px) {
            .container-sidebar {
                padding: 15px;
            }

            .modal-body {
                padding: 10px;
            }

            .btn {
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
    <div class="container-wrapper">
        <div class="container">
            <a href="{{ route('events.listguest') }}" class="btn btn-primary mb-3">Cari</a>
            <a href="{{ url('kontak') }}" class="btn btn-secondary mb-3">Kontak</a>
            <a href="{{ url('login') }}" class="btn btn-warning mb-3">Masuk</a>
            <div id="calendar" class="calendar"></div>
        </div>
        <div class="container-sidebar">
            <div class="clock" id="clock"></div>
            <h1>Detail Agenda</h1>
            <p id="Hidden">Silakan klik salah satu agenda untuk melihat rincian dan detail lengkapnya</p>
            <div id="sidebarEventDetails">
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/id.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: false,
                events: SITEURL + "/UserEvents",
                displayEventTime: false,
                selectable: true,
                selectHelper: true,
                locale: 'id',

                eventRender: function(event, element) {
                    element.find('.fc-title').append('<div class="fc-room">' + event.location +
                        '</div>');
                },
                eventClick: function(event) {
                    $('#Hidden').html('');
                    let fileDownloadLink = event.file ?
                        `<p align="center"><a style="text-decoration: none; color: white;" href="${SITEURL}/files/${event.file}" target="_blank"><button class="btn btn-success mt-2 ">Lihat Dokumen</button></a></p>` :
                        '';
                    $('#sidebarEventDetails').html(`
                        <div class="details">
                            <h3>${event.title}</h3>
                            <hr>
                            ${event.image ? `<img src="${SITEURL}/images/${event.image}" alt="Gambar Acara" style="max-width: 100%;"/>` : ''}
                            ${fileDownloadLink}
                            <p><strong>Mulai:</strong> ${moment(event.start).format('YYYY-MM-DD')}</p>
                            <p><strong>Selesai:</strong> ${event.end ? moment(event.end).subtract(1, 'day').format('YYYY-MM-DD') : moment(event.start).format('YYYY-MM-DD')}</p>
                            <p><strong>Deskripsi:</strong> ${event.description}</p>
                            <p><strong>Ruangan:</strong> ${event.location}</p>
                            <p><strong>Baju:</strong> ${event.category}</p>
                            
                        </div>
                    `);
                    $('#updateEventSidebarBtn').show().data('event', event);
                },
            });

            function showErrorPopup(message) {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 0,
                    extendedTimeOut: 0,
                    tapToDismiss: true,
                    positionClass: 'toast-top-right',
                    preventDuplicates: true,
                    newestOnTop: true,
                };
                toastr.error(message, "Kesalahan");
            }

            function updateClock() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');

                document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
            }

            updateClock();
            setInterval(updateClock, 1000);

            function displayMessage(message) {
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

                toastr.success(message);
            }

            function notifyCurrentEvents() {
                $.ajax({
                    url: `${SITEURL}/current-events`,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        const now = new Date();

                        const currentEvents = data.filter(event => {
                            const start = new Date(event.start);
                            const end = new Date(event.end);
                            return now >= start && now <= end;
                        });

                        if (currentEvents.length > 0) {
                            const eventList = currentEvents.map(event => {
                                const loc = event.location ? `di ${event.location}` : '';
                                return `<li>${event.title} ${loc}</li>`;
                            }).join('');
                            const message = `<ul>${eventList}</ul>`;

                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 0,
                                extendedTimeOut: 0,
                                tapToDismiss: false,
                                positionClass: 'toast-top-right',
                                preventDuplicates: true,
                                newestOnTop: true,
                            };

                            toastr.info(message, 'Acara Sekarang', {
                                allowHtml: true,
                                escapeHtml: false
                            });
                        } else {
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

                            toastr.info("Tidak ada acara yang sedang berlangsung saat ini.", 'Info');
                        }
                    },
                    error: function(xhr, status, error) {
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

                        const errorMsg = xhr.status === 404 ?
                            "Endpoint tidak ditemukan." :
                            "Gagal mengambil acara saat ini.";
                        toastr.error(errorMsg, 'Error');
                    }
                });
            }

            notifyCurrentEvents();
        });
    </script>
</body>


</html>
