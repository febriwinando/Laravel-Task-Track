{{-- @extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold text-primary mb-3">Today</h5>
                <h2 class="display-6 fw-semibold">{{ now()->format('d') }}</h2>
                <p class="text-muted">{{ now()->format('l, F Y') }}</p>

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
    </div>

    <div class="col-md-9">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <button class="btn btn-outline-primary btn-sm" id="weekView">Week</button>
                        <button class="btn btn-primary btn-sm" id="monthView">Month</button>
                    </div>
                    <h5 id="calendar-title" class="fw-bold mb-0"></h5>
                </div>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        headerToolbar: false,
        events: [
            { title: 'Meeting with Bala', start: '2025-11-11', color: '#6f42c1' },
            { title: 'Call back with Bala', start: '2025-11-13', color: '#f6c23e' },
            { title: 'Meeting with Bala', start: '2025-11-14', end: '2025-11-16', color: '#20c997' },
            { title: 'Client Product Demo', start: '2025-11-18', end: '2025-11-19', color: '#b197fc' },
            { title: 'New Project Start', start: '2025-11-30', color: '#0d6efd' }
        ]
    });
    calendar.render();

    document.getElementById('weekView').addEventListener('click', () => calendar.changeView('timeGridWeek'));
    document.getElementById('monthView').addEventListener('click', () => calendar.changeView('dayGridMonth'));

    const title = document.getElementById('calendar-title');
    title.innerText = calendar.view.title;
    calendar.on('datesSet', () => { title.innerText = calendar.view.title; });
});
</script>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Sidebar kiri -->
    <div class="col-md-3 mb-4">
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
    </div>

    <!-- Kalender kanan -->
    <div class="col-md-9">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // tampilkan tanggal hari ini di sidebar
    const now = new Date();
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const monthNames = ["January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"];

    document.getElementById('today-date').innerText = now.getDate();
    document.getElementById('today-info').innerText = `${dayNames[now.getDay()]}, ${monthNames[now.getMonth()]} ${now.getFullYear()}`;

    // inisialisasi kalender
    var calendarEl = document.getElementById('calendar');

    // gunakan versi global API (tanpa import module)
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        height: 'auto',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        buttonText: {
            today: 'Today',
            month: 'Month',
            week: 'Week',
            day: 'Day'
        },
        events: [
            { title: 'Meeting with Bala', start: '2025-11-11', color: '#6f42c1' },
            { title: 'Call back with Bala', start: '2025-11-13', color: '#f6c23e' },
            { title: 'Project Redesign', start: '2025-11-18', end: '2025-11-20', color: '#20c997' },
            { title: 'Client Demo', start: '2025-11-25', color: '#b197fc' },
        ]
    });

    calendar.render();
});
</script>
@endsection
