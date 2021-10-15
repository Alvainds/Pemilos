<?php
include 'control.php';

if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
    header('Location:login.php');
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Tambah Data Calon</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/footers.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
</head>
<script src="vendor/ckeditor/ckeditor.js"></script>

<body>

    <!-- navbar -->

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Pemilos <span class="text-warning">Musaba</span></a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav w-100">
            <div class="nav-item text-end">
                <a class="nav-link px-3" href="logout.php">Log out</a>
            </div>
        </div>
    </header>

    <!-- Akhir navbar -->

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="index.php">
                                <i class="bi bi-house-door fs-6 pe-1"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="dataCalon.php">
                                <i class="bi bi-clipboard-data fs-6 pe-1"></i>
                                Data Calon
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dataKelas.php">
                                <i class="bi bi-bookmarks fs-6 pe-1"></i>
                                Data Kelas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="hasil_diagram.php">
                                <i class="bi bi-circle-half fs-6 pe-1"></i>
                                Hasil Pemilos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="team.php">
                                <i class="bi bi-info-circle fs-6 pe-1"></i>
                                About
                            </a>
                        </li>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                            <span>Advanced</span>
                        </h6>
                        <li class="nav-item">
                            <a class="nav-link " href="setting.php">
                                <i class="bi bi-gear fs-6 pe-1"></i>
                                Setting
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="cetak.php" target="_blank">
                                <i class="bi bi-file-pdf fs-6 pe-1"></i>
                                Cetak PDF
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="bi bi-box-arrow-left fs-6 pe-1"></i>
                                Log out</a>
                        </li>

                    </ul>

                </div>

                <div class="card p-4 m-3 text-center" href="hasil_diagram.php">
                    <p class="text-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga in unde nostrum voluptatum quam soluta assumenda voluptates! Distinctio</p>
                    <button type="button" class="btn btn-outline-dark btn-sm">Follow Us</button>
                </div>

            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h3>Dashboard Pemilos</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="dataCalon.php">Data Calon</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Data Calon</li>
                        </ol>
                    </nav>
                </div>
                <!-- Identitas Admin -->
                <form action="dataCalon.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama calon</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Calon">
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Upload Gambar</label>
                        <input class="form-control" name="gambar" type="file" id="gambar">
                    </div>
                    <div class="mb-3">
                        <label for="visi" class="form-label">Visi</label>
                        <textarea class="form-control" id="visi" name="visi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="misi" class="form-label">Misi</label>
                        <textarea class="form-control" id="misi" name="misi" rows="3"></textarea>
                    </div>
                    <a href="dataCalon.php"><button type="button" class="btn btn-outline-danger">
                            <i class="bi bi-arrow-bar-left"></i>
                            Kembali</button></a>
                    <button type="submit" class="btn btn-light text-success mx-2" name="simpanDataCalon">
                        Tambah Data Calon
                        <i class="bi bi-person-plus ps-2"></i></button>
                </form>

                <!-- Akhir Identitas Admin -->
                <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                    <div class="col-md-4 d-flex align-items-center">
                        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                            <svg class="bi" width="30" height="24">
                                <use xlink:href="#bootstrap" />
                            </svg>
                        </a>
                        <span class="text-muted">&copy; 2021 Technopark Musaba Company, Inc</span>
                    </div>

                    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                        <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-twitter fs-5"></i></a></li>
                        <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-instagram fs-5"></i></a></li>
                        <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-facebook"></i></a></li>
                    </ul>
                </footer>
            </main>
        </div>
    </div>
    <script>
        CKEDITOR.replace('misi');
        CKEDITOR.replace('visi');
    </script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
</body>

</html>