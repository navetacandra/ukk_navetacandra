<?php include('./koneksi.php'); ?>
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
    <div class="container" style="text-align: center;">
        <?php
        $supportedType = ['png', 'jpg', 'jpeg', 'gif'];

        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $target_file = 'foto/' . floor(microtime(true)) . '-' . basename($_FILES["gambar"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (in_array($imageFileType, $supportedType)) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO tbl_siswa (nis, nama_siswa, alamat, foto) VALUES ('" . $nis . "', '" . $nama . "', '" . $alamat . "', '" . $target_file . "')";
                if (mysqli_query($koneksi, $sql)) {
        ?>
                    <h4>Data Berhasil Diupload!</h4>
                    <a href="./tampil_siswa.php">Lihat Daftar Siswa.</a>
                <?php
                } else {
                ?>
                    <h4>Data Gagal Diupload. Silahkan Input Ulang!</h4>
                    <a href="./form_input_siswa.php">Input Ulang Data.</a>
                <?php
                }
            } else {
                ?>
                <h4>Data Gagal Diupload. Silahkan Input Ulang!</h4>
                <a href="./form_input_siswa.php">Input Ulang Data.</a>
            <?php
            }
        } else {
            ?>
            <h4>Format Foto Tidak Didukung. Silahkan Input Ulang!</h4>
            <a href="./form_input_siswa.php">Input Ulang Data.</a>
        <?php } ?>
    </div>
</body>

</html>