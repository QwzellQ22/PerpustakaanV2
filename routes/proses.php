<?php
include '../Controllers/db.php';


if (@$_POST['login']) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == '' || $password == '') {
        session_start();
        $_SESSION['fail'] = 'Anda Gagal Login!';
        header('location:../login.php');
    } else {
        $perpus->proseslogin($username, $password);
    }
}

if (@$_GET['aksi'] == 'logout') {
    $perpus->logout();
}


if (@$_POST['simpanusers']) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $perpus->prosestambahusers($username, $password);
}


if (@$_POST['ubah_users']) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id'];

    $perpus->ubahusers($id, $username, $password);
}


if (@$_GET['act'] == 'hapususers') {
    $id = $_GET['id'];
    $perpus->hapususers($id);
}



if (@$_POST['simpansiswa']) {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    $foto = $_FILES['photo']['name'];

    $perpus->prosestambahsiswa($nisn, $nama, $kelas, $foto);
}



if (@$_POST['ubahsiswa']) {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $foto = $_FILES['photo']['name'];
    $id = $_POST['id'];

    $perpus->ubahsiswa($nisn, $nama, $kelas, $foto, $id);
}


if (@$_GET['act'] == 'hapussiswa') {
    $id = $_GET['id'];
    $perpus->hapussiswa($id);
}


if (@$_POST['simpanbuku']) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];

    $cover = $_FILES['cover']['name'];

    $perpus->prosestambahbuku($judul, $deskripsi, $penulis, $penerbit, $cover);
}



if (@$_POST['ubahbuku']) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];

    $id = $_POST['id'];

    $cover = $_FILES['cover']['name'];

    $perpus->ubahbuku($judul, $deskripsi, $penulis, $penerbit, $cover, $id);
}


if (@$_GET['act'] == 'hapusbuku') {
    $id = $_GET['id'];
    $perpus->hapusbuku($id);
}


if (@$_POST['tambahpeminjaman']) {
    $nomorpeminjaman = $_POST['nisn'] . "-" . date('Y-m-d');
    $siswa = $_POST['nisn'];
    $buku = $_POST['buku'];
    $tanggalpinjam = date('Y-m-d');
    $tanggalkembali = $_POST['tanggalkembali'];
    $perpus->prosestambahpeminjaman($nomorpeminjaman, $siswa, $buku, $tanggalpinjam, $tanggalkembali);
}


if (@$_GET['act'] == 'hapuspeminjaman') {
    $nisn = $_GET['nisn'];
    $perpus->hapuspeminjaman($nisn);
}


if (@$_POST['carinisn']) {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $perpus->carinisn($nisn);
}
