<h3>Form Ubah User</h3>
<hr>
<?php
$u = $perpus->tampilubah(@$_GET['id']);
?>

<form action="routes/proses.php" method="post">
    <div class="form-group">
        <label for="">Username</label>
        <input type="hidden" class="form-control" name="id" value="<?= $u->user_id ?>">
        <input type="text" class="form-control" name="username" placeholder="isi Username" aria-label="Username" value="<?= $u->username ?>">

    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Isi Password" aria-label="password" aria-describedby="basic-addon1">
    </div>
    <div><i class="text-danger"><b>Abaikan password jika tidak ada perubahan</b></i></div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="ubah_users" value="UBAH">
        <a href="dashboard.php?pages=users" class="btn btn-danger">Kembali</a>
    </div>
</form>