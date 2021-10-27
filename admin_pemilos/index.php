<!doctype html>
<html lang="en">
<?php
include 'control.php';

if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
  header('Location:login.php');
  exit;
}
$query_admin = mysqli_query($conn, "SELECT * FROM data_admin WHERE username = '$_SESSION[username]' LIMIT 5");
$hasil_admin = mysqli_fetch_assoc($query_admin);

if (isset($_POST['kelas_10'])) {
  $query_siswa = mysqli_query($conn, "SELECT * FROM data_siswa 
  INNER JOIN tb_kelas ON data_siswa.kelas = tb_kelas.nama_kelas
  INNER JOIN tb_login ON data_siswa.no_induk_siswa = tb_login.no_induk_siswa WHERE tb_kelas.kelas = 'X' ");
} else if (isset($_POST['kelas_11'])) {
  $query_siswa = mysqli_query($conn, "SELECT * FROM data_siswa 
  INNER JOIN tb_kelas ON data_siswa.kelas = tb_kelas.nama_kelas
  INNER JOIN tb_login ON data_siswa.no_induk_siswa = tb_login.no_induk_siswa WHERE tb_kelas.kelas = 'XI' ");
} else if (isset($_POST['kelas_12'])) {
  $query_siswa = mysqli_query($conn, "SELECT * FROM data_siswa 
  INNER JOIN tb_kelas ON data_siswa.kelas = tb_kelas.nama_kelas
  INNER JOIN tb_login ON data_siswa.no_induk_siswa = tb_login.no_induk_siswa WHERE tb_kelas.kelas = 'XII' ");
} else {
  $query_siswa = mysqli_query($conn, "SELECT * FROM data_siswa 
INNER JOIN tb_kelas ON data_siswa.kelas = tb_kelas.nama_kelas
INNER JOIN tb_login ON data_siswa.no_induk_siswa = tb_login.no_induk_siswa WHERE tb_kelas.kelas = 'X' ");
}

?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Technopark Pemilos</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/footers/">

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/footers.css" rel="stylesheet">

  <!-- dataTable asset -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">

  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js">
  </script>
  <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>

  <title>Document</title>
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

    .no-focus:focus {
      outline: none;
      box-shadow: none;
      border: 1px solid #ced4da;
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

    .data-pemilos:hover {
      background-color: white !important;
      border: 1px solid silver !important;
    }

    .border-5 {
      border-radius: 5px;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="css/dashboard.css" rel="stylesheet">
</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Pemilos <span class="text-warning">Musaba</span></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">
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
          <h5>Selamat Datang <span class="text-warning"><?= $hasil_admin['username']; ?></span> </h5>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">Home</li>
            </ol>
          </nav>
        </div>

        <?php
        // count total belum memilih
        $query_all = mysqli_query($conn, "SELECT count(pemilos) FROM data_siswa");
        $all = mysqli_fetch_assoc($query_all);

        // count total belum memilih
        $query_belum = mysqli_query($conn, "SELECT count(pemilos) FROM data_siswa WHERE pemilos = 'belum memilih'");
        $belum = mysqli_fetch_assoc($query_belum);

        // count total belum memilih
        $query_sudah = mysqli_query($conn, "SELECT count(pemilos) FROM data_siswa WHERE pemilos = 'sudah memilih'");
        $sudah = mysqli_fetch_assoc($query_sudah);
        ?>
        <div class="row mb-3">
          <div class="col-md">
            <span class="text-muted">Data Spesific :</span>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md mb-3">
            <div class="card p-3 bg-light border-0 border-start border-5 border-warning data-pemilos">
              <div class="row">
                <div class="col-3 d-flex justify-content-center align-items-center"><i class="bi bi-person fs-1 text-warning"></i></div>
                <div class="col-7">
                  <div class="card-title">
                    <span>Total Siswa</span>
                    <h5>
                      <?= $all['count(pemilos)']; ?>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md mb-3">
            <div class="card p-3 bg-light border-0 border-start border-5 border-success data-pemilos ">
              <div class="row">
                <div class="col-3 d-flex justify-content-center align-items-center"><i class="bi bi-person-check fs-1 text-success"></i></div>
                <div class="col-7">
                  <div class="card-title">
                    <span>Siswa sudah memilih</span>
                    <h5>
                      <?= $sudah['count(pemilos)']; ?>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md mb-3">
            <div class="card p-3 bg-light border-0 border-start border-5 border-danger data-pemilos">
              <div class="row">
                <div class="col-3 d-flex justify-content-center align-items-center"><i class="bi bi-person-x fs-1 text-danger"></i></div>
                <div class="col-7">
                  <div class="card-title">
                    <span>Siswa belum memilih</span>
                    <h5>
                      <?= $belum['count(pemilos)']; ?>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>




        <div class="row">
          <div class="col-md-12">
            <!-- Modal -->
            <div class="modal fade" id="tambahDataSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Silahkan Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="" method="POST">
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="no_induk" class="form-label">No.Induk Siswa</label>
                        <input type="text" pattern="\d*" class="form-control mb-2" maxlength="5" id="no_induk" name="no_induk" placeholder="Masukkan No.Induk Siswa" required>
                        <span class="text-muted">Format harus berupa number</span>
                      </div>
                      <div class="mb-3">
                        <label for="nama" class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Siswa" required>
                      </div>
                      <div class="mb-3">
                        <label for="namaKelas" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="namaKelas" name="namaKelas" placeholder="Masukkan Nama Kelas" onkeyup="this.value = this.value.toUpperCase() " required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-dark" name="simpanDataSiswa">Tambah Data</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="row">
                  <span class="mx-2 mb-3 text-muted">Tools</span>
                </div>
                <form action="" method="POST">
                  <button type="button" class="btn btn-light mb-3 mx-2" data-bs-toggle="modal" data-bs-target="#tambahDataSiswa">
                    <i class="bi bi-person-plus"> </i>
                    Tambah Data Siswa
                  </button>
                  <a href="importData.php">
                    <button type="button" class="btn btn-light mb-3 mx-2">
                      <i class="bi bi-layout-sidebar-inset"></i>
                      Import Data</button>
                  </a>
                </form>
              </div>
              <div class="col-md">
                <div class="row">
                  <span class="mx-2 mb-3 text-muted">Export Data Kelas</span>
                </div>
                <form action="control.php" method="POST">
                  <button type="submit" name="downloadX" class="btn btn-light mb-3 mx-2">
                    X
                  </button>
                  <button type="submit" name="downloadXI" class="btn btn-light mb-3 mx-2">
                    XI
                  </button>
                  <button type="submit" name="downloadXII" class="btn btn-light mb-3 mx-2">
                    XII
                  </button>
                </form>
              </div>
            </div>
            <h6 class="mb-3">Table Siswa</h6>

            <form action="" method="post">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button type="submit" name="kelas_10" class="nav-link
                  <?php if (isset($_POST['kelas_10'])) {
                    echo "active";
                  } else if (!isset($_POST['kelas_11']) && !isset($_POST['kelas_12'])) {
                    echo "active";
                  } ?>" id="X-tab" data-bs-toggle="tab" data-bs-target="#X" type="button" role="tab" aria-controls="X" aria-selected="true">Kelas X</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button type="submit" name="kelas_11" class="nav-link 
                  <?php if (isset($_POST['kelas_11'])) {
                    echo "active";
                  } ?>"" id=" X-tab" data-bs-toggle="tab" data-bs-target="#X" type="button" role="tab" aria-controls="X" aria-selected="true">Kelas XI</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button type="submit" name="kelas_12" class="nav-link 
                  <?php if (isset($_POST['kelas_12'])) {
                    echo "active";
                  } ?>"" id=" X-tab" data-bs-toggle="tab" data-bs-target="#X" type="button" role="tab" aria-controls="X" aria-selected="true">Kelas XII</button>
                </li>
              </ul>
            </form>
            <!-- hapus semua data -->
            <div class="row">
              <div class="col-md-12">
                <button type="button" data-bs-toggle="modal" data-bs-target="#hapusSemuaData" class="btn btn-outline-light text-danger my-3 btn-sm">
                  <i class="bi bi-trash"></i>
                  Hapus Semua Data</button>
              </div>
            </div>

            <!-- Modal Hapus Semua Data -->
            <div class="modal fade" id="hapusSemuaData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="" method="POST">
                    <div class="modal-body">
                      <p>Apakah anda yakin ingin menghapus Semua Data ?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger" name="hapusSemuaData">Hapus</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- end hapus semua data -->

            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="X" role="tabpanel" aria-labelledby="X-tab">
                <div class="table-responsive">
                  <table id="myTable" class="table table-hover table-borderless" style="width:100%">
                    <thead class="table-dark">
                      <tr>
                        <th>No</th>
                        <th>No.Induk</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Pemilos</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      <?php if (mysqli_num_rows($query_siswa)) : ?>
                        <?php foreach ($query_siswa as $siswa) : ?>
                          <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $siswa['no_induk_siswa']; ?></td>
                            <td class="text-start"><?= $siswa['nama']; ?></td>
                            <td><?= $siswa['nama_kelas']; ?></td>
                            <td><?= $siswa['pemilos']; ?></td>
                            <td>
                              <button type="button" data-bs-toggle="modal" data-bs-target="#ubahData<?= $siswa['id_siswa']; ?>" class="btn btn-outline-light text-success btn-sm">
                                <i class="bi bi-pencil-square"></i>
                                Ubah</button>

                              <!-- Modal Ubah Data -->
                              <div class="modal fade" id="ubahData<?= $siswa['id_siswa']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST">
                                      <input type="hidden" name="idLogin" value="<?= $siswa['id_login']; ?>">
                                      <input type="hidden" name="idDataSiswa" value="<?= $siswa['id_siswa']; ?>">
                                      <div class="modal-body">
                                        <div class="mb-3">
                                          <label for="no_induk" class="form-label mb-2">No.Induk</label>
                                          <input type="text" class="form-control" pattern="\d*" maxlength="5" id="no_induk" name="no_induk" value="<?= $siswa['no_induk_siswa']; ?>">
                                          <span class="text-muted">Format harus berupa number</span>

                                        </div>
                                        <div class="mb-3">
                                          <label for="nama" class="form-label">Nama Siswa</label>
                                          <input type="text" class="form-control" id="nama" name="nama" value="<?= $siswa['nama']; ?>">
                                        </div>
                                        <div class="mb-3">
                                          <label for="namaKelas" class="form-label">Nama Kelas</label>
                                          <input type="text" class="form-control" id="namaKelas" name="namaKelas" value="<?= $siswa['nama_kelas']; ?>">
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-dark" name="ubahDataSiswa">Ubah</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>

                              <button type="button" data-bs-toggle="modal" data-bs-target="#hapusData<?= $siswa['id_siswa']; ?>" class="btn btn-outline-light text-danger btn-sm">
                                <i class="bi bi-trash"></i>
                                Hapus</button>

                              <!-- Modal Hapus Data -->
                              <div class="modal fade" id="hapusData<?= $siswa['id_siswa']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST">
                                      <input type="hidden" name="idHapusDataSiswa" value="<?= $siswa['id_siswa']; ?>">
                                      <input type="hidden" name="idHapusLogin" value="<?= $siswa['id_login']; ?>">
                                      <div class="modal-body">
                                        <p>Apakah anda yakin ingin menghapus ini?</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" name="hapusDataSiswa">Hapus</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
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
      </main>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>


  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
  </script>
  <script src="js/dashboard.js"></script>


</body>

</html>