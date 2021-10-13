<?php
include 'control.php';
if (!isset($_SESSION['no_induk']) && !isset($_SESSION['password'])) {
    header('Location:login.php');
}

$query_calon = mysqli_query($conn, "SELECT * FROM data_calon");

$result = mysqli_query($conn, 'SELECT SUM(jumlah_vote) AS value_sum FROM data_calon');
$row = mysqli_fetch_assoc($result);
$sum = $row['value_sum'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Pemilos | Diagram</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/pemilos.css" rel="stylesheet">
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

        .round-bottom {
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .round-3 {
            border-radius: 20px 20px 20px 20px;
        }

        .calon img {
            margin: auto;
            width: 200px;
        }

        .calon .card {
            margin: auto;
            width: 18rem;
            border-radius: 20px;
        }

        img {
            clip-path: circle();
            width: 85px;
            height: 85px;
            object-fit: cover;
        }

        .data-calon:hover {
            background-color: #f8f9fa !important;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
</head>

<body>

    <!-- navbar -->

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
                            <a class="nav-link" href="dataKelas.php">
                                <i class="bi bi-bookmarks fs-6 pe-1"></i>
                                Data Kelas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="hasil_diagram.php">
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
                            <li class="breadcrumb-item">Diagram</li>

                        </ol>
                    </nav>
                </div>
                <div class="row d-flex justify-content-center mx-2">
                    <div class="col-md bg-light round-3 border bg-white p-3">
                        <center>
                            <canvas id="myChart" width=340" height=340"></canvas>
                        </center>

                    </div>
                </div>
                <div class="row px-3 mt-3">
                    <h6>List Calon</h6>

                </div>
                <?php foreach ($query_calon as $calon) : ?>
                    <?php
                    if ($sum == 0) {
                        $total = $calon['jumlah_vote']  * 100;
                    } else {
                        $total = $calon['jumlah_vote'] / $sum * 100;
                    }

                    ?>
                    <div class="row text">
                        <div class="col p-3 bg-light m-3 round-3 bg-white border data-calon">
                            <div class="row">
                                <div class="col-3 ">
                                    <div class="row d-flex justify-content-center align-content-center">
                                        <img style="max-width: 135px;" src="../img_calon/<?= $calon['gambar_calon']; ?>">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        <h6 class=""><?= $calon['nama_calon']; ?><h6>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar bg-dark" role="progressbar" style="width: <?= $total ?>%" aria-valuenow="<?= $calon['jumlah_vote']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>

                                                <!-- trigger change vote -->
                                                <p style="cursor:default" type="button" data-bs-toggle="modal" data-bs-target="#calon<?= $calon['id_calon'] ?>" class="fs-6 mb-0"><?= $calon['jumlah_vote'] ?> Orang</p>
                                                <!-- end trigger change vote -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- change vote modal-->
                        <div class="modal fade" id="calon<?= $calon['id_calon'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Jumlah Vote</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <input type="hidden" name="idCalon" value="<?= $calon['id_calon'] ?>">
                                                <label for="jumlahvote" class="form-label">Jumlah Vote <?= $calon['nama_calon'] ?></label>
                                                <input type="number" name="valueVote" value="<?= $calon['jumlah_vote'] ?>" class="form-control" id="jumlahvote" aria-describedby="emailHelp">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="change_vote" class="btn btn-dark">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end change vote modal-->

                    </div>
                <?php endforeach; ?>
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

    <!-- Akhir navbar -->



    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [<?php
                            $query = "select * from data_calon";
                            $result = mysqli_query($conn, $query);
                            while ($value = mysqli_fetch_assoc($result)) {
                            ?> '<?= $value['nama_calon']; ?>',
                    <?php } ?>
                ],
                datasets: [{
                    label: '# of Tomatoes',
                    data: [<?php
                            $query = "select * from data_calon";
                            $result = mysqli_query($conn, $query);
                            while ($value = mysqli_fetch_assoc($result)) {
                            ?> <?= $value['jumlah_vote']; ?>,
                        <?php } ?>
                    ],
                    backgroundColor: [
                        '#ffd726',
                        '#2e2e2e',
                        '#0f6ea6',
                        '#a6283d'
                    ],
                    borderColor: [
                        '#ffaf26',
                        '#121212',
                        '#083f5e',
                        '#570d19'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                //cutoutPercentage: 40,
                responsive: false,

            }
        });
    </script>
</body>

</html>