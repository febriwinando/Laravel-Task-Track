@extends('layouts.utama')

@section('content')
<div class="container mt-4">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-title fw-semibold card-header d-flex justify-content-between align-items-center mb-3">
            <h3>Manage Schedule</h3>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Select Employee</label>
                    <select class="form-select form-control selectpicker" id="pegawai-select" data-live-search="true">
                        @foreach ($pegawais as $pegawai)
                            <option value="{{ $pegawai->id }}" data-name="{{ $pegawai->name }}">{{ $pegawai->name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>

                <!-- MODAL -->
                <div class="modal fade" id="modalKegiatan" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title">Manage Kegiatan - <span id="modal-date"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            {{-- <div id="kegiatan-container" class="p-2"></div> --}}
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="fw-semibold">Pilih Kegiatan</label>
                                    <select id="select-kegiatan" class="form-control selectpicker" data-live-search="true">
                                        {{-- @foreach ($kegiatans as $kegiatan)
                                            <option value="{{ $kegiatan->id }}" data-name="{{ $kegiatan->task }}">{{ $kegiatan->task }}</option>
                                        @endforeach --}}

                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-semibold">Pilih Lokasi</label>
                                    <select id="select-lokasi" 
                                            class="form-control selectpicker"
                                            data-live-search="true">
                                        {{-- @foreach ($lokasis as $lokasi)
                                            <option value="{{ $lokasi->id }}" data-name="{{ $lokasi->task }} - {{ $lokasi->floor }}">{{ $lokasi->building }} - {{ $lokasi->floor }}</option>
                                        @endforeach --}}

                                    </select>
                                </div>

                                <hr>

                                <h5 class="mt-3 fw-bold">Scheduled List</h5>
                                <table class="table table-bordered" id="schedule-table">
                                    <thead>
                                        <tr>
                                            <th>Kegiatan</th>
                                            <th>Lokasi</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnSave">Simpan</button>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        let calendarEl = document.getElementById('calendar');
        let pegawai_id = $('#pegawai-select').val();

        // =====================================
        // INITIALIZE FULLCALENDAR
        // =====================================
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            selectable: true,

            dayCellDidMount: function (info) {
                const day = info.date.getDay(); // 0 = Minggu, 6 = Sabtu
                info.el.style.color = "#000000";
                if (day === 0) {
                    // Minggu = merah
                    info.el.style.backgroundColor = '#ffdddd';
                    info.el.style.color = '#b30000';
                }

                if (day === 6) {
                    // Sabtu = orange
                    info.el.style.backgroundColor = '#fff0d6';
                    info.el.style.color = '#cc7a00';
                }
            },


            dateClick: function (info) {
                openModal(info.dateStr);
            },

            // double click => tampil di panel kanan
            eventDidMount: function (arg) {
                arg.el.addEventListener('dblclick', () => {
                    loadDayActivities(arg.event.startStr);
                });
            }
        });

        calendar.render();
        loadCalendarEvents();


        // =====================================
        // LOAD EVENTS (WARNA)
        // =====================================
        function loadCalendarEvents() {
            calendar.removeAllEvents();

            $.get(`/jadwal/events/${pegawai_id}`, function (events) {
                events.forEach(e => calendar.addEvent(e));
            });
        }


        // =====================================
        // CHANGE PEGAWAI = RELOAD CALENDAR
        // =====================================
        $('#pegawai-select').on('change', function () {
            pegawai_id = $(this).val();
            loadCalendarEvents();
        });


        // =====================================
        // OPEN MODAL & LOAD CHECKBOX
        // =====================================
        // function openModal(tanggal) {

        //     $('#modal-date').text(tanggal);
        //     $('#modalKegiatan').modal('show');

        //     $.get(`/jadwal/kegiatan/${tanggal}/${pegawai_id}`, function (res) {

        //         $('#kegiatan-container').empty();

        //         res.task_list.forEach(task => {
        //             let checked = res.selected.includes(task.id) ? 'checked' : '';
        //             let row = `
        //             <div class="form-check mb-2">
        //                 <input class="form-check-input kegiatan-check"
        //                     type="checkbox" value="${task.id}"
        //                     id="kegiatan_${task.id}" ${checked}>
        //                 <label class="form-check-label fw-semibold" for="kegiatan_${task.id}">
        //                     ${task.task}
        //                 </label>
        //             </div>`;
        //             $('#kegiatan-container').append(row);
        //         });

        //     });
        // }

        function openModal(tanggal) {

            $('#modal-date').text(tanggal);
            $('#modalKegiatan').modal('show');

            $.get(`/jadwal/modal-data/${tanggal}/${pegawai_id}`, function (res) {

                // Load Select Kegiatan
                $('#select-kegiatan').empty();
                res.kegiatan.forEach(k => {
                    $('#select-kegiatan').append(
                        `<option value="${k.id}">${k.task}</option>`
                    );
                });

                // Load Select Lokasi
                $('#select-lokasi').empty();
                res.lokasi.forEach(l => {
                    $('#select-lokasi').append(
                        `<option value="${l.id}">${l.building} / ${l.floor}</option>`
                    );
                });

                $('.selectpicker').selectpicker('refresh');

                // Load Tabel Schedule
                loadScheduleTable(res.schedules);
            });
        }

        function loadScheduleTable(data) {
                let tbody = $("#schedule-table tbody");
                tbody.empty();

                data.forEach(s => {
                    tbody.append(`
                        <tr>
                            <td>${s.kegiatan.task}</td>
                            <td>${s.lokasi.building} / ${s.lokasi.floor}</td>
                            <td>
                                <button class="btn btn-danger btn-sm btnDelete" data-id="${s.id}">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    `);
                });
            }


        // =====================================
        // SAVE SCHEDULE
        // =====================================
        // $('#btnSave').click(function () {

        //     let tanggal = $('#modal-date').text();

        //     let checked = [];
        //     $('.kegiatan-check:checked').each(function () {
        //         checked.push($(this).val());
        //     });

        //     $.post('/jadwal/kegiatan', {
        //         _token: '{{ csrf_token() }}',
        //         tanggal: tanggal,
        //         pegawai_id: pegawai_id,
        //         kegiatan_ids: checked
        //     }, function () {

        //         $('#modalKegiatan').modal('hide');
        //         loadCalendarEvents();

        //         alert("Schedule berhasil disimpan!");
        //     });

        // });

        $('#btnSave').click(function () {

            let tanggal = $('#modal-date').text();

            $.post('/jadwal/save', {
                _token: '{{ csrf_token() }}',
                tanggal: tanggal,
                pegawai_id: pegawai_id,
                kegiatan_id: $('#select-kegiatan').val(),
                lokasi_id: $('#select-lokasi').val()
            }, function (res) {

                loadScheduleTable(res.schedules);
                loadCalendarEvents();
            });
        });


        $(document).on('click', '.btnDelete', function () {

            let id = $(this).data('id');

            $.ajax({
                url: `/jadwal/delete/${id}`,
                method: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function (res) {
                    loadScheduleTable(res.schedules);
                    loadCalendarEvents();
                }
            });
        });




        // =====================================
        // PANEL KANAN (DOUBLE CLICK)
        // =====================================
        function loadDayActivities(tanggal) {

            $.get('/jadwal/day', {
                tanggal: tanggal,
                pegawai_id: pegawai_id
            }, function (res) {

                $('#today-date').text(tanggal);

                let html = "";
                res.forEach(r => {
                    html += `<div class="mb-2 p-2 rounded bg-info-subtle">${r.kegiatan.task}</div>`;
                });

                if (html === "") html = "<i class='text-muted'>Tidak ada kegiatan</i>";

                // replace bagian "You have"
                $('#today-info').html(html);
            });
        }

    });

    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>

@endsection

