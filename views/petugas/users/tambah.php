<h3>Form Tambah User</h3>
<hr>
<form action="routes/proses.php" method="post">
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username" placeholder="isi Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password" placeholder="Isi Password" aria-label="password" aria-describedby="basic-addon1">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="simpanusers" value="Simpan">
        <a href="dashboard.php?pages=users" class="btn btn-danger">Kembali</a>
    </div>
</form>