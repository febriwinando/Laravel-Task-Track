<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Task Track')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('storage/assets/images/logotasktrack.png') }}" />
    <link rel="stylesheet" href="{{ asset('storage/assets/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/css/styles.min.css') }}" />
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.24.2/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
</head>

<body>
  <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="./index.html" class="text-nowrap logo-img">
                    <img src="{{ asset('storage/assets/images/tt4.png') }}" width="150" alt="" />
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    @if(in_array(Auth::user()->level, ['administrator']))
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                        <span class="hide-menu">Admin</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/users/create" aria-expanded="false">
                            <span>
                                <img class="fs-6" src="{{ asset('storage/assets/icons/username.svg') }}" width="30" alt="" />
                            </span>
                            <span class="hide-menu">Add User</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/users" aria-expanded="false">
                            <span>
                                <img class="fs-6" src="{{ asset('storage/assets/icons/username.svg') }}" width="30" alt="" />
                            </span>
                            <span class="hide-menu">List Users</span>
                        </a>
                    </li>
                    @endif
                    @if(in_array(Auth::user()->level, ['administrator', 'staff']))
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                        <span class="hide-menu">Employees</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/pegawai/create" aria-expanded="false">
                            <span>
                                <img class="fs-6" src="{{ asset('storage/assets/icons/addpeople.svg') }}" width="30" alt="" />
                            </span>
                            <span class="hide-menu">Add Employee</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/pegawai" aria-expanded="false">
                            <span>
                                <img class="fs-6" src="{{ asset('storage/assets/icons/peoples.svg') }}" width="30" alt="" />
                            </span>
                            <span class="hide-menu">List Employees</span>
                        </a>
                    </li>

                    <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">Locations</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/lokasi/create" aria-expanded="false">
                            <span>
                                <img class="fs-6" src="{{ asset('storage/assets/icons/addlocation.svg') }}" width="30" alt="" />
                            </span>
                            <span class="hide-menu">Add Locations</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/lokasi" aria-expanded="false">
                            <span>
                                <img class="fs-6" src="{{ asset('storage/assets/icons/location.svg') }}" width="30" alt="" />
                            </span>
                            <span class="hide-menu">List Locations</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6" class="fs-6"></iconify-icon>
                    <span class="hide-menu">Task</span>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="/kegiatan/create" aria-expanded="false">
                        <span>
                                <img class="fs-6" src="{{ asset('storage/assets/icons/addelement.svg') }}" width="30" alt="" />
                        </span>
                        <span class="hide-menu">Add Task</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="/kegiatan" aria-expanded="false">
                        <span>
                                <img class="fs-6" src="{{ asset('storage/assets/icons/element.svg') }}" width="30" alt="" />
                        </span>
                        <span class="hide-menu">List Tasks</span>
                    </a>
                    </li>
                    <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4" class="fs-6"></iconify-icon>
                    <span class="hide-menu">Schedules</span>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="/jadwal" aria-expanded="false">
                        <span>
                                <img class="fs-6" src="{{ asset('storage/assets/icons/editcalendar.svg') }}" width="30" alt="" />
                        </span>
                        <span class="hide-menu">Manage Schedules</span>
                    </a>
                    </li>
                    @endif
                    {{-- <li class="sidebar-item">
                    <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                        <span>
                                <img class="fs-6" src="{{ asset('storage/assets/icons/calendar.svg') }}" width="30" alt="" />
                        </span>
                        <span class="hide-menu">List Schedules</span>
                    </a>
                    </li> --}}
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
        <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                    <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                        <img class="fs-6" src="{{ asset('storage/assets/icons/menu.svg') }}" width="30" alt="" />
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                        <i class="ti ti-bell-ringing"></i>
                        <div class="notification bg-primary rounded-circle"></div>
                    </a>
                    </li>
                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                    {{-- <a href="#" target="_blank"
                        class="btn btn-primary me-2"><span class="d-none d-md-block">Check Pro Version</span> <span class="d-block d-md-none">Pro</span></a>
                    <a href="#" target="_blank"
                        class="btn btn-success"><span class="d-block d-md-none">Free</span></a> --}}
                    <span class="btn btn-success d-none d-md-block">{{ Auth::user()->name  }}</span> 
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                            <img class="fs-6 rounded-circle object-fit-cover" 
                                src="{{ Auth::user()->foto 
                                    ? asset('storage/' . Auth::user()->foto) 
                                    : asset('storage/assets/icons/menu.svg') }}" 
                                width="35" height="35"
                                alt="Foto User" />

                        {{-- <img src="{{ asset('storage/assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle"> --}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="{{ route('users.edit', Auth::user()->id) }}" class="d-flex align-items-center gap-2 dropdown-item">
                            {{-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item"> --}}
                            <i class="ti ti-user fs-6"></i>
                            <p class="mb-0 fs-3">Edit</p>
                            </a>
                            {{-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-mail fs-6"></i>
                            <p class="mb-0 fs-3">My Account</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-list-check fs-6"></i>
                            <p class="mb-0 fs-3">My Task</p>
                            </a> --}}
                            <a href="{{ route('logout') }}" 
                              class="btn btn-outline-primary mx-3 mt-2 d-block"
                              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        </div>
                    </li>
                    </ul>
                </div>
                </nav>
            </header>
        <!--  Header End -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('storage/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('storage/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('storage/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('storage/assets/js/app.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js') }}"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    

    @yield('scripts')
</body>

</html>