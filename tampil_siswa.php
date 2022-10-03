<?php include('./koneksi.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./table.css">
</head>

<body>
    <a href="./form_input_siswa.php">Tambah Data</a>
    <h2 style="text-align: center">TAMPIL DAFTAR SISWA</h2>
    <?php
    $sql = "SELECT * FROM tbl_siswa ORDER BY id_siswa";
    $results = array();
    $query = mysqli_query($koneksi, $sql);
    if ($query) {
        while ($data = mysqli_fetch_array($query)) {
            $results[] = $data;
        }
    }

    if (count($results) > 0) {
    ?>
        <table id="customers">
            <thead>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Aksi</th>
            </thead>
            <?php
            $no = 1;
            foreach ($results as $value) :
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $value['nis'] ?></td>
                    <td><?= $value['nama_siswa'] ?></td>
                    <td><?= $value['alamat'] ?></td>
                    <td>
                        <img src="<?= $value['foto'] ?>" width="60px" height="60px">
                    </td>
                    <td>
                        <a href="./edit_siswa.php?id=<?= $value['id_siswa'] ?>">EDIT</a>
                        <span> || </span>
                        <a href="#" onclick="confirm('Apakah anda yakin ingin menghapus data <?= $value['nama_siswa'] ?>?') ? location.replace('./hapus_siswa.php?id=<?= $value['id_siswa'] ?>') : null">HAPUS</a>
                    </td>
                </tr>
            <?php
                $no++;
            endforeach;
            ?>
        </table>
    <?php } else { ?>
        <h2 style="text-align: center; color: #F60808;">Data Belum Tersedia.</h2>
    <?php } ?>
</body>

</html>