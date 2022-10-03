<?php
// Melakukan koneksi mysql
$koneksi = mysqli_connect('localhost', 'root', '', 'ukk_navetacandra');

// Menampilkan error jika mysql gagal terkoneksi
if (!$koneksi) {
    echo "Error connecting mysql: " . mysqli_connect_error();
}
?>