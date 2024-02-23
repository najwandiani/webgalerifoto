<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Galeri Najwa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/mycss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .komentar {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        /* Gaya untuk form komentar */
        .komentar form textarea {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .komentar form button {
            padding: 5px 10px;
            background-color: var(--third);
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        /* Gaya untuk daftar komentar */
        .daftar-komentar {
            margin-top: 10px;
        }

        /* Gaya untuk setiap item komentar */
        .komentar-item {
            margin-bottom: 10px;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        .komentar-item p {
            margin: 0;
        }

        .komentar-tanggal {
            font-size: 12px;
            color: #888;
        }

        /* Gaya untuk Tombol Like */
        .btn-like {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }

        /* Gaya untuk Jumlah Like */
        .like-count {
            margin-left: 10px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <header>
        <div class="container">
            <h1>
                <a href="index.php">SUPER FOOD</a>
            </h1>
            <ul>
                <?php if (!isset($_SESSION["status_login"])) : ?>
                    <li><a href="registrasi.php">Registrasi</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php else : ?>
                    <li><a href="profil.php">Profile</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="galeri.php">Galeri</a></li>
                    <li><a href="keluar.php">Keluar</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>
    <section id="content" class="container">