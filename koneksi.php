<?php

function connectToDatabase() {
    $host = '127.0.0.1'; // bisa diganti dengan localhost
    $user = 'root';
    $password = ''; 
    $database = 'crud_login'; 
    $port = 3306;

    // Koneksi ke MySQL
    $connect = mysqli_connect($host, $user, $password, '', $port);

    if (!$connect) {
        die("Koneksi Gagal: " . mysqli_connect_error());
    }

    // Membuat database jika tidak ada
    $sql_created_db = "CREATE DATABASE IF NOT EXISTS $database";
    if (!mysqli_query($connect, $sql_created_db)) {
        die("Ada kesalahan: " . mysqli_error($connect));
    }

    // Memilih database
    if (!mysqli_select_db($connect, $database)) {
        die("Tidak bisa memilih database: " . mysqli_error($connect));
    }

    // Membuat tabel jika tidak ada
    $sql_created_table = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        umur VARCHAR(100) NOT NULL, 
        email VARCHAR(100) NOT NULL,
        password VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );";

    if (!mysqli_query($connect, $sql_created_table)) {
        die("Error: " . mysqli_error($connect));
    }

    return $connect; // Mengembalikan koneksi
}

?>
