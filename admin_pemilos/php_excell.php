<?php

include 'koneksi.php';
require 'vendor/autoload.php';

function RandomString($length = 25)

{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (isset($_POST['importDataSiswa'])) {
    $ekstensi = "";

    $file_name  = $_FILES['file_import']['name']; //get name file
    $file_data  = $_FILES['file_import']['tmp_name']; //get tempotary data

    if (empty($file_name)) {
        echo "<script>alert('Tolong masukkan file'); document.location.href = 'importData.php'; </script>";
    } else {
        $ekstensi = pathinfo($file_name)['extension'];
    }

    $ekstensi_allowed = array("xls", "xlsx");

    if (!in_array($ekstensi, $ekstensi_allowed)) {
        echo "<script>alert('File yang boleh di input type xls atau xlsx'); document.location.href = 'importData.php';</script>";
    }

    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile("$file_data");

    $spreadsheet = $reader->load($file_data);
    $sheetName = $spreadsheet->getSheetByName('Total');
    if ($sheetName) {
        $totalData = 0;
        $sheetData = $sheetName->toArray();
        for ($i = 1; $i < count($sheetData); $i++) {
            $no_induk = $sheetData[$i]['1'];
            $nama = addslashes($sheetData[$i]['2']);
            $nama_kelas = $sheetData[$i]['3'];
            $pass = RandomString(5);
            $aktif = 0;

            if ($nama !== null) {
                $query_excell = mysqli_query($conn, "INSERT INTO data_siswa (no_induk_siswa,nama,kelas,pemilos) VALUES('$no_induk', '$nama', '$nama_kelas', 'belum memilih') ");

                $query_login = mysqli_query($conn, "INSERT INTO tb_login (no_induk_siswa,password,aktif) VALUES('$no_induk', '$pass','$aktif') ");

                $totalData++;
            }
        }

        if ($totalData) {
            echo "<script>alert('berhasil mengimport $totalData data'); document.location.href = 'index.php'; </script>";
        } else {
            echo "<script>alert('gagal mengimport data'); document.location.href = 'index.php'; </script>";
        }
    }

    if (empty($sheetName)) {
        echo "<script>alert('Sheet anda tidak ada yang namanya Total'); document.location.href = 'importData.php'; </script>";
    }
}
