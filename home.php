<?php
include 'control.php';
if (!isset($_SESSION['no_induk'])) {
	header('Location:login.php');
	exit;
}
$induk = $_SESSION['no_induk'];
$query_siswa = mysqli_query($conn, "SELECT * FROM tb_login INNER JOIN data_siswa ON tb_login.no_induk_siswa = data_siswa.no_induk_siswa WHERE data_siswa.no_induk_siswa = '$induk' ");
$hasil_siswa = mysqli_fetch_assoc($query_siswa);


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<title>Halaman home</title>
	<style type="text/css">
		.round-bottom {
			border-bottom-left-radius: 20px;
			border-bottom-right-radius: 20px;
		}

		.round-3 {
			border-radius: 20px 20px 20px 20px;
		}

		.btn {
			width: 300px;
			height: 50px;
			margin-top: 10px;
			border-radius: 50px;
		}

		.isi {
			text-align: center;
			min-height: 200px;
			margin-top: 100px;
		}
	</style>
</head>

<body class="bg-white">
	<section class="nav-atas mb-5">
		<div class="container">
			<div class="row">
				<div class="">
					<h4 class="text-start p-3 "> Pemilos <span class="text-warning">Musaba</span> </h4>
				</div>
			</div>
		</div>
	</section>
	<div class="container text-center ">
		<div class="row mt-5">
			<div class="col-md-12">
				<img class="mb-4" src="vector/undraw_voting_nvu7.svg" width="250">
				<?php if ($hasil_siswa['pemilos'] == "belum memilih") : ?>
					<h3>Selamat Datang <span class="text-warning"><?= $hasil_siswa['nama']; ?></span> </h3>
					<h3><?= $hasil_siswa['kelas']; ?></h3>
					<p class="mt-3 text-muted">Klik Tombol Mulai Untuk Melakukan Voting</p>
					<div class="d-grid gap-2 mt-4 col-md-6 mx-auto">
						<a href="pilih_pemilos.php"><button type="button" class="btn btn-warning rounded-3 mb-3">Mulai</button></a>
						<a href="logout.php"><button type="button" class="btn btn-outline-dark rounded-3 mx-3 mb-3">Keluar</button></a>
					</div>

				<?php else : ?>
					<p class="fs-5 mb-0">Terima Kasih Sudah Memilih <br> <span class="fw-bold fs-4 text-warning"><?= $hasil_siswa['nama']; ?></span> </p>
					<h3 class=""><?= $hasil_siswa['kelas']; ?></h2>
						<p class="mt-3 text-muted">Anda Sudah Memilih dan Tidak bisa melakukan Voting Lagi</p>
						<div class="d-grid gap-2 mt-4 col-md-6 mx-auto">
							<a href="diagram.php"><button type="button" class="btn btn-warning rounded-3 mb-3">Lihat Diagram</button></a>
							<a href="logout.php"><button type="button" class="btn btn-outline-dark rounded-3 mb-3">Keluar</button></a>
						</div>

					<?php endif; ?>

			</div>
		</div>

	</div>

	<script src=" js/bootstrap.min.js"></script>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/popper.min.js"></script>
</body>

</html>