<?php include('./koneksi.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM EDIT SISWA</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h2 style="text-align: center;">FORM EDIT SISWA</h2>
    <div class="container" style="text-align: center;">
        <?php
        if (isset($_GET['id'])) {
            $sql_get = "SELECT * FROM tbl_siswa WHERE id_siswa=" . $_GET['id'];
            $get_res = mysqli_fetch_assoc(mysqli_query($koneksi, $sql_get));
            if ($get_res) {
        ?>
                <form action="./edit_siswa.php" method="post" enctype="multipart/form-data" style="text-align: start;">
                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                    <div class="row">
                        <div class="col-25">
                            <label for="ns">NIS Siswa</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nis" id="ns" placeholder="Masukan NIS Siswa.." maxlength="11" value="<?= $get_res['nis'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="nm">Nama Siswa</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama" id="nm" placeholder="Masukan Nama Siswa.." maxlength="100" value="<?= $get_res['nama_siswa'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="almt">Alamat Siswa</label>
                        </div>
                        <div class="col-75">
                            <textarea type="text" name="alamat" id="almt" placeholder="Masukan Alamat Siswa.." required><?= $get_res['alamat'] ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="ft">Foto</label>
                        </div>
                        <div class="col-75">
                            <input type="file" name="gambar" id="ft">
                            <p style="color: red;">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" name="upload" value="Simpan">Simpan</button>
                        <button type="reset" name="batal" value="Batal Simpan">Batal Simpan</button>
                    </div>
                </form>
            <?php
            } else {
            ?>
                <div class="container" style="text-align: center">
                    <h4>Data Tidak Ditemukan!</h4>
                    <a href="./tampil_siswa.php">Kembali Ke Daftar Siswa.</a>
                </div>
                <?php }
        }
        if (isset($_POST['id'])) {
            $sql_get = "SELECT * FROM tbl_siswa WHERE id_siswa=" . $_POST['id'];
            $get_res = mysqli_fetch_assoc(mysqli_query($koneksi, $sql_get));
            if ($get_res) {
                $supportedType = ['png', 'jpg', 'jpeg', 'gif'];

                $nis = $_POST['nis'];
                $nama = $_POST['nama'];
                $alamat = $_POST['alamat'];
                if ($_FILES['gambar']['name']) {
                    $target_file = 'foto/' . floor(microtime(true)) . '-' . basename($_FILES["gambar"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    if (in_array($imageFileType, $supportedType)) {
                        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                            unlink($get_res['foto']);
                            $sql = "UPDATE tbl_siswa SET nis='" . $nis . "', nama_siswa='" . $nama . "', alamat='" . $alamat . "', foto='" . $target_file . "' WHERE id_siswa=" . $_POST['id'];
                            if (mysqli_query($koneksi, $sql)) {
                ?>
                                <h4>Data Berhasil Diedit!</h4>
                                <a href="./tampil_siswa.php">Lihat Daftar Siswa.</a>
                            <?php
                            } else {
                            ?>
                                <h4>Data Gagal Diedit. Silahkan Input Ulang!</h4>
                                <a href="./edit_siswa.php?id=<?= $_POST['id'] ?>">Input Ulang Data.</a>
                            <?php
                            }
                        } else {
                            ?>
                            <h4>Data Gagal Diedit. Silahkan Input Ulang!</h4>
                            <a href="./edit_siswa.php?id=<?= $_POST['id'] ?>">Input Ulang Data.</a>
                        <?php
                        }
                    } else {
                        ?>
                        <h4>Format Foto Tidak Didukung. Silahkan Input Ulang!</h4>
                        <a href="./form_input_siswa.php">Input Ulang Data.</a>
                    <?php
                    }
                } else {
                    $sql = "UPDATE tbl_siswa SET nis='" . $nis . "', nama_siswa='" . $nama . "', alamat='" . $alamat . "' WHERE id_siswa=" . $_POST['id'];
                    if (mysqli_query($koneksi, $sql)) {
                    ?>
                        <h4>Data Berhasil Diedit!</h4>
                        <a href="./tampil_siswa.php">Lihat Daftar Siswa.</a>
                    <?php
                    } else {
                    ?>
                        <h4>Data Gagal Diedit. Silahkan Input Ulang!</h4>
                        <a href="./edit_siswa.php?id=<?= $_POST['id'] ?>">Input Ulang Data.</a>
                <?php
                    }
                }
            } else {
                ?>
                <h4>Data Tidak Ditemukan!</h4>
                <a href="./tampil_siswa.php">Kembali Ke Daftar Siswa.</a>
        <?php }
        }
        ?>
    </div>
</body>

</html>