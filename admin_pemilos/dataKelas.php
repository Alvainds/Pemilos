<?php
include 'control.php';

if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
    header('Location:login.php');
    exit;
}

$query_kelas = mysqli_query($conn, "SELECT * FROM tb_kelas");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- dataTable asset -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js">
    </script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
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

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .page-link {
            color: #ffc107;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/footers.css" rel="stylesheet">
</head>

<body>

    <!-- navbar -->

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Pemilos <span class="text-warning">Musaba</span></a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


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
                            <a class="nav-link" href="dataCalon.php">
                                <i class="bi bi-clipboard-data fs-6 pe-1"></i>
                                Data Calon
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="dataKelas.php">
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
                            <li class="breadcrumb-item active">Data Kelas</li>
                        </ol>
                    </nav>
                </div>
                <!-- Tabel Data Siswa -->

                <div class="row">
                    <div class="col-md-12">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-light mb-4" data-bs-toggle="modal" data-bs-target="#tambahDataKelas">
                            <i class="bi bi-plus-square pe-2"></i>
                            Tambah Data Kelas

                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="tambahDataKelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Silahkan Tambah Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="namaKelas" class="form-label">Nama Kelas</label>
                                                <input type="text" class="form-control" name="namaKelas" id="namaKelas" onkeyup="this.value = this.value.toUpperCase() " required>
                                            </div>
                                            <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" name="pilihan_kelas">
                                                <option <?php if (isset($pilihan_kelas) && $pilihan_kelas == "X") {
                                                            echo "checked";
                                                        } ?>>X</option>
                                                <option <?php if (isset($pilihan_kelas) && $pilihan_kelas == "XI") {
                                                            echo "checked";
                                                        } ?>>XI</option>
                                                <option <?php if (isset($pilihan_kelas) && $pilihan_kelas == "XII") {
                                                            echo "checked";
                                                        } ?>>XII</option>
                                            </select>
                                            <div class="mb-3">
                                                <label for="jurusan" class="form-label">Jurusan</label>
                                                <input type="text" class="form-control" name="jurusan" id="jurusan" onkeyup="this.value = this.value.toUpperCase() " required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-outline-primary" name="simpanDataKelas">Tambah Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <h6>Table Data Kelas</h6>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover table-borderless">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th scope="col">NO</th>
                                        <th scope="col">NAMA KELAS</th>
                                        <th scope="col">KELAS</th>
                                        <th scope="col">JURUSAN</th>
                                        <th scope="col">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($query_kelas as $kelas) : ?>
                                        <tr class="text-center">
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $kelas['nama_kelas']; ?></td>
                                            <td><?= $kelas['kelas']; ?></td>
                                            <td><?= $kelas['jurusan']; ?></td>
                                            <td class="text-center">

                                                <button type="button" data-bs-toggle="modal" data-bs-target="#ubahData<?= $kelas['id_kelas']; ?>" class="btn btn-outline-light text-success btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                    Ubah</button>

                                                <!-- Modal Ubah Data -->
                                                <div class="modal fade" id="ubahData<?= $kelas['id_kelas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class=" modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="idDataKelas" value="<?= $kelas['id_kelas']; ?>">
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="namaKelas" class="form-label">Nama Kelas</label>
                                                                        <input type="text" class="form-control" name="namaKelas" id="namaKelas" onkeyup="this.value = this.value.toUpperCase() " value="<?= $kelas['nama_kelas']; ?>">
                                                                    </div>
                                                                    <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" name="kelas">
                                                                        <option value="X" <?php if ($kelas['kelas'] == "X") {
                                                                                                echo "SELECTED";
                                                                                            } ?>>X</option>
                                                                        <option value="XI" <?php if ($kelas['kelas'] == "XI") {
                                                                                                echo "SELECTED";
                                                                                            } ?>>XI</option>
                                                                        <option value="XII" <?php if ($kelas['kelas'] == "XII") {
                                                                                                echo "SELECTED";
                                                                                            } ?>>XII</option>
                                                                    </select>
                                                                    <div class="mb-3">
                                                                        <label for="jurusan" class="form-label">Jurusan</label>
                                                                        <input type="text" class="form-control" name="jurusan" id="jurusan" onkeyup="this.value = this.value.toUpperCase() " value="<?= $kelas['jurusan']; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-outline-success" name="ubahDataKelas">Ubah</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" data-bs-toggle="modal" data-bs-target="#hapusData<?= $kelas['id_kelas']; ?>" class="btn btn-outline-light text-danger btn-sm">
                                                    <i class="bi bi-x-square"></i>
                                                    Hapus</button>

                                                <!-- Modal Hapus Data -->
                                                <div class="modal fade" id="hapusData<?= $kelas['id_kelas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="idHapusDataKelas" value="<?= $kelas['id_kelas'] ?>">
                                                                <div class="modal-body">
                                                                    <p>Apakah anda yakin ingin menghapus ini?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger" name="hapusDataKelas">Hapus</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                        <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-facebook fs-5"></i></a></li>
                    </ul>
                </footer>
                <!-- Akhir Tabel Data Siswa -->
            </main>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/popper.min.js"></script>
</body>

</html>