<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <a href="./tampil_siswa.php">Lihat Daftar Siswa</a>
    <h2 style="text-align: center;">FORM INPUT SISWA</h2>
    <div class="container">
        <form action="proses_input_siswa.php" enctype="multipart/form-data" method="post">
            <div class="row">
                <div class="col-25">
                    <label for="ns">NIS Siswa</label>
                </div>
                <div class="col-75">
                    <input type="text" name="nis" id="ns" placeholder="Masukan NIS Siswa.." maxlength="11" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="nm">Nama Siswa</label>
                </div>
                <div class="col-75">
                    <input type="text" name="nama" id="nm" placeholder="Masukan Nama Siswa.." maxlength="100" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="almt">Alamat Siswa</label>
                </div>
                <div class="col-75">
                    <textarea type="text" name="alamat" id="almt" placeholder="Masukan Alamat Siswa.." required></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="ft">Foto</label>
                </div>
                <div class="col-75">
                    <input type="file" name="gambar" id="ft" required>
                    <p style="color: red;">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
                </div>
            </div>
            <div class="row">
                <button type="submit" name="upload" value="Simpan">Simpan</button>
                <button type="reset" name="batal" value="Batal Simpan">Batal Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>