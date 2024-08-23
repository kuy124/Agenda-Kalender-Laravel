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
            max-height: 400px;
            margin-bottom: 10px;
            border-radius: 20px;
            background-color: rgba(255, 145, 0, 0.5);
        }

        hr {
            border: 1px solid white;
        }

        @media (min-width: 768px) {
            .container-wrapper {
                flex-direction: row;
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
            <form action="{{ url('logout') }}" method="post">
                <a href="{{ route('events.list') }}" class="btn btn-primary mb-3">Cari</a>
                @csrf
                <button type="submit" class="btn btn-warning mb-3">Keluar</button>
            </form>
            <div id="calendar" class="calendar"></div>
        </div>
        <div class="container-sidebar">
            <div class="clock" id="clock"></div>
            <h1>Detail Agenda</h1>
            <p id="Hidden">Silakan klik salah satu agenda untuk melihat rincian dan detail lengkapnya</p>
            <div id="sidebarEventDetails">
            </div>
            <p align="center">
                <button class="btn btn-primary" id="updateEventSidebarBtn" style="display:none;">Perbarui</button>
            </p>
        </div>
    </div>


    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="eventForm">
                        <input type="hidden" id="eventId">
                        <div class="form-group">
                            <label for="eventTitle">Judul</label>
                            <input type="text" class="form-control" id="eventTitle" placeholder="Masukkan Judul">
                        </div>
                        <div class="form-group">
                            <label for="eventStart">Mulai</label>
                            <input type="text" class="form-control" id="eventStart" readonly>
                        </div>
                        <div class="form-group">
                            <label for="eventEnd">Selesai</label>
                            <input type="text" class="form-control" id="eventEnd" readonly>
                        </div>
                        <div class="form-group">
                            <label for="eventDescription">Deskripsi</label>
                            <textarea class="form-control" id="eventDescription" rows="3" placeholder="Masukkan Deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="eventLocation">Ruangan</label>
                            <select class="form-control" id="eventLocation">
                                <option value="">Pilih Ruangan</option>
                                <option value="Ruangan 1">Ruangan 1</option>
                                <option value="Ruangan 2">Ruangan 2</option>
                                <option value="Ruangan 3">Ruangan 3</option>
                                <option value="Ruangan 4">Ruangan 4</option>
                                <option value="Ruangan 5">Ruangan 5</option>
                                <option value="Ruangan 6">Ruangan 6</option>
                                <option value="Ruangan 7">Ruangan 7</option>
                                <option value="Ruangan 8">Ruangan 8</option>
                                <option value="Ruangan 9">Ruangan 9</option>
                                <option value="Ruangan 10">Ruangan 10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="eventCategory">Baju</label>
                            <input type="text" class="form-control" id="eventCategory" placeholder="Masukkan Baju">
                        </div>
                        <div class="form-group">
                            <label for="eventImage">Gambar</label>
                            <input type="file" class="form-control" id="eventImage">
                        </div>
                        <div class="form-group">
                            <label for="eventFile">Dokumen</label>
                            <input type="file" class="form-control" id="eventFile"
                                accept=".pdf,.doc,.docx,.xls,.xlsx">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-danger" id="removeEventBtn"
                        style="display:none;">Hapus</button>
                    <button type="button" class="btn btn-primary" id="saveEventBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
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
                editable: true,
                events: SITEURL + "/events",
                displayEventTime: false,
                selectable: true,
                selectHelper: true,
                locale: 'id',
                select: function(start, end, allDay) {
                    var today = moment().startOf('day');
                    if (start.isBefore(today)) {
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
                        toastr.error('Anda tidak bisa memesan ruangan untuk tanggal sebelum hari ini.');
                        calendar.fullCalendar('unselect');
                        return;
                    }
                    $('#eventModal').modal('show');
                    $('#eventStart').val(moment(start).format('YYYY-MM-DD'));
                    $('#eventEnd').val(moment(end).subtract(1, 'day').format(
                        'YYYY-MM-DD'));
                },
                eventRender: function(event, element) {
                    element.find('.fc-title').append('<div class="fc-room">' + event.location +
                        '</div>');
                },
                eventClick: function(event) {
                    $('#Hidden').html('');

                    let fileDownloadLink = event.file ?
                        `<p align="center"><a style="decoration: none; color: white;" href="${SITEURL}/files/${event.file}" target="_blank"><button class="btn btn-success mt-2 ">Lihat Dokumen</button></a></p>` :
                        '';
                    $('#sidebarEventDetails').html(`
                        <div class="details">
                            <h3>${event.title}</h3>
                            <hr>
                            ${event.image ? `<img src="${SITEURL}/images/${event.image}" alt="Event Image" style="max-width: 100%;"/>` : ''}
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

                eventDrop: function(event, delta, revertFunc) {
                    var today = moment().startOf('day');
                    if (event.start.isBefore(today)) {
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
                        toastr.error('Anda tidak bisa memindahkan acara ke tanggal sebelum hari ini.');
                        revertFunc();
                        return;
                    }

                    var updatedEvent = {
                        id: event.id,
                        title: event.title,
                        start: event.start.format('YYYY-MM-DD'),
                        end: event.end ? event.end.format('YYYY-MM-DD') : null,
                        description: event.description,
                        location: event.location,
                        category: event.category,
                        _method: 'PUT'
                    };

                    if (hasOverlappingEvents(updatedEvent)) {
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
                        toastr.error(
                            'Acara tidak bisa dipindahkan. Ruangan sudah terpakai pada waktu tersebut.'
                        );
                        revertFunc();
                        return;
                    }

                    clearTimeout(window.dragTimeout);
                    window.dragTimeout = setTimeout(function() {
                        $.ajax({
                            url: SITEURL + "/events/" + event.id,
                            data: updatedEvent,
                            type: "POST",
                            success: function(data) {
                                calendar.fullCalendar('updateEvent', event);
                                displayMessage("Acara berhasil diperbarui");
                                $('#calendar').fullCalendar('refetchEvents');
                                $('#eventModal').modal('hide');
                                toastr.success("Acara berhasil diperbarui");
                                $('#Hidden').html(`Silakan klik salah satu agenda untuk melihat rincian dan detail lengkapnya`)
                                $('#sidebarEventDetails').html(`
                                `);
                                $('#updateEventSidebarBtn').hide().data('event',
                                    event);
                            },
                            error: function() {
                                revertFunc();
                                showErrorPopup("Gagal memperbarui acara");
                            }
                        });
                    }, 500);
                }
            });

            $('#eventModal').on('show.bs.modal', function(e) {
                var event = $(e.relatedTarget).data('event');
                if (event) {
                    $('#eventModalLabel').text('Edit Acara');
                    $('#eventId').val(event.id);
                    $('#eventTitle').val(event.title);
                    $('#eventStart').val(moment(event.start).format('YYYY-MM-DD'));
                    $('#eventEnd').val(event.end ? moment(event.end).subtract(1, 'day').format(
                        'YYYY-MM-DD') : moment(event.start).format(
                        'YYYY-MM-DD'));
                    $('#eventDescription').val(event.description);
                    $('#eventLocation').val(event.location);
                    $('#eventCategory').val(event.category);
                    $('#saveEventBtn').text('Perbarui').data('event', event);
                    $('#removeEventBtn').show().data('event', event);
                    $('#showEventBtn').show().data('event', event);
                } else {
                    $('#eventModalLabel').text('Tambah Acara');
                    $('#saveEventBtn').text('Simpan').removeData('event');
                    $('#removeEventBtn').hide().removeData('event');
                    $('#showEventBtn').hide().removeData('event');
                    $('#eventForm')[0].reset();
                }
            });

            $('#updateEventSidebarBtn').click(function() {
                var event = $(this).data('event');
                if (event) {
                    $('#eventModal').modal('show');
                    $('#eventModalLabel').text('Edit Acara');
                    $('#eventId').val(event.id);
                    $('#eventTitle').val(event.title);
                    $('#eventStart').val(moment(event.start).format('YYYY-MM-DD'));
                    $('#eventEnd').val(event.end ? moment(event.end).subtract(1, 'day').format(
                        'YYYY-MM-DD') : moment(event.start).format('YYYY-MM-DD'));
                    $('#eventDescription').val(event.description);
                    $('#eventLocation').val(event.location);
                    $('#eventCategory').val(event.category);
                    $('#saveEventBtn').text('Perbarui').data('event', event);
                    $('#removeEventBtn').show().data('event', event);
                    $('#showEventBtn').show().data('event', event);
                }
            });

            function hasOverlappingEvents(newEvent) {
                var events = $('#calendar').fullCalendar('clientEvents');
                var newEventStart = moment(newEvent.start);
                var newEventEnd = moment(newEvent.end || newEvent.start);

                for (var i = 0; i < events.length; i++) {
                    var event = events[i];
                    var eventStart = moment(event.start);
                    var eventEnd = moment(event.end || event.start).subtract(1, 'day');

                    if (event.id !== newEvent.id &&
                        event.location === newEvent.location) {

                        if (newEventStart.isBefore(eventEnd) && newEventEnd.isAfter(eventStart)) {
                            return true;
                        }
                    }
                }
                return false;
            }


            $('#saveEventBtn').click(function() {
                var eventData;
                var updateBtn = $(this).text() === 'Perbarui';
                var formData = new FormData();
                var url, method;

                if (updateBtn) {
                    var event = $(this).data('event');
                    event.title = $('#eventTitle').val();
                    event.description = $('#eventDescription').val();
                    event.location = $('#eventLocation').val();
                    event.category = $('#eventCategory').val();
                    event.start = moment($('#eventStart').val());
                    event.end = moment($('#eventEnd').val()).add(1, 'day');
                    eventData = {
                        id: event.id,
                        title: event.title,
                        start: event.start.format('YYYY-MM-DD'),
                        end: event.end ? event.end.format('YYYY-MM-DD') : null,
                        description: event.description,
                        location: event.location,
                        category: event.category,
                        _method: 'PUT'
                    };
                    url = '/events/' + event.id;
                    method = 'POST';
                } else {
                    eventData = {
                        title: $('#eventTitle').val(),
                        start: $('#eventStart').val(),
                        end: $('#eventEnd').val() ? moment($('#eventEnd').val()).add(1, 'day').format(
                            'YYYY-MM-DD') : null,
                        description: $('#eventDescription').val(),
                        location: $('#eventLocation').val(),
                        category: $('#eventCategory').val()
                    };
                    url = '/events';
                    method = 'POST';
                }

                formData.append('title', eventData.title);
                formData.append('start', eventData.start);
                formData.append('end', eventData.end);
                formData.append('description', eventData.description);
                formData.append('location', eventData.location);
                formData.append('category', eventData.category);
                if (updateBtn) {
                    formData.append('_method', 'PUT');
                }

                var imageFile = $('#eventImage')[0].files[0];
                if (imageFile) {
                    formData.append('image', imageFile);
                }

                var fileFile = $('#eventFile')[0].files[0];
                if (fileFile) {
                    formData.append('file', fileFile);
                }

                if (hasOverlappingEvents(eventData)) {
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

                    toastr.error(
                        'Acara tidak bisa ditambahkan. Ruangan sudah terpakai pada waktu tersebut.');
                    return;
                }

                $.ajax({
                    url: url,
                    data: formData,
                    type: method,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
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
                        $('#calendar').fullCalendar('refetchEvents');
                        $('#eventModal').modal('hide');
                        toastr.success("Acara berhasil diperbarui");

                        $('#sidebarEventDetails').html(`
                            <div class="details">
                                <h3>${eventData.title}</h3>
                                <hr>
                                ${data.image ? `<img src="${SITEURL}/images/${data.image}" alt="Event Image" style="max-width: 100%;"/>` : ''}
                                ${data.file ? `<p align="center"><a href="${SITEURL}/files/${data.file}" target="_blank"><button class="btn btn-success mt-2">Lihat Dokumen</button></a></p>` : ''}
                                <p><strong>Mulai:</strong> ${moment(eventData.start).format('YYYY-MM-DD')}</p>
                                <p><strong>Selesai:</strong> ${eventData.end ? moment(eventData.end).subtract(1, 'day').format('YYYY-MM-DD') : moment(eventData.start).format('YYYY-MM-DD')}</p>
                                <p><strong>Deskripsi:</strong> ${eventData.description}</p>
                                <p><strong>Ruangan:</strong> ${eventData.location}</p>
                                <p><strong>Baju:</strong> ${eventData.category}</p>
                            </div>
                        `);
                        $('#updateEventSidebarBtn').show().data('event',
                            event);
                    },
                    error: function() {
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
                        toastr.error("Gagal memperbarui acara");
                    }
                });
            });



            $('#removeEventBtn').click(function() {
                var event = $(this).data('event');
                $.ajax({
                    url: SITEURL + "/events/" + event.id,
                    data: {
                        _method: 'DELETE'
                    },
                    type: "POST",
                    success: function(response) {
                        calendar.fullCalendar('removeEvents', event.id);
                        calendar.fullCalendar('removeEvents');
                        calendar.fullCalendar('refetchEvents');
                        $('#eventModal').modal('hide');
                        $('#sidebarEventDetails').html(`
                        `);
                        $('#updateEventSidebarBtn').hide().data('event', event);
                        $('#Hidden').html(
                            'Silakan klik salah satu agenda untuk melihat rincian dan detail lengkapnya'
                        )
                        displayMessage("Acara berhasil dihapus");
                    }
                });
            });

            $('#eventModal').on('hidden.bs.modal', function() {
                $('#eventModalLabel').text('Tambah Acara');
                $('#saveEventBtn').text('Simpan').removeData('event');
                $('#removeEventBtn').hide().removeData('event');
                $('#showEventBtn').hide().removeData('event');
                $('#eventForm')[0].reset();
            });

            $('#showEventBtn').click(function() {
                var event = $(this).data('event');
                window.location.href = SITEURL + "/events/" + event.id;
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
                toastr.error(message, "Error");
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
