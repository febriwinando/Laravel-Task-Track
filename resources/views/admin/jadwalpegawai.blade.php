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
                <div class="mb-3">
                    <label class="fw-bold">Pilih Pegawai:</label>
                    <select class="form-select" id="pegawai-select">
                    @foreach ($pegawais as $pegawai)
                        <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
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
                {{-- <div class="col-md-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary mb-3">Today</h5>
                            <h2 class="display-6 fw-semibold" id="today-date">12</h2>
                            <p class="text-muted" id="today-info">Tuesday, May 2023</p>

                            <hr>

                            <h6 class="fw-bold mb-3">You have</h6>
                            <div class="mb-2 p-2 rounded bg-warning-subtle">Meeting With TL</div>
                            <div class="mb-2 p-2 rounded bg-info-subtle">4 Call Backs</div>
                            <div class="mb-2 p-2 rounded bg-success-subtle">Digi-Project Plan</div>

                            <hr>

                            <h6 class="fw-bold mb-3">Up Coming</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="badge bg-warning me-2">&nbsp;</span>Meeting With Bala <small class="text-muted d-block">07:45 PM</small></li>
                                <li class="mb-2"><span class="badge bg-primary me-2">&nbsp;</span>Call With Bala <small class="text-muted d-block">07:45 PM</small></li>
                                <li class="mb-2"><span class="badge bg-success me-2">&nbsp;</span>Project Redesign <small class="text-muted d-block">07:45 PM</small></li>
                                <li><span class="badge bg-info me-2">&nbsp;</span>Meeting With Bala <small class="text-muted d-block">07:45 PM</small></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}

                <!-- MODAL -->
                <div class="modal fade" id="modalKegiatan" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title">Manage Kegiatan - <span id="modal-date"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div id="kegiatan-container" class="p-2"></div>
                            <button class="btn btn-primary mt-3" id="btnAddKegiatan">+ Tambah Kegiatan</button>

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
{{-- <script>
document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        selectable: true,
        dateClick: function(info) {
            openModal(info.dateStr);
        }
    });

    calendar.render();


    // ===============================================
    //  OPEN MODAL – MENAMPILKAN CHECKBOX KEGIATAN
    // ===============================================
    function openModal(tanggal) {

    $('#modal-date').text(tanggal);
    $('#modalKegiatan').modal('show');

    $.get(`/jadwal/kegiatan/${tanggal}`, function(res) {

        // ======== ISI DROPDOWN PEGAWAI ============
        // $('#pegawai-select').empty();
        // res.pegawai.forEach(p => {
        //     $('#pegawai-select').append(`<option value="${p.id}">${p.name}</option>`);
        // });

        // ======== ISI CHECKBOX KEGIATAN ============
        $('#kegiatan-container').empty();

        res.task_list.forEach(task => {
            let row = `
                <div class="form-check mb-2">
                    <input class="form-check-input kegiatan-check" type="checkbox"
                        value="${task.id}" id="kegiatan_${task.id}">
                    <label class="form-check-label fw-semibold" for="kegiatan_${task.id}">
                        ${task.task}
                    </label>
                </div>
            `;
            $('#kegiatan-container').append(row);
        });

    });
}


// ===========================
// SAVE SCHEDULE
// ===========================
$('#btnSave').on('click', function() {

    let tanggal = $('#modal-date').text();
    let pegawai_id = $('#pegawai-select').val();

    console.log(pegawai_id);

    let checked_ids = [];
    $('.kegiatan-check:checked').each(function() {
        checked_ids.push($(this).val());
    });

    $.post('/jadwal/kegiatan', {
        _token: '{{ csrf_token() }}',
        tanggal: tanggal,
        pegawai_id: pegawai_id,
        kegiatan_ids: checked_ids
    }, function() {
        $('#modalKegiatan').modal('hide');
        alert("Schedule berhasil disimpan!");
    });
});


});
</script> --}}

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
    function openModal(tanggal) {

        $('#modal-date').text(tanggal);
        $('#modalKegiatan').modal('show');

        $.get(`/jadwal/kegiatan/${tanggal}/${pegawai_id}`, function (res) {

            $('#kegiatan-container').empty();

            res.task_list.forEach(task => {
                let checked = res.selected.includes(task.id) ? 'checked' : '';
                let row = `
                <div class="form-check mb-2">
                    <input class="form-check-input kegiatan-check"
                        type="checkbox" value="${task.id}"
                        id="kegiatan_${task.id}" ${checked}>
                    <label class="form-check-label fw-semibold" for="kegiatan_${task.id}">
                        ${task.task}
                    </label>
                </div>`;
                $('#kegiatan-container').append(row);
            });

        });
    }


    // =====================================
    // SAVE SCHEDULE
    // =====================================
    $('#btnSave').click(function () {

        let tanggal = $('#modal-date').text();

        let checked = [];
        $('.kegiatan-check:checked').each(function () {
            checked.push($(this).val());
        });

        $.post('/jadwal/kegiatan', {
            _token: '{{ csrf_token() }}',
            tanggal: tanggal,
            pegawai_id: pegawai_id,
            kegiatan_ids: checked
        }, function () {

            $('#modalKegiatan').modal('hide');
            loadCalendarEvents();

            alert("Schedule berhasil disimpan!");
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

</script>

@endsection

