<?php
include 'koneksi.php';
session_start();
$error = '';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function generateRandomString($length = 25)

{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



// SISTEM LOGIN
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, stripslashes($_POST['username']));
    $password = mysqli_real_escape_string($conn, stripslashes($_POST['password']));

    // cek apakah form kosong atau tidak
    if (!empty(trim($username)) && !empty(trim($password))) {
        // Ambil data dari database
        // $admin = mysqli_query($conn,  "SELECT * FROM data_admin WHERE username = '$username' ");
        $query = "SELECT * FROM data_admin WHERE username = '$username' ";
        $admin = mysqli_query($conn, $query);
        if (mysqli_num_rows($admin) > 0) {
            $data_admin = mysqli_fetch_assoc($admin);
            $admin_password = $data_admin['password'];
            // cek password yang dimasukkan user
            if (md5($password) === $admin_password) {
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
// 

// Bagian Data Siswa

// Tambah dataSiswa.php
if (isset($_POST['simpanDataSiswa'])) {
    $no_induk_tambah_siswa = mysqli_real_escape_string($conn, stripslashes(htmlspecialchars($_POST['no_induk'])));
    $nama_tambah_siswa = mysqli_real_escape_string($conn, stripslashes(htmlspecialchars($_POST['nama'])));
    $kelas_tambah_siswa = mysqli_real_escape_string($conn, stripslashes(htmlspecialchars($_POST['namaKelas'])));
    $pass =  mysqli_real_escape_string($conn, stripslashes(htmlspecialchars(generateRandomString(5))));
    $aktif = 0;

    // function 
    function cek_kelas($conn, $kelas_tambah_siswa)
    {
        $kelas = mysqli_real_escape_string($conn, $kelas_tambah_siswa);
        $query_kelas = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE nama_kelas = '$kelas' ");
        $isi_data_kelas = mysqli_fetch_array($query_kelas);
        return $isi_data_kelas;
    }

    $query_kelas = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE nama_kelas ");
    $isi_data_kelas = mysqli_fetch_array($query_kelas);

    function cek_nisn($conn, $no_induk_tambah_siswa)
    {
        $no_induk = mysqli_real_escape_string($conn, $no_induk_tambah_siswa);
        $query_no_induk = mysqli_query($conn, "SELECT * FROM data_siswa WHERE no_induk_siswa = '$no_induk' ");
        $isi_data_siswa = mysqli_fetch_array($query_no_induk);
        return $isi_data_siswa;
    }

    // Akhir function

    // cek apakah data kosong atau tidak 
    if (!empty(trim($no_induk_tambah_siswa)) && !empty(trim($nama_tambah_siswa)) && !empty(trim($kelas_tambah_siswa))) {
        if (cek_nisn($conn, $no_induk_tambah_siswa) == 0) {
            if (strlen($no_induk_tambah_siswa) < 6) {
                if (cek_kelas($conn, $kelas_tambah_siswa) !== $isi_data_kelas) {
                    $query_insert = mysqli_query(
                        $conn,
                        "INSERT INTO data_siswa (no_induk_siswa,nama,kelas,pemilos) VALUES('$no_induk_tambah_siswa', '$nama_tambah_siswa', '$kelas_tambah_siswa', 'belum memilih') "
                    );
                    $query_login = mysqli_query($conn, "INSERT INTO tb_login (no_induk_siswa,password,aktif) VALUES('$no_induk_tambah_siswa', '$pass','$aktif') ");
                    if ($query_insert) {
                        echo "<script>alert('Data siswa berhasil ditambahkan'); </script>";
                    } else {
                        echo "<script>alert('Data siswa gagal ditambahkan'); </script>";
                    }
                } else {
                    echo "<script>alert('Masukkan nama kelas sesuai dengan data kelas');</script>";
                }
            } else {
                echo "<script>alert('No.Induk yang dimasukkan tidak boleh lebih dari 5')</script>";
            }
        } else {
            echo "<script>alert('No.Induk itu sudah ada');</script>";
        }
    } else {
        echo "<script>alert('Data tidak boleh ada yang kosong');</script>";
    }
}

// Edit dataSiswa.php
if (isset($_POST['ubahDataSiswa'])) {
    $id = mysqli_real_escape_string($conn, stripslashes($_POST['idDataSiswa']));
    $id_login = mysqli_real_escape_string($conn, stripslashes($_POST['idLogin']));
    $no_induk = mysqli_real_escape_string($conn, stripslashes($_POST['no_induk']));
    $nama = mysqli_real_escape_string($conn, stripslashes($_POST['nama']));
    $namaKelas = mysqli_real_escape_string($conn, stripslashes($_POST['namaKelas']));

    // function
    function cek_kelas($conn, $namaKelas)
    {
        $kelas = mysqli_real_escape_string($conn, $namaKelas);
        $query_kelas = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE nama_kelas = '$kelas' ");
        $isi_data_kelas = mysqli_fetch_array($query_kelas);
        return $isi_data_kelas;
    }

    $query_kelas = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE nama_kelas ");
    $isi_data_kelas = mysqli_fetch_array($query_kelas);

    // Cek apakah ada data kosong atau tidak
    if (!empty(trim($no_induk)) && !empty(trim($nama)) && !empty(trim($namaKelas))) {
        if (strlen($no_induk) < 6) {
            if (cek_kelas($conn, $namaKelas) !== $isi_data_kelas) {
                $query_update = mysqli_query($conn, "UPDATE data_siswa SET no_induk_siswa = '$no_induk', nama = '$nama', kelas = '$namaKelas' WHERE id_siswa = '$id' ");
                $query_update_login = mysqli_query($conn, "UPDATE `tb_login` SET `no_induk_siswa` = '$no_induk' WHERE `tb_login`.`id_login` = '$id_login'");
                if ($query_update) {
                    echo "<script>alert('Data siswa berhasil diubah'); </script>";
                } else {
                    echo "<script>alert('Data siswa gagal diubah'); </script>";
                }
            } else {
                echo "<script>alert('Masukkan nama kelas sesuai dengan data kelas');</script>";
            }
        } else {
            echo "<script>alert('No.Induk yang diubah tidak boleh lebih dari 5')</script>";
        }
    } else {
        echo "<script>alert('Ketika meng-update tidak boleh ada yang dikosongkan');</script>";
    }
}

// Hapus dataSiswa.php
if (isset($_POST['hapusDataSiswa'])) {
    $id_hapus = mysqli_real_escape_string($conn, stripslashes($_POST['idHapusDataSiswa']));
    $id_hapus_login = mysqli_real_escape_string($conn, stripslashes($_POST['idHapusLogin']));
    $query_delete = mysqli_query($conn, "DELETE FROM data_siswa WHERE id_siswa = '$id_hapus'");
    $query_login = mysqli_query($conn, "DELETE FROM tb_login WHERE id_login = '$id_hapus_login'");
    if ($query_delete) {
        echo "<script>alert('Data siswa berhasil dihapus'); </script>";
    } else {
        echo "<script>alert('Data siswa gagal dihapus'); </script>";
    }
}

// Akhir Bagian Data Siswa

// Bagian dataCalon.php


// Tambah Data Calon
if (isset($_POST['simpanDataCalon'])) {
    $nama_calon = mysqli_real_escape_string($conn, stripslashes($_POST['nama']));
    $visi = mysqli_real_escape_string($conn, stripslashes($_POST['visi']));
    $misi = mysqli_real_escape_string($conn, stripslashes($_POST['misi']));
    // upload gambar
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error_gambar = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // ekstensi gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'svg'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiFile));

    // penamaan gambar random
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // Cek apakah ada data kosong atau tidak
    if (!empty(trim($nama_calon)) && !empty(trim($visi)) && !empty(trim($misi))) {
        // cek apakah ada / tidak gambar yang diupload
        if ($error_gambar !== 4) {
            // cek apakah yang diupload adalah gambar
            if (in_array($ekstensiGambar, $ekstensiGambarValid)) {
                // cek ukuran gambar
                if ($ukuranFile < 2000000) {
                    // lolos setiap pengecekan
                    move_uploaded_file($tmpName, '../img_calon/' . $namaFileBaru);
                    $query_insert_calon = mysqli_query($conn, "INSERT INTO data_calon (nama_calon,visi,misi,jumlah_vote,gambar_calon) values('$nama_calon', '$visi', '$misi', 0, '$namaFileBaru')");
                    if ($query_insert_calon) {
                        echo "<script>alert('Data Calon Berhasil Ditambahkan'); </script>";
                    } else {
                        echo "<script>alert('Data Calon Gagal Ditambahkan'); document.location.href = 'tambahDataCalon.php'; </script>";
                    }
                } else {
                    echo "<script>alert('Ukuran file gambar terlalu besar'); document.location.href = 'tambahDataCalon.php'; </script>";
                }
            } else {
                echo "<script>alert('yang anda upload bukanlah gambar'); document.location.href = 'tambahDataCalon.php'; </script>";
            }
        } else {
            echo "<script>alert('pilih gambar terlebih dahulu'); document.location.href = 'tambahDataCalon.php'; </script>";
        }
    } else {
        echo "<script>alert('Tidak boleh ada data yang kosong'); document.location.href = 'tambahDataCalon.php'; </script>";
    }
}

// editDataCalon.php
if (isset($_POST['editDataCalon'])) {
    $id_ubah_calon = mysqli_real_escape_string($conn, stripslashes($_POST['idDataCalon']));
    $gambar_lama = mysqli_real_escape_string($conn, stripslashes($_POST['gambar_lama']));
    $nama_calon = mysqli_real_escape_string($conn, stripslashes($_POST['nama']));
    $visi = mysqli_real_escape_string($conn, stripslashes($_POST['visi']));
    $misi = mysqli_real_escape_string($conn, stripslashes($_POST['misi']));

    // upload gambar
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error_gambar = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // ekstensi gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'svg'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiFile));

    // penamaan gambar random
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // Bagian Update Gambar
    // cek apakah user mau mengganti gambar atau tidak
    if ($error_gambar !== 4) {
        // cek apakah yang diupload adalah gambar
        if (in_array($ekstensiGambar, $ekstensiGambarValid)) {
            // cek ukuran gambar
            if ($ukuranFile < 2000000) {
                // lolos setiap pengecekan
                move_uploaded_file($tmpName, '../img_calon/' . $namaFileBaru);
                $query_update_calon_gambar = mysqli_query($conn, "UPDATE data_calon SET  gambar_calon = '$namaFileBaru' WHERE id_calon = '$id_ubah_calon' ");
                if ($query_update_calon_gambar) {
                    echo "<script>alert('Gambar Berhasil Diupdate'); </script>";
                } else {
                    echo "<script>alert('Gambar Gagal Diupdate'); document.location.href = 'editDataCalon.php'; </script>";
                }
            } else {
                echo "<script>alert('Ukuran file gambar terlalu besar'); document.location.href = 'editDataCalon.php'; </script>";
            }
        } else {
            echo "<script>alert('yang anda upload bukanlah gambar'); document.location.href = 'editDataCalon.php'; </script>";
        }
    } else {
        $gambar_lama;
    }
    // Akhir Bagian Update Gambar

    // Bagian Input Lain
    if (!empty(trim($nama_calon)) && !empty(trim($visi)) && !empty(trim($misi))) {
        $query_update_calon = mysqli_query($conn, "UPDATE data_calon SET nama_calon = '$nama_calon', visi = '$visi', misi = '$misi' WHERE id_calon = '$id_ubah_calon' ");
        if ($query_update_calon) {
            echo "<script>alert('Data Calon Berhasil Diupdate'); </script>";
        } else {
            echo "<script>alert('Data Calon Gagal Diupdate'); document.location.href = 'editDataCalon.php'; </script>";
        }
    } else {
        echo "<script>alert('Tidak boleh ada data yang kosong'); document.location.href = 'editDataCalon.php'; </script>";
    }
    // Akhir Bagian Input Lain
}

// Hapus data Calon
if (isset($_POST['hapusDataCalon'])) {
    $id_hapus_calon = mysqli_real_escape_string($conn, stripslashes($_POST['idHapusDataCalon']));
    $query_delete = mysqli_query($conn, "DELETE FROM data_calon WHERE id_calon = '$id_hapus_calon'");
    if ($query_delete) {
        echo "<script>alert('Data calon berhasil dihapus'); </script>";
    } else {
        echo "<script>alert('Data calon gagal dihapus'); </script>";
    }
}


// Akhir Bagian dataCalon.php

// Bagian Data Kelas

// Tambah dataKelas.php
if (isset($_POST['simpanDataKelas'])) {
    $namaKelas = mysqli_real_escape_string($conn, stripslashes(htmlspecialchars($_POST['namaKelas'])));
    $pilihan_kelas = mysqli_real_escape_string($conn, stripslashes(htmlspecialchars($_POST['pilihan_kelas'])));
    $jurusan = mysqli_real_escape_string($conn, stripslashes(htmlspecialchars($_POST['jurusan'])));

    function cek_nama_kelas($conn, $namaKelas)
    {
        $nama_kelas = mysqli_real_escape_string($conn, $namaKelas);
        $query_kelas = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE nama_kelas = '$nama_kelas' ");
        $isi_data_kelas = mysqli_fetch_array($query_kelas);
        return $isi_data_kelas;
    }

    // Cek apakah ada data kosong atau tidak
    if (!empty(trim($namaKelas)) && !empty(trim($jurusan))) {
        if (cek_nama_kelas($conn, $namaKelas) == 0) {
            $query_insert = mysqli_query($conn, "INSERT INTO tb_kelas (nama_kelas, kelas, jurusan) VALUES('$namaKelas', '$pilihan_kelas', '$jurusan') ");
            if ($query_insert) {
                echo "<script>alert('Data kelas berhasil ditambahkan'); </script>";
            } else {
                echo "<script>alert('Data kelas gagal ditambahkan'); </script>";
            }
        } else {
            echo "<script>alert('Nama Kelas itu sudah ada'); </script>";
        }
    } else {
        echo "<script>alert('Data kelas tidak boleh ada yang kosong');</script>";
    }
}

// Edit dataKelas.php
if (isset($_POST['ubahDataKelas'])) {
    $id_ubah_kelas = mysqli_real_escape_string($conn, stripslashes($_POST['idDataKelas']));
    $nama_kelas = mysqli_real_escape_string($conn, stripslashes($_POST['namaKelas']));
    $kelas = mysqli_real_escape_string($conn, stripslashes($_POST['kelas']));
    $jurusan = mysqli_real_escape_string($conn, stripslashes($_POST['jurusan']));

    // Cek apakah ada data kosong atau tidak
    if (!empty(trim($nama_kelas)) && !empty(trim($jurusan))) {
        $query_update_kelas = mysqli_query($conn, "UPDATE tb_kelas SET nama_kelas = '$nama_kelas', kelas = '$kelas', jurusan = '$jurusan' WHERE id_kelas = '$id_ubah_kelas' ");
        if ($query_update_kelas) {
            echo "<script>alert('Data kelas berhasil diubah'); </script>";
        } else {
            echo "<script>alert('Data kelas gagal diubah'); </script>";
        }
    } else {
        echo "<script>alert('Ketika meng-update data kelasnya tidak boleh kosong');</script>";
    }
}

// Hapus dataKelas.php
if (isset($_POST['hapusDataKelas'])) {
    $id_hapus_kelas = mysqli_real_escape_string($conn, stripslashes($_POST['idHapusDataKelas']));
    $query_delete = mysqli_query($conn, "DELETE FROM tb_kelas WHERE id_kelas = '$id_hapus_kelas'");
    if ($id_hapus_kelas) {
        echo "<script>alert('Data kelas berhasil dihapus'); </script>";
    } else {
        echo "<script>alert('Data kelas gagal dihapus'); </script>";
    }
}
if (isset($_POST['downloadX'])) {

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama');
    $sheet->setCellValue('C1', 'Kelas');
    $sheet->setCellValue('D1', 'NIS');
    $sheet->setCellValue('E1', 'Password');

    $query = mysqli_query($conn, "SELECT * FROM tb_login
    INNER JOIN data_siswa ON tb_login.no_induk_siswa = data_siswa.no_induk_siswa
    INNER JOIN tb_kelas ON data_siswa.kelas = tb_kelas.nama_kelas WHERE tb_kelas.kelas = 'X'");
    $i = 2;
    $no = 1;
    while ($row = mysqli_fetch_array($query)) {
        $sheet->setCellValue('A' . $i, $no++);
        $sheet->setCellValue('B' . $i, $row['nama']);
        $sheet->setCellValue('C' . $i, $row['nama_kelas']);
        $sheet->setCellValue('D' . $i, $row['no_induk_siswa']);
        $sheet->setCellValue('E' . $i, $row['password']);
        $i++;
    }

    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    $i = $i - 1;
    $sheet->getStyle('A1:C' . $i)->applyFromArray($styleArray);
    $writer = new Xlsx($spreadsheet);
    $writer->save('Data_Siswa.xlsx');
    echo "<script>window.location = 'Data_Siswa.xlsx'; alert('berhasil export data'); document.location.href = 'index.php';</script>";
}

if (isset($_POST['downloadXI'])) {

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama');
    $sheet->setCellValue('C1', 'Kelas');
    $sheet->setCellValue('D1', 'NIS');
    $sheet->setCellValue('E1', 'Password');

    $query = mysqli_query($conn, "SELECT * FROM tb_login
    INNER JOIN data_siswa ON tb_login.no_induk_siswa = data_siswa.no_induk_siswa
    INNER JOIN tb_kelas ON data_siswa.kelas = tb_kelas.nama_kelas WHERE tb_kelas.kelas = 'XI'");
    $i = 2;
    $no = 1;
    while ($row = mysqli_fetch_array($query)) {
        $sheet->setCellValue('A' . $i, $no++);
        $sheet->setCellValue('B' . $i, $row['nama']);
        $sheet->setCellValue('C' . $i, $row['nama_kelas']);
        $sheet->setCellValue('D' . $i, $row['no_induk_siswa']);
        $sheet->setCellValue('E' . $i, $row['password']);
        $i++;
    }

    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    $i = $i - 1;
    $sheet->getStyle('A1:C' . $i)->applyFromArray($styleArray);
    $writer = new Xlsx($spreadsheet);
    $writer->save('Data_Siswa.xlsx');
    echo "<script>window.location = 'Data_Siswa.xlsx'; alert('berhasil export data'); document.location.href = 'index.php';</script>";
}

if (isset($_POST['downloadXII'])) {

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama');
    $sheet->setCellValue('C1', 'Kelas');
    $sheet->setCellValue('D1', 'NIS');
    $sheet->setCellValue('E1', 'Password');

    $query = mysqli_query($conn, "SELECT * FROM tb_login
    INNER JOIN data_siswa ON tb_login.no_induk_siswa = data_siswa.no_induk_siswa
    INNER JOIN tb_kelas ON data_siswa.kelas = tb_kelas.nama_kelas WHERE tb_kelas.kelas = 'XII'");
    $i = 2;
    $no = 1;
    while ($row = mysqli_fetch_array($query)) {
        $sheet->setCellValue('A' . $i, $no++);
        $sheet->setCellValue('B' . $i, $row['nama']);
        $sheet->setCellValue('C' . $i, $row['nama_kelas']);
        $sheet->setCellValue('D' . $i, $row['no_induk_siswa']);
        $sheet->setCellValue('E' . $i, $row['password']);
        $i++;
    }

    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    $i = $i - 1;
    $sheet->getStyle('A1:C' . $i)->applyFromArray($styleArray);
    $writer = new Xlsx($spreadsheet);
    $writer->save('Data_Siswa.xlsx');
    echo "<script>window.location = 'Data_Siswa.xlsx'; alert('berhasil export data'); document.location.href = 'index.php';</script>";
}

// Akhir Bagian Data Kelas


// start enable and disable  

if (isset($_POST['change'])) {
    $id_session_vote = mysqli_real_escape_string($conn, stripslashes($_POST['idsession']));
    $status_vote = mysqli_real_escape_string($conn, stripslashes($_POST['change']));
    $query_change_vote = mysqli_query($conn, " UPDATE `tb_vote` SET `status` = '$status_vote' WHERE `tb_vote`.`id` = $id_session_vote");
}
if (isset($_POST['chart'])) {
    $id_session_chart = mysqli_real_escape_string($conn, stripslashes($_POST['idsession']));
    $status_chart = mysqli_real_escape_string($conn, stripslashes($_POST['chart']));
    $query_change_chart = mysqli_query($conn, " UPDATE `tb_chart` SET `status` = '$status_chart' WHERE `tb_chart`.`id` = $id_session_chart;");
}

// end disable and enable

// start reset password

if (isset($_POST['resetPassword'])) {
    $id_password = mysqli_real_escape_string($conn, stripslashes($_POST['idPassword']));
    $password = mysqli_real_escape_string($conn, stripslashes($_POST['password']));
    $query_change_chart = mysqli_query($conn, " UPDATE `tb_login` SET `password` = '$password' WHERE `tb_login`.`id_login` = $id_password");
}

// end reset password

// Change Vote Value
if (isset($_POST['change_vote'])) {
    $id_change_vote_calon = mysqli_real_escape_string($conn, stripslashes($_POST['idCalon']));
    $value_change_vote = mysqli_real_escape_string($conn, stripslashes($_POST['valueVote']));
    $query_change_vote = mysqli_query($conn, " UPDATE `data_calon` SET `jumlah_vote` = '$value_change_vote' WHERE `data_calon`.`id_calon` = $id_change_vote_calon");
}
// end Change Vote Value
