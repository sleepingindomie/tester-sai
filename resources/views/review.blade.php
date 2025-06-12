<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Docsys - Review</title>

    <!-- Custom fonts for this template -->
    <link rel="icon" href="https://www.samudera.id/public_assets/img/logo-ico.jpg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="main">
                <div class="sidebar-brand-icon">
                    <i class="fa-solid fa-file-invoice"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Docsys</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="main">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
            <!-- Nav Item - Buat Akun -->
            <li class="nav-item">
                <a class="nav-link" href="account">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Buat Akun</span>
                </a>
            </li>

            <!-- Nav Item - Review -->
            <li class="nav-item active">
                <a class="nav-link" href="review">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Review</span>
                </a>
            </li>

            <!-- Nav Item - Vessel -->
            <li class="nav-item">
                <a class="nav-link" href="vessel">
                    <i class="fas fa-fw fa-ship"></i>
                    <span>Vessel</span>
                </a>
            </li>
            @endif

            @if(Auth::user()->role == 'customer')
            <!-- Nav Item - Input Data -->
            <li class="nav-item">
                <a class="nav-link" href="input">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Input Data</span>
                </a>
            </li>

            <!-- Nav Item - Review -->
            <li class="nav-item active">
                <a class="nav-link" href="review">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Review</span>
                </a>
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
                    <h1 class="h3 mb-2 text-gray-800">Tabel Review BL</h1>
                    <p class="mb-4">BL yang sudah dikirim </p>

                    @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                    <!-- Dropdown Filters -->
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <select id="vesselFilter" class="form-control">
                                <option value="">Select Vessel</option>
                                @foreach($vessels_data as $vessel)
                                <option value="{{ $vessel->vessel_name }}">{{ $vessel->vessel_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select id="voyageFilter" class="form-control">
                                <option value="">Select Voyage</option>
                                <!-- Voyages akan diisi melalui JavaScript -->
                            </select>
                        </div>
                    </div>
                    @endif

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Review BL </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>BL</th>
                                            @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                            <th>Vessel - Voyage</th>
                                            <th>Shipper</th>
                                            @else
                                            <th>HS Code</th>
                                            <th>NPWP</th>
                                            <th>Tanggal PEB</th>
                                            <th>No. PEB</th>
                                            @php
                                            $imo_number_exists = false;
                                            $un_number_exists = false;
                                            @endphp
                                            @foreach($result as $row)
                                                @if(!empty($row->imo_number))
                                                    @php $imo_number_exists = true; @endphp
                                                @endif
                                                @if(!empty($row->un_number))
                                                    @php $un_number_exists = true; @endphp
                                                @endif
                                            @endforeach
                                            @if($imo_number_exists)
                                            <th>IMO Number</th>
                                            @endif
                                            @if($un_number_exists)
                                            <th>UN Number</th>
                                            @endif
                                            @endif
                                            <th>Status</th>
                                            <th>PEB</th>
                                            <th>VGM</th>
                                            <th>Progress</th>
                                            <th>Dibuat Pada</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($result as $row)
                                            @php
                                            $row_class = $row->progress == 'Edited' ? 'style="background-color: #ffe6e6;"' : '';
                                            @endphp
                                            <tr {!! $row_class !!}>
                                                <td><a href="#" class="view-container" data-id="{{ $row->id }}">{{ $row->bl }}</a></td>
                                                @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                                    <td>{{ $row->ocean_vessel }}</td>
                                                    @php
                                                        $shipper_words = explode(' ', $row->shipper);
                                                        $limited_shipper = implode(' ', array_slice($shipper_words, 0, 4));
                                                    @endphp
                                                    <td>{{ $limited_shipper }}</td>
                                                @else
                                                    <td>{{ $row->hs_code }}</td>
                                                    <td>{{ $row->npwp }}</td>
                                                    <td>{{ $row->tanggal_peb }}</td>
                                                    <td>{{ $row->no_peb }}</td>
                                                    @if($imo_number_exists)
                                                        <td>{{ $row->imo_number }}</td>
                                                    @endif
                                                    @if($un_number_exists)
                                                        <td>{{ $row->un_number }}</td>
                                                    @endif
                                                @endif
                                                <td>{!! $row->locked ? 'Locked <i class="fas fa-lock"></i>' : 'Unlocked <i class="fas fa-lock-open"></i>' !!}</td>
                                                <td>
                                                    @if($row->source == 'edited')
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#fileModal" data-file="peb" data-bl="{{ $row->bl }}" data-source="edited">View edited PEB</button>
                                                    @else
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#fileModal" data-file="peb" data-bl="{{ $row->bl }}" data-source="original">View PEB</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($row->source == 'edited')
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#fileModal" data-file="vgm" data-bl="{{ $row->bl }}" data-source="edited">View edited VGM</button>
                                                    @else
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#fileModal" data-file="vgm" data-bl="{{ $row->bl }}" data-source="original">View VGM</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($row->progress))
                                                        @if($row->progress == 'Edited')
                                                            <i class="fas fa-edit text-warning"></i> Edited
                                                        @elseif($row->progress == 'Pending')
                                                            <i class="fas fa-clock text-warning"></i> Pending
                                                        @else
                                                            <i class="fas fa-check text-success"></i> Completed
                                                        @endif
                                                    @else
                                                        <i class="fas fa-check text-success"></i> Completed
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    @if($row->locked)
                                                        <a href="{{ route('notfound') }}" class="btn btn-primary btn-sm">View BL</a>
                                                    @else
                                                        <a href="view?id={{ $row->id }}&source={{ $row->source }}" class="btn btn-primary btn-sm">View BL</a>
                                                    @endif
                                                    @if(Auth::user()->role == 'customer' && !$row->locked)
                                                        <a href="{{ route('notfound') }}" class="btn btn-secondary btn-sm">Edit</a>
                                                    @elseif(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                                        <form method="POST" action="{{ route('lock_unlock') }}" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                                            <input type="hidden" name="action" value="{{ $row->locked ? 'unlock' : 'lock' }}">
                                                            <button type="submit" class="btn btn-{{ $row->locked ? 'success' : 'warning' }} btn-sm">
                                                                {{ $row->locked ? 'Unlock' : 'Lock' }}
                                                            </button>
                                                        </form>
                                                        @if($row->progress != 'Completed')
                                                            <form method="POST" action="{{ route('confirm_progress') }}" style="display:inline;">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                                <input type="hidden" name="source" value="{{ $row->source }}">
                                                                <button type="submit" class="btn btn-success btn-sm">Confirm Completed</button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                </td>                                            
                                            </tr>
                                        @endforeach
                                    </tbody>                                                                             
                                </table>
                            </div>
                        </div>
                    </div>

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

    <!-- File Modal-->
    <div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">File Viewer</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="fileListContainer" class="list-group mb-3">
                        <!-- Daftar file akan dimuat di sini -->
                    </div>
                    <iframe id="fileViewer" width="100%" height="500px" src="" style="border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Container Detail Modal-->
    <div class="modal fade" id="containerModal" tabindex="-1" role="dialog" aria-labelledby="containerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="containerModalLabel">Container Detail</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="containerDetail" class="table-responsive">
                        <!-- Detail container akan dimuat di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

<script>
    $('#fileModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var fileType = button.data('file'); // Extract info from data-* attributes
    var bl = button.data('bl'); // Extract BL number
    var source = button.data('source'); // Extract source (original or edited)
    var modal = $(this);
    var fileListContainer = document.getElementById('fileListContainer');
    var fileViewer = document.getElementById('fileViewer');

    // Request daftar file dari view_file
    fetch('view_file?file=' + fileType + '&bl=' + bl + '&source=' + source)
        .then(response => response.json())
        .then(data => {
            fileListContainer.innerHTML = data;
            fileViewer.src = ""; // Clear the iframe source
        })
        .catch(error => {
            fileListContainer.innerHTML = '<p class="list-group-item list-group-item-danger">Error loading files.</p>';
        });
    });

    // Event delegation for clicking file links
    document.getElementById('fileListContainer').addEventListener('click', function(event) {
        if (event.target.tagName === 'A') {
            event.preventDefault();
            var filePath = event.target.getAttribute('href');
            document.getElementById('fileViewer').src = filePath;
        }
    });

    $(document).on('click', '.view-container', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'view_container/' + id,
            method: 'GET',
            success: function(response) {
                $('#containerDetail').html(response);
                $('#containerModal').modal('show');
            }
        });
    });

    $('#containerModal').on('hidden.bs.modal', function () {
        $('#containerDetail').html('');
    });

    $(document).ready(function() {
        var table = $('#dataTable').DataTable();

        // Apply the filter
        $('#vesselFilter').on('change', function() {
            var vesselName = $(this).val();
            if(vesselName) {
                $.ajax({
                    url: 'get_voyages',
                    type: 'GET',
                    data: {vessel_name: vesselName},
                    success: function(data) {
                        $('#voyageFilter').html(data);
                        table.column(1).search('').draw();
                    }
                });
            } else {
                $('#voyageFilter').html('<option value="">Select Voyage</option>');
                table.column(1).search('').draw();
            }
        });

        $('#voyageFilter').on('change', function() {
            table.column(1).search($(this).val()).draw();
        });
    });
</script>

</body>

</html>
