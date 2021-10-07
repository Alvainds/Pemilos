<?php

$conn = mysqli_connect("localhost", "root", "", "pemilos");
if (!$conn) {
    die("Koneksi ke database gagal : " . mysqli_connect_error());
}
