<!--
Author Name: Naveta Candra Chairullah
Author Email: naveta.cand@gmail.com
-->

<?php include('./koneksi.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Siswa</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php
    // Query string untuk mengambil data dari `tbl_siswa` berdasarkan parameter id
    $sql_get = "SELECT * FROM tbl_siswa WHERE id_siswa=" . $_GET['id'];
    // Query string untuk menghapus data dari `tbl_siswa` berdasarkan parameter id
    $sql_del = "DELETE FROM tbl_siswa WHERE id_siswa=" . $_GET['id'];

    // Melakukan query ke database dengan query string dari variabel sql_get
    $get_res = mysqli_fetch_assoc(mysqli_query($koneksi, $sql_get));

    // Memvalidasi jika data tersedia di database
    if ($get_res) {
        // Memvalidasi jika data berhasil dihapus
        if (mysqli_query($koneksi, $sql_del)) {
            // Menghapus foto siswa
            unlink($get_res['foto']);
    ?>
            <div class="container" style="text-align: center">
                <h4>Data Berhasil Dihapus!</h4>
                <a href="./tampil_siswa.php">Kembali Ke Daftar Siswa.</a>
            </div>
            <?php
        // Menampilkan jika data gagal dihapus
    } else {
        ?>
            <div class="container" style="text-align: center">
                <h4>Data Gagal Dihapus. Mohon Coba Lagi!</h4>
                <a href="./tampil_siswa.php">Kembali Ke Daftar Siswa.</a>
            </div>
            <?php }
        // Menampilkan jika data tidak tersedia di database
    } else {
        ?>
        <div class="container" style="text-align: center">
            <h4>Data Tidak Ditemukan!</h4>
            <a href="./tampil_siswa.php">Kembali Ke Daftar Siswa.</a>
        </div>
    <?php } ?>
</body>

</html>