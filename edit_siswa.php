<?php include('./koneksi.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Siswa</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h2 style="text-align: center;">FORM EDIT SISWA</h2>
    <div class="container" style="text-align: center;">
        <?php
        // Menjalankan jika get method / parameter id tersedia
        if (isset($_GET['id'])) {
            // Query string untuk mengambil data dari `tbl_siswa`
            // berdasarkan id_siswa sama dengan parameter id
            $sql_get = "SELECT * FROM tbl_siswa WHERE id_siswa=" . $_GET['id'];

            // Menjalanka query ke database dengan query string dari variabel sql_get
            $get_res = mysqli_fetch_assoc(mysqli_query($koneksi, $sql_get));

            // Memvalidasi jika query berjalan dan berhasil
            if ($get_res) {
                // Menampilkan data tersimpan dari database ke form edit
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
                // Menampilkan jika data tidak ditemukan di database
            ?>
                <div class="container" style="text-align: center">
                    <h4>Data Tidak Ditemukan!</h4>
                    <a href="./tampil_siswa.php">Kembali Ke Daftar Siswa.</a>
                </div>
                <?php }
        }

        // Menjalankan jika parameter id dalam method post tersedia
        if (isset($_POST['id'])) {
            // Query string untuk mengambil data dari `tbl_siswa`
            // berdasarkan id_siswa sama dengan parameter id
            $sql_get = "SELECT * FROM tbl_siswa WHERE id_siswa=" . $_POST['id'];

            // Menjalanka query ke database dengan query string dari variabel sql_get
            $get_res = mysqli_fetch_assoc(mysqli_query($koneksi, $sql_get));

            // Memvalidasi jika query berjalan dan berhasil
            if ($get_res) {

                $nis = $_POST['nis']; // Mengambil nilai nis dari method POST
                $nama = $_POST['nama']; // Mengambil nilai nama dari method POST
                $alamat = $_POST['alamat']; // Mengambil nilai alamat dari method POST

                // Memvalidasi jika edit siswa mengunggah file/foto
                if ($_FILES['gambar']['name']) {
                    $supportedType = ['png', 'jpg', 'jpeg', 'gif']; // Tipe file yang didukung

                    // Mengambil file yang diupload/pilih dan menambahkan timestamp unik
                    $target_file = 'foto/' . microtime(true) . '-' . basename($_FILES["gambar"]["name"]);
                    // Mendapat tipe file
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Memvalidasi tipe file yang diupload termasuk tipe yang didukung
                    if (in_array($imageFileType, $supportedType)) {
                        // Memvalidasi file berhasil diupload
                        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                            unlink($get_res['foto']); // Menghapus foto lama yang tersimpan di database
                            // Query string untuk update data siswa ke database berdasarkan id_siswa
                            $sql = "UPDATE tbl_siswa SET nis='" . $nis . "', 
                            nama_siswa='" . $nama . "', 
                            alamat='" . $alamat . "', 
                            foto='" . $target_file . "' 
                            WHERE id_siswa=" . $_POST['id'];

                            // Memvalidasi data berhasil disimpan ke database
                            if (mysqli_query($koneksi, $sql)) {
                ?>
                                <h4>Data Berhasil Diedit!</h4>
                                <a href="./tampil_siswa.php">Lihat Daftar Siswa.</a>
                            <?php
                                // Menampilkan jika data gagal disimpan ke database
                            } else {
                            ?>
                                <h4>Data Gagal Diedit. Silahkan Input Ulang!</h4>
                                <a href="./edit_siswa.php?id=<?= $_POST['id'] ?>">Input Ulang Data.</a>
                            <?php
                            }
                            // Menampilkan jika file/foto gagal diupload
                        } else {
                            ?>
                            <h4>Data Gagal Diedit. Silahkan Input Ulang!</h4>
                            <a href="./edit_siswa.php?id=<?= $_POST['id'] ?>">Input Ulang Data.</a>
                        <?php
                        }
                        // Menampilkan jika tipe file/foto tidak didukung
                    } else {
                        ?>
                        <h4>Format Foto Tidak Didukung. Silahkan Input Ulang!</h4>
                        <a href="./form_input_siswa.php">Input Ulang Data.</a>
                    <?php
                    }
                }
                // Jika edit siswa tidak mengunggah file/foto
                else {
                    // Query string untuk update data siswa ke database berdasarkan id_siswa
                    $sql = "UPDATE tbl_siswa SET nis='" . $nis . "', 
                    nama_siswa='" . $nama . "', 
                    alamat='" . $alamat . "' 
                    WHERE id_siswa=" . $_POST['id'];

                    // Memvalidasi data berhasil disimpan ke database
                    if (mysqli_query($koneksi, $sql)) {
                    ?>
                        <h4>Data Berhasil Diedit!</h4>
                        <a href="./tampil_siswa.php">Lihat Daftar Siswa.</a>
                    <?php
                        // Menampilkan jika data gagal disimpan ke database
                    } else {
                    ?>
                        <h4>Data Gagal Diedit. Silahkan Input Ulang!</h4>
                        <a href="./edit_siswa.php?id=<?= $_POST['id'] ?>">Input Ulang Data.</a>
                <?php
                    }
                }
                // Menampilkan jika data tidak tersedia di database
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