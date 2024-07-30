<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Docsys - Buat akun</title>

    <!-- Custom fonts for this template -->
    <link rel="icon" href="https://www.samudera.id/public_assets/img/logo-ico.jpg" type="image/x-icon">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        .bg-gradient-primary {
            background-color: #4e73df;
            background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            background-size: cover;
        }

        .card-custom {
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            border-radius: 2rem;
        }
    </style>

    <script>
        function showMessage(message) {
            alert(message);
        }

        function confirmDelete(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                document.getElementById('delete_user_id').value = userId;
                document.getElementById('delete_user_form').submit();
            }
        }

        function toggleKodeBooking() {
            var roleCustomer = document.getElementById('roleCustomer');
            var kodeBookingField = document.getElementById('kodeBookingField');
            if (roleCustomer.checked) {
                kodeBookingField.style.display = 'block';
            } else {
                kodeBookingField.style.display = 'none';
            }
        }
    </script>

</head>

<body id="page-top">

    @if (session('message'))
        <script>showMessage('{{ session('message') }}');</script>
    @endif
    @if (session('error'))
        <script>showMessage('{{ session('error') }}');</script>
    @endif

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
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
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                <li class="nav-item active">
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

            @if (Auth::user()->role == 'customer')
                <li class="nav-item">
                    <a class="nav-link" href="#">
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

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('container') }}">
                        <i class="fas fa-fw fa-box"></i>
                        <span>Container</span>
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
                                        <span class="text-gray-600 small">{{ $kode_bl }}</span>
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
                    <h1 class="h3 mb-2 text-gray-800">Informasi Akun</h1>
                    <p class="mb-4">Berisi mengenai akun-akun admin maupun shipper yang ada</p>

                    <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#addUserModal">Add User</button>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Akun</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Kode Booking</th>
                                            <th>Kode BL</th>
                                            @if (Auth::user()->role == 'superadmin')
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->kode_booking ?? '-' }}</td>
                                                <td>{{ $user->kode_bl ?? '-' }}</td>
                                                @if (Auth::user()->role == 'superadmin')
                                                    <td>
                                                        <form action="{{ route('account.delete') }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
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

    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('account.add') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleInputUsername" name="username" placeholder="Enter Username..." required value="{{ old('username') }}">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Enter Password..." required>
                            <small class="form-text text-muted">Password minimal 8 karakter.</small>
                        </div>
                        <div class="form-group">
                            <label>Select Role</label>
                            @if (Auth::user()->role == 'superadmin')
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="roleAdmin" name="role" class="custom-control-input" value="admin" onclick="toggleKodeBooking()">
                                    <label class="custom-control-label" for="roleAdmin">Admin</label>
                                </div>
                            @endif
                            <div class="custom-control custom-radio">
                                <input type="radio" id="roleCustomer" name="role" class="custom-control-input" value="customer" required onclick="toggleKodeBooking()">
                                <label class="custom-control-label" for="roleCustomer">Customer</label>
                            </div>
                        </div>
                        <div class="form-group" id="kodeBookingField" style="display: none;">
                            <input type="text" class="form-control form-control-user" id="exampleInputKodeBooking" name="kode_booking" placeholder="Enter Kode Booking...">
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block btn-custom">Add User</button>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <form id="delete_user_form" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="action" value="delete_user">
        <input type="hidden" name="user_id" id="delete_user_id">
    </form>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script>
        function toggleKodeBooking() {
            var roleCustomer = document.getElementById('roleCustomer');
            var kodeBookingField = document.getElementById('kodeBookingField');
            if (roleCustomer.checked) {
                kodeBookingField.style.display = 'block';
            } else {
                kodeBookingField.style.display = 'none';
            }
        }
    </script>
    

</body>

</html>
