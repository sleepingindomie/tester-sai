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
            content: '*';
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
                    <h1 class="h3 mb-4 text-gray-800">Input Data</h1>
                    <p class="note-required">* Mandatory / wajib di isi</p>

                     <!-- Input Form -->
                     <form action="{{ route('inputpage2.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group required">
                            <label for="bl">BL</label>
                            <input type="text" class="form-control" id="bl" name="bl" value="{{ old('bl', $bl) }}" readonly required>
                        </div>
                        <div class="form-group required">
                            <label for="no_of_containers">No. of Containers</label>
                            <input type="text" class="form-control" id="no_of_containers" name="no_of_containers" value="{{ old('no_of_containers', $no_of_containers) }}" readonly required>
                        </div>
                        <div class="form-group required">
                            <label>Type</label>
                            <div>
                                <input type="radio" id="dg" name="type" value="DG" required>
                                <label for="dg">DG</label>
                                <input type="radio" id="non-dg" name="type" value="Non-DG" required>
                                <label for="non-dg">Non-DG</label>
                            </div>
                        </div>
                        <div class="form-group required" id="un_field" style="display: none;">
                            <label for="un_number">UN Number</label>
                            <input type="text" class="form-control" id="un_number" name="un_number">
                        </div>
                        <div class="form-group required" id="imo_field" style="display: none;">
                            <label for="imo_number">IMO Number</label>
                            <input type="text" class="form-control" id="imo_number" name="imo_number">
                        </div>
                        <div class="form-group required">
                            <label for="shipper">Shipper</label>
                            <input type="text" class="form-control" id="shipper" name="shipper" required>
                        </div>
                        <div class="form-group required">
                            <label for="consignee">Consignee</label>
                            <input type="text" class="form-control" id="consignee" name="consignee" required>
                        </div>
                        <div class="form-group required">
                            <label for="notify_party">Notify Party</label>
                            <input type="text" class="form-control" id="notify_party" name="notify_party" required>
                        </div>
                        <div class="form-group required">
                            <label for="place_of_receipt">Place of Receipt</label>
                            <input type="text" class="form-control" id="place_of_receipt" name="place_of_receipt" required>
                        </div>
                        <div class="form-group required">
                            <label for="ocean_vessel_voy">Vessel - Voyage</label>
                            <select class="form-control" id="ocean_vessel_voy" name="ocean_vessel_voy" required>
                                <option value="" disabled selected>Choose vessel - voyage</option>
                                @foreach ($vessel_voyages as $vessel_voyage)
                                    <option value="{{ $vessel_voyage->vessel_name . '|' . $vessel_voyage->voyage }}">
                                        {{ $vessel_voyage->vessel_name . ' - ' . $vessel_voyage->voyage }}
                                    </option>
                                @endforeach
                            </select>
                        </div>                        
                        <div class="form-group required">
                            <label for="port_of_loading">Port of Loading</label>
                            <input type="text" class="form-control" id="port_of_loading" name="port_of_loading" required>
                        </div>
                        <div class="form-group required">
                            <label for="port_of_discharge">Port of Discharge</label>
                            <input type="text" class="form-control" id="port_of_discharge" name="port_of_discharge" required>
                        </div>
                        <div class="form-group required">
                            <label for="place_of_delivery">Place of Delivery</label>
                            <input type="text" class="form-control" id="place_of_delivery" name="place_of_delivery" required>
                        </div>
                        <div class="form-group required">
                            <label for="final_destination">Final Destination</label>
                            <input type="text" class="form-control" id="final_destination" name="final_destination" required>
                        </div>
                        <div class="form-group">
                            <label for="gross_weight_total">Gross Weight</label>
                            <input type="text" class="form-control" id="gross_weight_total" name="gross_weight_total" value="{{ isset($data->total_gross_weight) ? $data->total_gross_weight : '' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="measurement_total">Measurement</label>
                            <input type="text" class="form-control" id="measurement_total" name="measurement_total" value="{{ isset($data->total_measurement) ? $data->total_measurement : '' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="net_weight_total">Net Weight</label>
                            <input type="text" class="form-control" id="net_weight_total" name="net_weight_total" value="{{ isset($data->total_net_weight) ? $data->total_net_weight : '' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="total_no_of_containers">Total No. of Containers or Packages (in words)</label>
                            <input type="text" class="form-control" id="total_no_of_containers" name="total_no_of_containers" value="{{ old('total_no_of_containers', $total_no_of_containers) }}" readonly>
                        </div>
                        <div class="form-group required">
                            <label>Freight and Charges</label>
                            <div>
                                <input type="radio" id="prepaid" name="freight_and_charges" value="Prepaid" required>
                                <label for="prepaid">Prepaid</label>
                                <input type="radio" id="collect" name="freight_and_charges" value="Collect" required>
                                <label for="collect">Collect</label>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="place_date_of_issue">Place and Date of Issue</label>
                            <input type="text" class="form-control" id="place_date_of_issue" name="place_date_of_issue" required>
                        </div>
                        <div class="form-group required">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group required">
                            <label for="description_of_goods">Kind of Packages, Description of Goods</label>
                            <textarea class="form-control" id="description_of_goods" name="description_of_goods" rows="5" required></textarea>
                        </div>
                        <div class="form-group required">
                            <label for="attached_sheet_description">Description of Attached Sheet</label>
                            <textarea class="form-control" id="attached_sheet_description" name="attached_sheet_description" rows="5" required></textarea>
                        </div>
                        <div class="form-group required">
                            <label for="hs_code">HS Code</label>
                            <input type="text" class="form-control" id="hs_code" name="hs_code" required>
                        </div>
                        <div class="form-group required">
                            <label for="npwp">NPWP</label>
                            <input type="text" class="form-control" id="npwp" name="npwp" required>
                        </div>
                        <div class="form-group required">
                            <label for="no_peb">No. PEB</label>
                            <input type="text" class="form-control" id="no_peb" name="no_peb" required>
                        </div>
                        <div class="form-group required">
                            <label for="tanggal_peb">Tanggal PEB</label>
                            <input type="date" class="form-control" id="tanggal_peb" name="tanggal_peb" required>
                        </div>
                        <div class="form-group required" id="vgm-group">
                            <label for="vgm">VGM</label>
                            <input type="file" class="form-control" id="vgm" name="vgm[]" accept=".pdf" required>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="addVGM()">Add VGM</button>
                        <div class="form-group required" id="peb-group">
                            <label for="peb">PEB</label>
                            <input type="file" class="form-control" id="peb" name="peb[]" accept=".pdf" required>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="addPEB()">Add PEB</button>
                        <br>
                        <br>
                        <button type="submit" name="submit_main_form" class="btn btn-primary">Submit</button>
                        <a href="{{ route('review') }}" class="btn btn-secondary">Back</a>
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
    <!-- Logout Modal-->
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
        // Tampilkan field UN Number dan IMO Number jika tipe DG dipilih
        document.getElementById('dg').addEventListener('change', function () {
            document.getElementById('un_field').style.display = 'block';
            document.getElementById('imo_field').style.display = 'block';
        });
        document.getElementById('non-dg').addEventListener('change', function () {
            document.getElementById('un_field').style.display = 'none';
            document.getElementById('imo_field').style.display = 'none';
            document.getElementById('un_number').value = '';
            document.getElementById('imo_number').value = '';
        });

        // Tambahkan event listener untuk memastikan nilai imo_number dan un_number diatur ke string kosong jika non-dg dipilih sebelum formulir dikirim
        document.querySelector('form').addEventListener('submit', function() {
            if (document.getElementById('non-dg').checked) {
                document.getElementById('un_number').value = '';
                document.getElementById('imo_number').value = '';
            } else {
                document.getElementById('un_number').value = document.getElementById('un_number_input').value;
                document.getElementById('imo_number').value = document.getElementById('imo_number_input').value;
            }
        });

        document.getElementById('attached_sheet').addEventListener('change', function () {
            var attachedSheetField = document.getElementById('attached_sheet_field');
            if (this.checked) {
                attachedSheetField.style.display = 'block';
            } else {
                attachedSheetField.style.display = 'none';
            }
        });

        function addVGM() {
            var vgmGroup = document.getElementById('vgm-group');
            var newVGM = document.createElement('input');
            newVGM.setAttribute('type', 'file');
            newVGM.setAttribute('class', 'form-control');
            newVGM.setAttribute('name', 'vgm[]');
            newVGM.setAttribute('accept', '.pdf');
            vgmGroup.appendChild(newVGM);
        }

        function addPEB() {
            var pebGroup = document.getElementById('peb-group');
            var newPEB = document.createElement('input');
            newPEB.setAttribute('type', 'file');
            newPEB.setAttribute('class', 'form-control');
            newPEB.setAttribute('name', 'peb[]');
            newPEB.setAttribute('accept', '.pdf');
            pebGroup.appendChild(newPEB);
        }
    </script>
</body>
</html>
