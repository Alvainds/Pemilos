<?php
include 'koneksi.php';
session_start();
session_unset();
session_destroy();
mysqli_query($conn, "UPDATE tb_login SET aktif = '0' ");
header('Location:login.php');
