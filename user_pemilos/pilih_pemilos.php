<?php
include 'control.php';
if (!isset($_SESSION['no_induk']) && !isset($_SESSION['password'])) {
    header('Location:login.php');
    exit;
}

$query_calon = mysqli_query($conn, "SELECT * FROM data_calon");

$query_siswa = mysqli_query($conn, "SELECT * FROM tb_login 
INNER JOIN data_siswa ON tb_login.no_induk_siswa = data_siswa.no_induk_siswa
INNER JOIN tb_kelas ON data_siswa.kelas = tb_kelas.nama_kelas
WHERE data_siswa.no_induk_siswa = '$_SESSION[no_induk]' ");
$hasil_siswa = mysqli_fetch_assoc($query_siswa);
$kelas = $hasil_siswa['kelas'];

if ($hasil_siswa['pemilos'] == 'sudah memilih') {
    header('Location:home.php');
    exit;
}

$query_vote = mysqli_query($conn, "SELECT * FROM tb_vote WHERE class = '$kelas'");
$total_vote = mysqli_fetch_assoc($query_vote);

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/pemilos.css" rel="stylesheet">


    <title>Halaman voting</title>

    <style>
        .card {

            border-radius: 20px;
        }

        .vote {
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
        }

        .info {
            border-top-left-radius: 20px;
            border-top-right-radius: 0px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 0px;
        }

        img {
            clip-path: circle();
            float: left;
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-white">
    <div class="container px-4 my-3">
        <div class="row">
            <div class="col-3">
                <a href="home.php" class="fw-bold text-decoration-none text-dark fs-5"><i class="bi bi-chevron-left"></i></a>
            </div>
            <div class="col-9">
                <h5 class=" mx-2"> Pilih Calon Anda</h5>
            </div>

        </div>
    </div>


    <div class="container mt-2 pb-3">
        <form action="" method="POST">
            <div class="row">
                <?php foreach ($query_calon as $calon) : ?>

                    <div class="modal fade" id="pilih<?= $calon['id_calon']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pilih Vote</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST">
                                    <input type="hidden" name="vote" value="<?= $calon['id_calon']; ?>">
                                    <div class="modal-body">
                                        <p>Apakah anda yakin ingin memilih</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="vote" class="btn btn-danger" name="hapusDataSiswa" value="<?= mysqli_real_escape_string($conn, $calon['id_calon']); ?>">Pilih</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm d-flex pb-3">
                        <div class="card card-body m-2 align-items-center flex-fill border-0 bg-light" style="width: 19rem">
                            <h5 class="pt-3 pb-3 text-center"><?= $calon['nama_calon']; ?></h5>
                            <div class="line border border-2 rounded-circle">
                                <img class="circle" src="../img_calon/<?= $calon['gambar_calon']; ?>" class="card-img-top" alt="gambar-calon">
                            </div>
                            <div class="card-body text-center my-3">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-warning px-5 py-2 info" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $calon['id_calon']; ?>">Details</button>
                                    <?php if ($total_vote['status'] == 'enable') : ?>
                                        <button type="button" name="vote" class="btn btn-warning px-5 vote" data-bs-toggle="modal" data-bs-target="#pilih<?= $calon['id_calon']; ?>">Pilih</button>
                                    <?php else : ?>
                                        <button type="button" class=" btn btn-secondary px-5 vote" disabled>Disable</button>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $calon['id_calon']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                    <button type="button" class="btn-outline-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Visi</p>
                                    <p><?= $calon['visi']; ?></p>
                                    <p>Misi</p>
                                    <p><?= $calon['misi']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>




    <script src=" js/bootstrap.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
</body>

</html>