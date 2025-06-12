<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Docsys - Dashboard</title>

    <link rel="icon" href="https://www.samudera.id/public_assets/img/logo-ico.jpg" type="image/x-icon">

    <!-- Import Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        .card-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 80px;
            gap: 130px;
            margin-bottom: 90px;
        }

        .card {
            position: relative;
            width: 400px;
            height: 600px;
            border-radius: 20px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-size: cover; /* Added */
            background-position: center; /* Added */
        }

        .card img {
            width: 50px;
            height: 50px;
            margin: 0 auto;
            background-color: white;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: -40px;
        }

        .card h3 {
            margin: 20px 0 10px;
            font-size: 18px;
            font-weight: bold;
            color: rgb(0, 0, 0); /* Added to improve readability */
        }

        .card p {
            font-size: 14px;
            color: rgb(0, 0, 0); /* Changed color for better readability */
            flex-grow: 1;
        }

        .card hr {
            width: 50%;
            margin: 10px auto;
            border: 0;
            border-top: 1px solid #000000;
        }

        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #1e82d9;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .card a:hover {
            background-color: #0300ae;
        }

        /* Specific backgrounds for each card */
        .card.input {
            background-image: url("https://raw.githubusercontent.com/sleepingindomie/tester-sai/refs/heads/main/public/img/card1.jpg");
        }

        .card.review {
            background-image: url("https://raw.githubusercontent.com/sleepingindomie/tester-sai/refs/heads/main/public/img/card2.jpg"); 
        }

        /* Color for the icons */
        .card i {
            color: rgb(0, 0, 0); /* Change to desired color */
        }

        /* Additional CSS for table layout */
        .table-container {
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 8px 50px rgba(59, 207, 0, 0.185);
            border-radius: 50px;
            margin-bottom: 50px; /* Adjusted for spacing between tables */
        }

        .table-container2 {
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 8px 50px rgba(207, 59, 0, 0.185);
            border-radius: 50px;
            margin-bottom: 50px; /* Adjusted for spacing between tables */
        }

        .dataTables_wrapper .dataTables_filter {
            text-align: right;
        }

        .dataTables_wrapper .dataTables_length {
            margin-bottom: 10px;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 10px;
        }

        .dataTables_wrapper .dataTables_info {
            margin-top: 10px;
        }

        /* Hide rows based on progress */
        .dataTable-completed tr[data-progress="pending"] {
            display: none;
        }

        .dataTable-pending tr[data-progress="completed"] {
            display: none;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('main') }}">
                <div class="sidebar-brand-icon">
                    <i class="fa-solid fa-file-invoice"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Docsys</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('main') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account.index') }}">
                        <i class="fas fa-fw fa-user-plus"></i>
                        <span>Buat Akun</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('review') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Review</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('vessel.index') }}">
                        <i class="fas fa-fw fa-ship"></i>
                        <span>Vessel</span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->role == 'customer')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('input.form') }}">
                        <i class="fas fa-fw fa-edit"></i>
                        <span>Input Data</span>
                    </a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('review') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Review</span>
                    </a>
                </li>
            @endif

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->username }}
                                    @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                        <span class="text-gray-600 mx-2">|</span>
                                        <span class="text-gray-600 small">{{ ucfirst(Auth::user()->role) }}</span>
                                    @elseif(Auth::user()->role == 'customer')
                                        <span class="text-gray-600 mx-2">|</span>
                                        <span class="text-gray-600 small">{{ $kode_bl ?? '' }}</span>
                                    @endif
                                </span>
                                <img class="img-profile rounded-circle" src="https://raw.githubusercontent.com/sleepingindomie/tester-sai/refs/heads/main/public/img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">

                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        </div>
    
                        @if(Auth::user()->role == 'customer')
                        <div class="card-container">
                            <div class="card input">
                                <i class="fa-solid fa-pen"></i>
                                <h3>INPUT</h3>
                                <hr>
                                <p>Halaman penginputan data Bill of Lading (BL)</p>
                                <hr>
                                <a href="{{ route('input.form') }}">Mulai Input</a>
                            </div>
                            <div class="card review">
                                <i class="fa-solid fa-eye"></i>
                                <h3>REVIEW</h3>
                                <hr>
                                <p>Halaman review untuk data Bill of Lading (BL)</p>
                                <hr>
                                <a href="{{ route('review') }}">Menuju Review</a>
                            </div>
                        </div>
                        @else
                        <div class="row">

                            <!-- Tabel untuk superadmin/admin -->
                            @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                            <div class="container table-container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Data BL Completed</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="dataTable" class="table table-bordered dataTable-completed" width="99%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>BL</th>
                                                            <th>Vessel-Voyage</th>
                                                            <th>Shipper</th>
                                                            <th>Progress</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($result) && count($result) > 0)
                                                            @foreach($result as $row)
                                                                @php
                                                                    $shipper_words = explode(' ', $row->shipper);
                                                                    $limited_shipper = implode(' ', array_slice($shipper_words, 0, 4));
                                                                @endphp
                                                                <tr data-progress="{{ strtolower($row->progress) }}">
                                                                    <td>{{ $row->bl }}</td>
                                                                    <td>{{ $row->ocean_vessel }}</td>
                                                                    <td>{{ $limited_shipper }}</td>
                                                                    <td>{{ $row->progress }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="4">No data available</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Duplikasi Tabel dengan CSS yang berbeda -->
                            <div class="container table-container2">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Data BL Pending</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="dataTable2" class="table table-bordered dataTable-pending" width="99%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>BL</th>
                                                            <th>Vessel-Voyage</th>
                                                            <th>Shipper</th>
                                                            <th>Progress</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($result) && count($result) > 0)
                                                            @foreach($result as $row)
                                                                @php
                                                                    $shipper_words = explode(' ', $row->shipper);
                                                                    $limited_shipper = implode(' ', array_slice($shipper_words, 0, 4));
                                                                @endphp
                                                                <tr data-progress="{{ strtolower($row->progress) }}">
                                                                    <td>{{ $row->bl }}</td>
                                                                    <td>{{ $row->ocean_vessel }}</td>
                                                                    <td>{{ $limited_shipper }}</td>
                                                                    <td>{{ $row->progress }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="4">No data available</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @php
                                Log::info('Data in view:', ['result' => isset($result) ? $result->toArray() : 'No data']);
                            @endphp

                        </div>
                        @endif
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Dp 2024</span>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabmain="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
            $('#dataTable2').DataTable();
        });
    </script>

</body>

</html>
