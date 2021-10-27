<?php
include 'control.php';
if (!isset($_SESSION['no_induk']) && !isset($_SESSION['password'])) {
    header('Location:login.php');
    exit;
}

$query_calon = mysqli_query($conn, "SELECT * FROM data_calon");

$query_chart = mysqli_query($conn, "SELECT * FROM tb_chart");
$chart = mysqli_fetch_assoc($query_chart);


$result = mysqli_query($conn, 'SELECT SUM(jumlah_vote) AS value_sum FROM data_calon');
$row = mysqli_fetch_assoc($result);
$sum = $row['value_sum'];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Hasil Pemilihan</title>
    <style type="text/css">
        body {
            background: #1B98F5;
        }

        .round-bottom {
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .round-3 {
            border-radius: 20px 20px 20px 20px;
        }

        img {
            clip-path: circle();
            float: left;
            width: 85px;
            height: 85px;
            object-fit: contain;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container px-4 my-3">
        <div class="row">
            <div class="col-3">
                <a href="home.php" class="fw-bold text-decoration-none text-dark fs-5"><i class="bi bi-chevron-left"></i></a>
            </div>
            <div class="col-9">
                <h5 class="text-start mx-3"> Hasil Pemilihan</h5>

            </div>

        </div>
    </div>
    <?php if ($chart['status'] == "enable") : ?>

        <!-- <img src="Group 407.png" style="max-width: 200px;"> -->
        <div class="container">
            <div class="card bg-white round-3 py-5">
                <center>
                    <canvas id="myChart" width=300" height=300"></canvas>
                </center>
            </div>
        </div>


        <section class="jumlah_pemilos_vote">
            <div class="container px-4">
                <div class="row">
                    <div class="col">
                        <h6 class="text-muted my-3">Para Calon</h6>
                    </div>
                </div>
                <?php foreach ($query_calon as $calon) : ?>
                    <?php
                    if ($sum == 0) {
                        $total = $calon['jumlah_vote']  * 100;
                    } else {
                        $total = $calon['jumlah_vote'] / $sum * 100;
                    }

                    ?>
                    <div class="row mb-3">
                        <div class="p-3 border bg-white round-3">
                            <div class="row">
                                <div class="col-4">
                                    <div class="row">
                                        <img src="../img_calon/<?= $calon['gambar_calon']; ?>">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <h6 class="mb-3"><?= $calon['nama_calon']; ?><h6>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar bg-dark" role="progressbar" style="width: <?= $total ?>%" aria-valuenow="<?= $calon['jumlah_vote']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="fs-6 mb-0"><?= $total ?>%</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php else : ?>

        <div class="container">
            <div class="row text-center">
                <div class="col w-100">
                    <img style="
                    clip-path: none;
                    float: none;
                    width: 300px;
                    height: 300px;
                    object-fit: contain;" src="vector/undraw_Notify_re_65on.svg" alt="">
                </div>
            </div>
            <div class="row text-center">
                <h5>Anda belum bisa melihat diagram </h5>
                <p>anda harus menunggu beberapa saat</p>
            </div>
        </div>

    <?php endif; ?>





    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php if ($chart['status'] == "enable") : ?>
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
    <?php endif; ?>
</body>

</html>