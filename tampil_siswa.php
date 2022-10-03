<?php include('./koneksi.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./table.css">
</head>

<body>
    <a href="./form_input_siswa.php">Tambah Data</a>
    <h2 style="text-align: center">TAMPIL DAFTAR SISWA</h2>
    <?php
    // Query string untuk mengambil seluruh data dari tabel `tbl_siswa` dan
    // diurutkan berdasarkan nilai `id_siswa`
    $sql = "SELECT * FROM tbl_siswa ORDER BY id_siswa";

    $results = array(); // Inisialisasi variabel results (kosong)

    // Menjalankan query ke database dengan query string dalam variabel sql
    $query = mysqli_query($koneksi, $sql);

    // Memvalidasi jika query berjalan dan berhasil
    if ($query) {
        // Mengubah hasil query ke variabel results
        while ($data = mysqli_fetch_array($query)) {
            $results[] = $data;
        }
    }

    // Menampilkan tabel jika jumlah data dalam variabel results lebih dari 0
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
            $no = 1; // Inisialisasi variabel no -> untuk nomor tabel
            // Melakukan perulangan dari variabel results
            foreach ($results as $value) :
            ?>
                <tr>
                    <td><?= $no; // Menampilkan variabel no ?></td>
                    <td><?= $value['nis']; // Menampilkan `nis` dari result ?></td>
                    <td><?= $value['nama_siswa']; // Menampilkan `nama_siswa` dari result ?></td>
                    <td><?= $value['alamat']; // Menampilkan `alamat` dari result ?></td>
                    <td>
                        <img src="<?= $value['foto']; // Menyetel source image dari `foto` dalam result ?>" width="60px" height="60px">
                    </td>
                    <td>
                        <a href="./edit_siswa.php?id=<?= $value['id_siswa']; // Menambahkan `id_siswa` dari result ke link ?>">EDIT</a>
                        <span> || </span>
                        <!-- Menambahkan `nama_siswa` dari result ke confirm -->
                        <!-- Menambahkan `id_siswa` dari result ke link -->
                        <a href="#" onclick="confirm('Apakah anda yakin ingin menghapus data <?= $value['nama_siswa']; ?>?') 
                        ? location.replace('./hapus_siswa.php?id=<?= $value['id_siswa']; ?>')
                        : null">HAPUS</a>
                    </td>
                </tr>
            <?php
                $no++; // Menambahkan nilai variabel no
            endforeach; // Akhir perulangan varibel results
            ?>
        </table>
    <?php }
    // Menampilkan jika jumlah data dalam variabel result kurang dari atau sama dengan 0
    else { ?>
        <h2 style="text-align: center; color: #F60808;">Data Belum Tersedia.</h2>
    <?php } ?>
</body>

</html>