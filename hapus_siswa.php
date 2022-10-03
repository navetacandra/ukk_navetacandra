<?php include('./koneksi.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php
    $sql_get = "SELECT * FROM tbl_siswa WHERE id_siswa=" . $_GET['id'];
    $sql_del = "DELETE FROM tbl_siswa WHERE id_siswa=" . $_GET['id'];
    if (mysqli_fetch_assoc(mysqli_query($koneksi, $sql_get))) {
        if (mysqli_query($koneksi, $sql_del)) {
    ?>
            <div class="container" style="text-align: center">
                <h4>Data Berhasil Dihapus!</h4>
                <a href="./tampil_siswa.php">Kembali Ke Daftar Siswa.</a>
            </div>
            <?php
        } else {
            ?>
            <div class="container" style="text-align: center">
                <h4>Data Gagal Dihapus. Mohon Coba Lagi!</h4>
                <a href="./tampil_siswa.php">Kembali Ke Daftar Siswa.</a>
            </div>
        <?php }
    } else {
        ?>
        <div class="container" style="text-align: center">
            <h4>Data Tidak Ditemukan!</h4>
            <a href="./tampil_siswa.php">Kembali Ke Daftar Siswa.</a>
        </div>
    <?php } ?>
</body>

</html>