<a href="dashboard.php?pages=users&act=tambah" class="btn btn-success ">Tambah data Users</a>

<table class="table border shadow-sm">
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Level</th>
        <th>Opsi</th>

    </tr>
    <?php
    $no = 1;
    foreach ($perpus->listusers() as $u) {


    ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $u->username ?></td>
            <td><?= $u->level ?></td>
            <td>
                <a href="dashboard.php?pages=users&act=ubah&id=<?= $u->user_id ?>" class="btn btn-primary">Ubah</a>
                <a href="routes/proses.php?act=hapus_user&id=<?= $u->user_id ?>" class="btn btn-danger">Hapus</a>
            </td>

        </tr>
    <?php
        $no++;
    }
    ?>
</table>