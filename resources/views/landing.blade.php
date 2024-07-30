<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Docsys</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />

    <link rel="icon" href="https://www.samudera.id/public_assets/img/logo-ico.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://www.samudera.id/public_assets/1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://www.samudera.id/public_assets/1/css/et-line-icons.css" />
    <link rel="stylesheet" href="https://www.samudera.id/public_assets/1/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://www.samudera.id/public_assets/1/css/themify-icons.css">
    <link rel="stylesheet" href="https://www.samudera.id/public_assets/1/css/style.css" />
    <link rel="stylesheet" href="https://www.samudera.id/public_assets/1/css/responsive.css" />
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Arial', sans-serif;
            color: white;
            text-align: center;
            overflow: hidden;
        }
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            z-index: -1;
            transition: background-image 1s ease-in-out;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        .logo {
            height: 70px;
        }
        .buttons {
            display: flex;
            gap: 10px;
        }
        .buttons a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border: 2px solid white;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }
        .buttons a:hover {
            background: white;
            color: black;
        }
        .content {
            position: relative;
            top: 45%;
            transform: translateY(-100%);
        }
        .footer {
            position: absolute;
            bottom: 0px;
            width: 100%;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div id="background" class="background"></div>
    <div class="overlay"></div>
    <header>
        <img src="https://www.samudera.id/public_assets/1/uploads/20220624020710Logo_Samudera_Putih_438_x_70-01.png" alt="Logo" class="logo">
        <div class="buttons">
            <a href="login">Login</a>
        </div>
    </header>
    <div class="content">
        <h1>Docsys</h1>
        <p>Welcome to PT Samudera Indonesia Tbk</p>
    </div>
    <div class="footer">
        <p>Copyright © Dp 2024</p>
    </div>
    <script>
        const images = [
            '/img/samudera1.jpg',
            '/img/samudera2.jpg',
            '/img/samudera3.jpg'
        ];
        let currentImageIndex = 0;
        const backgroundElement = document.getElementById('background');

        // Preload images
        const preloadedImages = [];
        images.forEach((src) => {
            const img = new Image();
            img.src = src;
            preloadedImages.push(img);
        });

        function changeBackground() {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            backgroundElement.style.backgroundImage = `url(${images[currentImageIndex]})`;
        }

        // Set initial background image
        backgroundElement.style.backgroundImage = `url(${images[currentImageIndex]})`;

        setInterval(changeBackground, 5000); // Ganti gambar setiap 5 detik
    </script>
</body>
</html>
