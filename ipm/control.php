<?php

include 'koneksi.php';
session_start();
$error = '';

// SISTEM LOGIN
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, stripslashes($_POST['username']));
    $password = mysqli_real_escape_string($conn, stripslashes($_POST['password']));

    // cek apakah form kosong atau tidak
    if (!empty(trim($username)) && !empty(trim($password))) {
        // Ambil data dari database
        $query = "SELECT * FROM admin_ipm WHERE username = '$username' ";
        $admin_ipm = mysqli_query($conn, $query);
        if (mysqli_num_rows($admin_ipm) > 0) {
            $data_admin_ipm = mysqli_fetch_assoc($admin_ipm);
            $admin_ipm_password = $data_admin_ipm['password'];
            // cek password yang dimasukkan user
            if (md5($password) === $admin_ipm_password) {
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                header('Location:index.php');
            } else {
                $error = "password yang anda masukkan salah";
            }
        } else {
            $error = "Username yang anda masukkan tidak ada";
        }
    } else {
        $error = "Form tidak boleh kosong";
    }
}
