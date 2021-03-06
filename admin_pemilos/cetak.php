<?php
include 'control.php';

require_once __DIR__ . '/vendor/autoload.php';

$query_all = mysqli_query($conn, "SELECT count(pemilos) FROM data_siswa");
$all = mysqli_fetch_assoc($query_all);

$query_sudah = mysqli_query($conn, "SELECT count(pemilos) FROM data_siswa WHERE pemilos = 'sudah memilih'");
$sudah = mysqli_fetch_assoc($query_sudah);

$query_belum = mysqli_query($conn, "SELECT count(pemilos) FROM data_siswa WHERE pemilos = 'belum memilih'");
$belum = mysqli_fetch_assoc($query_belum);

$query_calon = mysqli_query($conn, "SELECT * FROM data_calon");

$mpdf = new \Mpdf\Mpdf();
$html = '<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <title>CATATAN REKAPITULASI HASIL PENGHITUNGAN PEROLEHAN SUARA</title>
</head>

<body>
    <div class="container my-5 py-5">
        <div class="row mb-5">
            <div class="col-md-12">
                <h5 class="text-center">CATATAN REKAPITULASI HASIL PENGHITUNGAN PEROLEHAN SUARA CALON/PASANGAN CALON
                    KETUA OSIS DARI SETIAP TPS DALAM PEMILIHAN OSIS TAHUN 2021 </h5>
                <h5 class="text-center mt-4">SMK MUHAMMADIYAH 1 BANTUL </h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Uraian</th>
                            <th scope="col">Rincian Perolehan Suara</th>
                        </tr>
                        <tr>
                            <th scope="col">I</th>
                            <th scope="col">DATA PEMILIH DAN PENGGUNAAN HAK PILIH</th>
                            <th scope="col">JUMLAH</th>
                        </tr>
                    <tbody>
                        <tr>
                            <th scope="col"></th>
                            <td>Jumlah pemilih dalam DPT (Model A DPT-PPO)</td>
                            <td>' . $all['count(pemilos)'] . ' siswa</td>

                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <td>Jumlah pengguna hak pilih dalam DPT</td>
                            <td>' . $sudah['count(pemilos)'] . ' siswa</td>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <td>Jumlah pengguna hak pilih dalam DPT</td>
                            <td>' . $belum['count(pemilos)'] . ' siswa</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row text-start mt-5">
            <div class="col-md-12">
                <table class="table table-bordered">
                        <tr>
                            <th scope="col">II</th>
                            <th scope="col">PEROLEHAN SUARA CALON/PASANGAN CALON KETUA OSIS</th>
                            <th scope="col">JUMLAH</th>
                        </tr>
                    ';
$i = 1;
foreach ($query_calon as $calon) {
    $html .= '
    <tr>
    <td>' . $i++ . '</td>
    <td>' . $calon["nama_calon"] . '</td>
    <td>' . $calon["jumlah_vote"] . '</td>
    </tr>
    ';
}
$html .= '
                </table>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-12">
                <h6>NAMA DAN TANDA TANGAN PANITIA PEMILIHAN OSIS (PPO)</h6>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card p-5">
                    <div class="p-4"></div>
                </div>
            </div>
        </div>
        <div class="row text-end mt-3">
            <div class="col">
                <h6 class="my-3">
                    NAMA DAN TANDA TANGAN SAKSI
                </h6>
                <p>.................................,.................................2021</p>
                <div class="my-5 py-4">

                </div>
                <p>[..........................................................................]</p>

            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('CATATAN_REKAPITULASI.pdf', \Mpdf\Output\Destination::DOWNLOAD);
