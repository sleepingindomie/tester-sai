<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Docsys - Login</title>

    <link rel="icon" href="https://www.samudera.id/public_assets/img/logo-ico.jpg" type="image/x-icon">
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .bg-login-image {
            background: url('https://www.samudera.id/public_assets/1/uploads/20220624020710Logo_Samudera_Putih_438_x_70-01.png') no-repeat center center;
            background-size: contain;
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #1d3557 0%, #457b9d 100%);
            color: white;
        }

        .btn-custom {
            border-radius: 2rem;
            background-color: #e63946;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #d62828;
        }

        .login-logo {
            max-width: 100%;
            max-height: 100%;
        }

        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .logo-side {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-side {
            padding: 2rem;
        }

        header, footer {
            background-color: #14213d;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }

        body {
            background: linear-gradient(to right, #1d3557, #457b9d);
            font-family: 'Roboto', sans-serif;
        }
    </style>

    <script>
        function showError(message) {
            alert(message);
        }
    </script>

</head>

<body>

    <header>
        <h1>PT Samudera Indonesia Tbk</h1>
    </header>

    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="card o-hidden border-0 shadow-lg my-5 card-custom">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12 form-side">
                                <div class="login-container">
                                    <div class="logo-side">
                                        <img src="https://www.samudera.id/public_assets/img/logo2x.png" alt="Logo" class="login-logo">
                                    </div>
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 mb-4">Login Docsys</h1>
                                        </div>
                                        @if ($errors->any())
                                            <script>showError('{{ $errors->first() }}');</script>
                                        @endif
                                        <form class="user" action="/login" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="exampleInputUsername" name="username" placeholder="Enter Username..." required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block btn-custom">
                                                Login
                                            </button>
                                        </form>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>Copyright &copy; Dp 2024</p>
    </footer>

    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/js/sb-admin-2.min.js"></script>

</body>

</html>
