<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'perpustakaan_v2');
@$nisn = $_GET['nisn'];



?>

<h5>Form Tambah Peminjaman</h5>
<hr>

<form action="Routes/proses.php" method="POST">
    <div class="form-group">
        <label for="">NISN</label>
        <input type="text" name="nisn" autofocus class="form-control">
        <input type="submit" name="carinisn" value="Cari" class="btn btn-primary mt-3 mb-1 form-control">
    </div>
</form>


<form action="Routes/proses.php" method="POST">
    <div class="form-group">
        <label for="">Siswa</label>


        <?php
        $querynama = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn'");
        $siswa = mysqli_fetch_array($querynama);
        ?>
        <input type="hidden" name="nisn" value="<?= @$siswa['nisn']; ?>">
        <input type="text" name="nama" value="<?= @$siswa['nama_siswa']; ?>" class="form-control" disabled>
        <?php
        ?>

    </div>
    <div class="form-group">
        <label for="">Buku</label>
        <select name="buku" class="form-control">
            <?php
            foreach ($perpus->buku() as $b) {
            ?>
                <option value="<?= $b->id_buku; ?>"><?= $b->judul_buku; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Tanggal Kembali</label>
        <input type="date" name="tanggalkembali" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" name="tambahpeminjaman" class="btn btn-primary form-control" value="simpan">
        <a href="dashboard.php?pages=peminjaman" class="btn btn-danger">Kembali</a>
    </div>
</form>