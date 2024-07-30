<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Docsys - Vessels & Voyage</title>

    <link rel="icon" href="https://www.samudera.id/public_assets/img/logo-ico.jpg" type="image/x-icon">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
            <li class="nav-item">
                <a class="nav-link" href="{{ route('main') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account.index') }}">
                        <i class="fas fa-fw fa-user-plus"></i>
                        <span>Buat Akun</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('review') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Review</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('vessel.index') }}">
                        <i class="fas fa-fw fa-ship"></i>
                        <span>Vessel</span></a>
                </li>
            @endif
            @if (Auth::user()->role == 'customer')
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-edit"></i>
                        <span>Input Data</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('review') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Review</span></a>
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
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->username }}
                                    @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                        <span class="text-gray-600 mx-2">|</span>
                                        <span class="text-gray-600 small">{{ ucfirst(Auth::user()->role) }}</span>
                                    @elseif (Auth::user()->role == 'customer')
                                        <span class="text-gray-600 mx-2">|</span>
                                        <span class="text-gray-600 small">{{ Auth::user()->kode_bl }}</span>
                                    @endif
                                </span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
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
                    <h1 class="h3 mb-2 text-gray-800">Vessels</h1>
                    <p class="mb-4">Berisi data kode booking tiap vessel</p>

                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Vessel</h6>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addVesselModal">Add Vessel</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Vessel</th>
                                            <th>Voyage</th>
                                            <th>Kode Booking</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vesselData as $vesselName => $voyages)
                                            @foreach ($voyages as $voyageName => $bookings)
                                                <tr>
                                                    <td>{{ $vesselName }}</td>
                                                    <td>{{ $voyageName }}</td>
                                                    <td>
                                                        @foreach (explode(', ', $bookings[0]['kode_booking']) as $booking)
                                                            <div>{{ $booking }}</div>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach (explode(', ', $bookings[0]['kode_booking']) as $booking_id)
                                                            <form action="{{ route('vessel.deleteBooking') }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                <input type="hidden" name="bookingId" value="{{ $bookings[0]['id'] }}">
                                                                <button type="submit" name="deleteBooking" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                            <br>
                                                        @endforeach
                                                    </td>
                                                </tr>

                                                <!-- Add Booking Modal for Each Booking -->
                                                <div class="modal fade" id="addBookingModal-{{ $bookings[0]['id'] }}" tabindex="-1" role="dialog" aria-labelledby="addBookingModalLabel-{{ $bookings[0]['id'] }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('vessel.addBooking') }}" method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="addBookingModalLabel-{{ $bookings[0]['id'] }}">Add Kode Booking for {{ $vesselName }} - {{ $voyageName }}</h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="vesselId" value="{{ $bookings[0]['id'] }}">
                                                                    <div class="form-group">
                                                                        <label for="kodeBooking">Kode Booking</label>
                                                                        <select class="form-control" id="kodeBooking" name="kodeBooking" required>
                                                                            @foreach (DB::table('users')->select('kode_booking')->get() as $user)
                                                                                <option value="{{ $user->kode_booking }}">{{ $user->kode_booking }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" name="addBooking" class="btn btn-primary">Add Booking</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addVesselModal" tabindex="-1" role="dialog" aria-labelledby="addVesselModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('vessel.add') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addVesselModalLabel">Add New Vessel</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="vesselName">Vessel Name</label>
                            <input type="text" class="form-control" id="vesselName" name="vesselName" required>
                        </div>
                        <div class="form-group">
                            <label for="voyageName">Voyage Name</label>
                            <input type="text" class="form-control" id="voyageName" name="voyageName" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="addVessel" class="btn btn-primary">Add Vessel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

</body>

</html>
