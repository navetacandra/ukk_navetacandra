<!--
Author Name: Naveta Candra Chairullah
Author Email: naveta.cand@gmail.com
-->

<?php include('./koneksi.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Siswa</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container" style="text-align: center;">
        <?php
        $supportedType = ['png', 'jpg', 'jpeg', 'gif']; // Tipe file yang didukung

        $nis = $_POST['nis']; // Mengambil nilai nis dari method POST
        $nama = $_POST['nama']; // Mengambil nilai nama dari method POST
        $alamat = $_POST['alamat']; // Mengambil nilai alamat dari method POST

        // Mengambil file yang diupload/pilih dan menambahkan timestamp unik
        $target_file = 'foto/' . microtime(true) . '-' . basename($_FILES["gambar"]["name"]);
        // Mendapat tipe file
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Memvalidasi tipe file yang diupload termasuk tipe yang didukung
        if (in_array($imageFileType, $supportedType)) {
            // Memvalidasi file berhasil diupload
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                // Query string untuk menyimpan data ke database
                $sql = "INSERT INTO tbl_siswa (nis, nama_siswa, alamat, foto) 
                VALUES ('" . $nis . "', '" . $nama . "', '" . $alamat . "', '" . $target_file . "')";

                // Memvalidasi data berhasil disimpan ke database
                if (mysqli_query($koneksi, $sql)) {
        ?>
                    <h4>Data Berhasil Disimpan!</h4>
                    <a href="./tampil_siswa.php">Lihat Daftar Siswa.</a>
                <?php
                    // Menampilkan jika data gagal disimpan ke database
                } else {
                ?>
                    <h4>Data Gagal Disimpan. Silahkan Input Ulang!</h4>
                    <a href="./form_input_siswa.php">Input Ulang Data.</a>
                <?php
                }
                // Menampilkan jika file/foto gagal diupload
            } else {
                ?>
                <h4>Data Gagal Diupload. Silahkan Input Ulang!</h4>
                <a href="./form_input_siswa.php">Input Ulang Data.</a>
            <?php
            }
            // Menampilkan jika tipe file/foto tidak didukung
        } else {
            ?>
            <h4>Format Foto Tidak Didukung. Silahkan Input Ulang!</h4>
            <a href="./form_input_siswa.php">Input Ulang Data.</a>
        <?php } ?>
    </div>
</body>

</html>