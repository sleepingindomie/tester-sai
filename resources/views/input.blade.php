<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Input Data</title>
    <!-- Custom fonts for this template-->
    <link rel="icon" href="https://www.samudera.id/public_assets/img/logo-ico.jpg" type="image/x-icon">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .table-container {
            margin-top: 20px;
        }
        .table-container th, .table-container td {
            vertical-align: middle;
        }
        .add-remove-buttons {
            margin-bottom: 10px;
        }
        .add-remove-buttons button {
            margin-right: 5px;
        }
        .table thead th {
            text-align: center;
        }
        .table tbody td input[type="text"], .table tbody td select {
            width: 100%;
        }
        .required::before {
            content: '* ';
            color: red;
        }
        .note-required {
            color: red;
        }
    </style>
</head>
<body id="page-top">
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
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('main') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                <!-- Nav Item - Buat Akun -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account.index') }}">
                        <i class="fas fa-fw fa-user-plus"></i>
                        <span>Buat Akun</span></a>
                </li>
                <!-- Nav Item - Review -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('review') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Review</span></a>
                </li>
            @endif
            @if(Auth::user()->role == 'customer')
                <!-- Nav Item - Input Data -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('input.form') }}">
                        <i class="fas fa-fw fa-edit"></i>
                        <span>Input Data</span></a>
                </li>
                <!-- Nav Item - Review -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('review') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Review</span></a>
                </li>
            @endif
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <!-- Topbar Navbar -->
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
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Input Data Container</h1>
                    <p class="note-required">* Mandatory / wajib di isi</p>

                    <!-- Tabel Container -->
                    <form action="{{ route('container.submit') }}" method="POST">
                        @csrf
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Tabel Detail Container</h6>
                            </div>
                            <div class="card-body">
                                <div class="add-remove-buttons">
                                    <button type="button" id="addRow" class="btn btn-success">+</button>
                                    <button type="button" id="removeRow" class="btn btn-danger">-</button>
                                </div>
                                <div class="table-responsive table-container">
                                    <table class="table table-bordered" id="containerTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="selectAll"></th>
                                                <th class="required">Container No.</th>
                                                <th class="required">Seal No.</th>
                                                <th class="required">Outer Quantity</th>
                                                <th class="required">Outer Package Type</th>
                                                <th class="required">Net Weight (KGS)</th>
                                                <th class="required">Gross Weight (KGS)</th>
                                                <th class="required">Gross Meas (CMB)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="containerTableBody">
                                            <!-- Example of a row -->
                                            <tr>
                                                <td><input type="checkbox" class="rowCheckbox"></td>
                                                <td><input type="text" class="form-control" name="container_no[]"></td>
                                                <td><input type="text" class="form-control" name="seal_no[]"></td>
                                                <td><input type="number" step="0.01" class="form-control" name="outer_quantity[]"></td>
                                                <td><input type="text" class="form-control" name="outer_package_type[]"></td>
                                                <td><input type="number" step="0.01" class="form-control" name="net_weight[]"></td>
                                                <td><input type="number" step="0.01" class="form-control" name="gross_weight[]"></td>
                                                <td><input type="number" step="0.01" class="form-control" name="gross_meas[]"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" name="submit_container" id="submit_container" class="btn btn-primary" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Dp 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
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
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitContainerButton = document.getElementById('submit_container');
            const containerTableBody = document.getElementById('containerTableBody');

            function toggleSubmitButton() {
                const rows = containerTableBody.querySelectorAll('tr');
                let allFilled = true;
                rows.forEach(row => {
                    const inputs = row.querySelectorAll('input[type="text"], input[type="number"]');
                    inputs.forEach(input => {
                        if (input.value.trim() === '') {
                            allFilled = false;
                        }
                    });
                });
                submitContainerButton.disabled = !allFilled;
            }

            document.getElementById('addRow').addEventListener('click', function() {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><input type="checkbox" class="rowCheckbox"></td>
                    <td><input type="text" class="form-control" name="container_no[]"></td>
                    <td><input type="text" class="form-control" name="seal_no[]"></td>
                    <td><input type="number" step="0.01" class="form-control" name="outer_quantity[]"></td>
                    <td><input type="text" class="form-control" name="outer_package_type[]"></td>
                    <td><input type="number" step="0.01" class="form-control" name="net_weight[]"></td>
                    <td><input type="number" step="0.01" class="form-control" name="gross_weight[]"></td>
                    <td><input type="number" step="0.01" class="form-control" name="gross_meas[]"></td>
                `;
                containerTableBody.appendChild(row);
                toggleSubmitButton();
                row.querySelectorAll('input').forEach(input => {
                    input.addEventListener('input', toggleSubmitButton);
                });
            });

            document.getElementById('removeRow').addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('.rowCheckbox:checked');
                checkboxes.forEach(checkbox => checkbox.closest('tr').remove());
                toggleSubmitButton();
            });

            document.getElementById('selectAll').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.rowCheckbox');
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            });

            containerTableBody.addEventListener('input', function() {
                toggleSubmitButton();
            });

            toggleSubmitButton(); // Initial call to set the button state
        });
    </script>
</body>
</html>
