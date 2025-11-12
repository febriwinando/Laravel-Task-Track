<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SeoDash Free Bootstrap Admin Template by Adminmart</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('storage/assets/images/logos/seodashlogo.png') }}" />
  <link rel="stylesheet" href="{{ asset('storage/assets/css/simplebar.css') }}"">
  <link rel="stylesheet" href="{{ asset('storage/assets/css/styles.min.css') }}" />
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
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                        <span class="hide-menu">Employees</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./index.html" aria-expanded="false">
                            <span>
                                <img src="{{ asset('storage/assets/icons/addpeople.svg') }}" width="30" alt="" />
                            </span>
                            <span class="hide-menu">Add Employee</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./index.html" aria-expanded="false">
                            <span>
                                <img src="{{ asset('storage/assets/icons/peoples.svg') }}" width="30" alt="" />
                            </span>
                            <span class="hide-menu">List Employees</span>
                        </a>
                    </li>

                    <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">Locations</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                            <span>
                                <img src="{{ asset('storage/assets/icons/addlocation.svg') }}" width="30" alt="" />
                            </span>
                            <span class="hide-menu">Add Locations</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                            <span>
                                <img src="{{ asset('storage/assets/icons/location.svg') }}" width="30" alt="" />
                            </span>
                            <span class="hide-menu">List Locations</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6" class="fs-6"></iconify-icon>
                    <span class="hide-menu">Task</span>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                        <span>
                                <img src="{{ asset('storage/assets/icons/addelement.svg') }}" width="30" alt="" />
                        </span>
                        <span class="hide-menu">Add Task</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                        <span>
                                <img src="{{ asset('storage/assets/icons/element.svg') }}" width="30" alt="" />
                        </span>
                        <span class="hide-menu">List Tasks</span>
                    </a>
                    </li>
                    <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4" class="fs-6"></iconify-icon>
                    <span class="hide-menu">Schedules</span>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                        <span>
                                <img src="{{ asset('storage/assets/icons/editcalendar.svg') }}" width="30" alt="" />
                        </span>
                        <span class="hide-menu">Manage Schedules</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                        <span>
                                <img src="{{ asset('storage/assets/icons/calendar.svg') }}" width="30" alt="" />
                        </span>
                        <span class="hide-menu">List Schedules</span>
                    </a>
                    </li>
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
                        <img src="{{ asset('storage/assets/icons/menu.svg') }}" width="30" alt="" />
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
                    <a href="#" target="_blank"
                        class="btn btn-primary me-2"><span class="d-none d-md-block">Check Pro Version</span> <span class="d-block d-md-none">Pro</span></a>
                    <a href="#" target="_blank"
                        class="btn btn-success"><span class="d-none d-md-block">Download Free </span> <span class="d-block d-md-none">Free</span></a>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ asset('storage/assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-user fs-6"></i>
                            <p class="mb-0 fs-3">My Profile</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-mail fs-6"></i>
                            <p class="mb-0 fs-3">My Account</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-list-check fs-6"></i>
                            <p class="mb-0 fs-3">My Task</p>
                            </a>
                            <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                        </div>
                        </div>
                    </li>
                    </ul>
                </div>
                </nav>
            </header>
        <!--  Header End -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Forms</h5>
                        <div class="card">
                        <div class="card-body">
                            <form>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        </div>
                        <h5 class="card-title fw-semibold mb-4">Disabled forms</h5>
                        <div class="card mb-0">
                            <div class="card-body">
                                <form>
                                <fieldset disabled>
                                    <legend>Disabled fieldset example</legend>
                                    <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Disabled input</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
                                    </div>
                                    <div class="mb-3">
                                    <label for="disabledSelect" class="form-label">Disabled select menu</label>
                                    <select id="disabledSelect" class="form-select">
                                        <option>Disabled select</option>
                                    </select>
                                    </div>
                                    <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" disabled>
                                        <label class="form-check-label" for="disabledFieldsetCheck">
                                        Can't check this
                                        </label>
                                    </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
                    class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com/" target="_blank"
                    class="pe-1 text-primary text-decoration-underline">ThemeWagon</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('storage/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('storage/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('storage/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('storage/assets/js/app.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js') }}"></script>
</body>

</html>