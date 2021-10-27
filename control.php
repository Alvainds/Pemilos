<?php

include 'koneksi.php';
session_start();
$error = "";

// SISTEM LOGIN
if (isset($_POST['login'])) {
    $no_induk = mysqli_real_escape_string($conn, stripslashes($_POST['no_induk']));
    $password = mysqli_real_escape_string($conn, stripslashes($_POST['password']));

    // cek apakah form kosong atau tidak
    if (!empty(trim($no_induk)) && !empty(trim($password))) {
        $query = "SELECT * FROM tb_login WHERE no_induk_siswa = '$no_induk' ";
        $siswa = mysqli_query($conn, $query);
        if (mysqli_num_rows($siswa) > 0) {
            $data_siswa = mysqli_fetch_assoc($siswa);
            $siswa_password = $data_siswa['password'];
            $id = $data_siswa['id_login'];
            // cek password yang dimasukkan user
            if ($password === $siswa_password) {
                $_SESSION['no_induk'] = $no_induk;
                $_SESSION['password'] = $password;
                mysqli_query($conn, "UPDATE tb_login SET aktif = '1' WHERE id_login = '$id' ");
                header('Location:home.php');
            } else {
                $error = "password yang anda masukkan salah";
            }
        } else {
            $error = "No.Induk yang anda masukkan tidak ada";
        }
    } else {
        $error = "Form tidak boleh kosong";
    }
}

// SISTEM PEMILOS
if (isset($_POST['vote'])) {

    $query_siswa = mysqli_query($conn, "SELECT * FROM tb_login 
    INNER JOIN data_siswa ON tb_login.no_induk_siswa = data_siswa.no_induk_siswa
    INNER JOIN tb_kelas ON data_siswa.kelas = tb_kelas.nama_kelas
    WHERE data_siswa.no_induk_siswa = '$_SESSION[no_induk]' ");
    $hasil_siswa = mysqli_fetch_assoc($query_siswa);
    $kelas = $hasil_siswa['kelas'];

    $query_vote = mysqli_query($conn, "SELECT * FROM tb_vote WHERE class = '$kelas'");
    $total_vote = mysqli_fetch_assoc($query_vote);

    if ($total_vote['status'] == 'enable') {

        $vote = mysqli_real_escape_string($conn, stripslashes($_POST['vote']));

        // USER
        $data_pemilih = mysqli_query($conn, "SELECT * FROM tb_login INNER JOIN data_siswa ON tb_login.no_induk_siswa = data_siswa.no_induk_siswa WHERE tb_login.no_induk_siswa = '$_SESSION[no_induk]' ");
        $hasil_data_pemilih = mysqli_fetch_assoc($data_pemilih);
        $email_user = $hasil_data_pemilih['pemilos'];

        //CALON
        $query_calon = mysqli_query($conn, "SELECT * FROM data_calon WHERE id_calon = '$vote' ");
        $hasil_query = mysqli_fetch_assoc($query_calon);
        $id_calon = $hasil_query['id_calon'];

        if ($email_user == 'belum memilih') {
            $pilih = mysqli_query($conn, "UPDATE data_calon SET jumlah_vote = jumlah_vote+1 WHERE id_calon = '$id_calon' ");
            mysqli_query($conn, "UPDATE tb_login INNER JOIN data_siswa ON tb_login.no_induk_siswa = data_siswa.no_induk_siswa SET data_siswa.pemilos = 'sudah memilih' WHERE tb_login.no_induk_siswa = '$_SESSION[no_induk]' ");
            header('Location:home.php');
        } else {
            header('Location:home.php');
        }
    } else {
        header('Location:pilih_pemilos.php');
        exit;
    }
}
