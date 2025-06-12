<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Docsys - Review</title>

    <link rel="icon" href="https://www.samudera.id/public_assets/img/logo-ico.jpg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    </head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.html">
                <div class="sidebar-brand-icon">
                    <i class="fa-solid fa-file-invoice"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Docsys</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="dashboard.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Buat Akun</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="review.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Review</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-ship"></i>
                    <span>Vessel</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Input Data</span>
                </a>
            </li>
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
                                    Nama Admin
                                    <span class="text-gray-600 mx-2">|</span>
                                    <span class="text-gray-600 small">Superadmin</span>
                                </span>
                                <img class="img-profile rounded-circle" src="https://placehold.co/60x60/4e73df/ffffff?text=A">
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

                    <h1 class="h3 mb-2 text-gray-800">Tabel Review BL</h1>
                    <p class="mb-4">BL yang sudah dikirim</p>

                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <select id="vesselFilter" class="form-control">
                                <option value="">Select Vessel</option>
                                <option value="MV. MAERSK">MV. MAERSK</option>
                                <option value="MV. EVERGREEN">MV. EVERGREEN</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select id="voyageFilter" class="form-control">
                                <option value="">Select Voyage</option>
                                <option value="V123">V123</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Review BL</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>BL</th>
                                            <th>Vessel - Voyage</th>
                                            <th>Shipper</th>
                                            <th>Status</th>
                                            <th>PEB</th>
                                            <th>VGM</th>
                                            <th>Progress</th>
                                            <th>Dibuat Pada</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#" class="view-container">BL12345</a></td>
                                            <td>MV. MAERSK - V123</td>
                                            <td>PT. CONTOH SEJAHTERA</td>
                                            <td>Unlocked <i class="fas fa-lock-open"></i></td>
                                            <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#fileModal">View PEB</button></td>
                                            <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#fileModal">View VGM</button></td>
                                            <td><i class="fas fa-check text-success"></i> Completed</td>
                                            <td>2024-06-12 10:30</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm">View BL</a>
                                                <button type="submit" class="btn btn-warning btn-sm">Lock</button>
                                            </td>
                                        </tr>
                                        <tr style="background-color: #ffe6e6;">
                                            <td><a href="#" class="view-container">BL67890</a></td>
                                            <td>MV. EVERGREEN - V456</td>
                                            <td>CV. MAJU JAYA ABADI</td>
                                            <td>Locked <i class="fas fa-lock"></i></td>
                                            <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#fileModal">View PEB</button></td>
                                            <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#fileModal">View VGM</button></td>
                                            <td><i class="fas fa-edit text-warning"></i> Edited</td>
                                            <td>2024-06-11 15:00</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm">View BL</a>
                                                <button type="submit" class="btn btn-success btn-sm">Unlock</button>
                                            </td>
                                        </tr>
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

    <div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fileModalLabel">File Viewer</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>Fungsi ini membutuhkan backend untuk mengambil daftar file.</p>
                    <div id="fileListContainer" class="list-group mb-3"></div>
                    <iframe id="fileViewer" width="100%" height="500px" style="border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="containerModal" tabindex="-1" role="dialog" aria-labelledby="containerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="containerModalLabel">Container Detail</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                     <p>Fungsi ini membutuhkan backend untuk mengambil detail kontainer.</p>
                    <div id="containerDetail" class="table-responsive"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        // FUNGSI-FUNGSI DI BAWAH INI MEMBUTUHKAN BACKEND (SERVER-SIDE CODE)
        // MEREKA TIDAK AKAN BEKERJA SECARA PENUH DI FILE HTML STATIS
        // Kode ini dipertahankan untuk referensi logika Anda.

        // Inisialisasi DataTable
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();
            
            // Logika untuk filter. Ini akan mencoba memanggil 'get_voyages' yang tidak ada di situs statis.
            $('#vesselFilter').on('change', function() {
                var vesselName = $(this).val();
                console.log("Filter vessel dipilih:", vesselName);
                // Di situs statis, kita hanya bisa filter berdasarkan data yang sudah ada di tabel
                // Fungsi AJAX di bawah ini tidak akan berfungsi.
                /*
                if(vesselName) {
                    $.ajax({
                        url: 'get_voyages', // URL ini tidak akan ditemukan
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
                */
            });

            $('#voyageFilter').on('change', function() {
                table.column(1).search($(this).val()).draw();
            });
        });

        // Logika untuk menampilkan file di modal. Ini memanggil 'view_file' yang tidak ada.
        $('#fileModal').on('show.bs.modal', function (event) {
            console.log("Tombol 'View File' diklik, tapi backend tidak tersedia.");
            var modal = $(this);
            modal.find('.modal-body #fileListContainer').html('<p class="text-danger">Fungsi ini membutuhkan koneksi ke server.</p>');
        });

        // Logika untuk menampilkan detail kontainer. Ini memanggil 'view_container' yang tidak ada.
        $(document).on('click', '.view-container', function() {
            console.log("Tombol 'View Container' diklik, tapi backend tidak tersedia.");
            $('#containerDetail').html('<p class="text-danger">Fungsi ini membutuhkan koneksi ke server.</p>');
            $('#containerModal').modal('show');
        });

    </script>
</body>

</html>
