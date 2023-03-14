<?php


class perpustakaan
{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "perpustakaan_v2";
    private $koneksi;

    // METHOD
    public function __construct()
    {
        $this->koneksi = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );
    }

    public function proseslogin($username, $password)
    {
        $query = $this->koneksi->query("SELECT * FROM users 
        WHERE
        username = '$username' AND
        password = md5('$password')");
        $data = $query->fetch_object();
        $count = $query->num_rows;

        if ($count > 0) {
            session_start();
            $_SESSION['login'] = 1;
            $_SESSION['username'] = $data->username;
            $_SESSION['level'] = $data->level;
            $_SESSION['nisn'] = $data->nis;
            header('location:../dashboard.php');
        } else {
            session_start();
            $_SESSION['fail'] = 'Anda Gagal Login';
            header('location:../login.php');
        }
    }
    public function logout()
    {
        session_start();
        session_destroy();

        session_start();
        $_SESSION['success'] = 'Anda Berhasil Logout!';


        header('location:../login.php');
    }



    public function listusers()
    {
        $query = $this->koneksi->query("SELECT * FROM users");
        while ($data = $query->fetch_object()) {
            $hasil[] = $data;
        }
        return $hasil;
    }
    public function tampilubah($id)
    {
        $query = $this->koneksi->query("SELECT * FROM users WHERE user_id = '$id'");
        return $query->fetch_object();
    }
    public function ubahusers($id, $username, $password)
    {
        if ($password == '') {
            $query = $this->koneksi->query("UPDATE users SET username = '$username' WHERE user_id = '$id'");
        } else {
            $query = $this->koneksi->query("UPDATE users SET username = '$username', password = md5('$password') WHERE user_id = '$id'");
        }

        if ($query) {
            session_start();
            $_SESSION['success'] = "User Berhasil Diubah";
            header("location:../dashboard.php?pages=users");
        }
    }
    public function hapususers($id)
    {
        $query = $this->koneksi->query("DELETE FROM users WHERE user_id = '$id'");
        if ($query) {
            session_start();
            $_SESSION['success'] = "User Berhasil Dihapus";
            header("location:../dashboard.php?pages=users");
        }
    }
    public function prosestambahusers($username, $password)
    {
        if ($username == '' || $password == '') {
            session_start();
            $_SESSION['fail'] = "Data Gagal Disimpan!";

            header("location:../dashboard.php?pages=users");
        } else {
            $query = $this->koneksi->query("INSERT INTO users VALUES (null,'$username',md5('$password'),'Petugas','0')");
            session_start();
            $_SESSION['success'] = "Data Berhasil Disimpan!";

            header("location:../dashboard.php?pages=users");
        }
    }
    public function jumlahusers()
    {
        $query = $this->koneksi->query("SELECT * FROM users");
        return $query->num_rows;
    }



    public function listsiswa()
    {

        $query = $this->koneksi->query("SELECT * FROM siswa");
        while ($data = $query->fetch_object()) {
            $hasil[] = $data;
        }
        return $hasil;
    }
    public function prosestambahsiswa($nisn, $nama, $kelas, $foto)
    {
        if ($nisn == '' || $nama == '' || $kelas == '' || $foto == '') {
            session_start();
            $_SESSION['fail'] = "Data belum diisi, isi terlebih dahulu";
        } else {
            $ukuran = $_FILES['photo']['size'];
            $error = $_FILES['photo']['error'];

            if ($ukuran > 0 || $error == 0) {
                $move = move_uploaded_file($_FILES['photo']['tmp_name'], '../assets/images/' . $foto);
                if ($move) {
                    echo "File '$foto' dengan ukuran $ukuran sudah terupload";
                } else {
                    echo "Terjadi kesalahan mengupload";
                }
            } else {
                echo "File Gagal Diupload" . $error;
            }
        }

        $query = $this->koneksi->query("INSERT INTO siswa VALUES(null,'$nisn','$nama','$kelas','$foto')");
        $query = $this->koneksi->query("INSERT INTO users VALUES(null,'$nisn',md5('$nisn'),'Siswa','$nisn')");

        if ($query) {
            session_start();
            $_SESSION['success'] = "Siswa berhasil di tambah";
            header('location:../dashboard.php?pages=siswa');
        }
    }
    public function ubahsiswa($nisn, $nama, $kelas, $foto, $id)
    {
        if ($nisn == '' || $nama == '' || $kelas == '' || $foto == '') {
            session_start();
            $_SESSION['fail'] = "User Gagal di Ubah";
            header('location:../dashboard.php?pages=siswa');
        } else {
            move_uploaded_file($_FILES['photo']['tmp_name'], '../assets/img/' . $foto);
            $query = $this->koneksi->query("UPDATE siswa SET nisn='$nisn',nama_siswa='$nama',kelas='$kelas',photo='$foto' WHERE siswa_id=$id");
        }

        if ($query) {
            session_start();
            $_SESSION['success'] = "User Berhasil di Ubah";
            header('location:../dashboard.php?pages=siswa');
        }
    }
    public function tampilubahsiswa($id)
    {
        $query = $this->koneksi->query("SELECT * FROM siswa where siswa_id=$id");
        $data = $query->fetch_object();
        return $data;
    }
    public function hapussiswa($id)
    {
        $query = $this->koneksi->query("DELETE FROM siswa where siswa_id=$id");

        if ($query) {
            session_start();
            $_SESSION['success'] = "Siswa Berhasil di Hapus";
            header('location:../dashboard.php?pages=siswa');
        }
    }
    public function jumlahsiswa()
    {
        $query = $this->koneksi->query("SELECT * FROM siswa");
        return $query->num_rows;
    }



    public function listbuku()
    {

        $query = $this->koneksi->query("SELECT * FROM buku");
        while ($data = $query->fetch_object()) {
            $hasil[] = $data;
        }
        return $hasil;
    }
    public function prosestambahbuku($judul, $deskripsi, $penulis, $penerbit, $cover)
    {
        if ($judul == '' || $deskripsi == '' || $penulis == '' || $penerbit == '') {
        } else {
            $ukuran = $_FILES['cover']['size'];
            $error = $_FILES['cover']['error'];

            if ($ukuran > 0 || $error == 0) {
                $move = move_uploaded_file($_FILES['cover']['tmp_name'], '../assets/img/' . $cover);
                if ($move) {
                    echo "File '$cover' dengan ukuran $ukuran sudah terupload";
                } else {
                    echo "Terjadi kesalahan mengupload";
                }
            } else {
                echo "File Gagal Diupload" . $error;
            }
        }

        $query = $this->koneksi->query("INSERT INTO buku VALUES(null,'$judul','$deskripsi','$penulis','$penerbit', '$cover')");

        if ($query) {
            session_start();
            $_SESSION['success'] = "Buku berhasil di tambah";
            header('location:../dashboard.php?pages=buku');
        }
    }
    public function ubahbuku($judul, $deskripsi, $penulis, $penerbit, $cover, $id)
    {
        if ($judul == '' || $deskripsi == '' || $penulis == '' || $penerbit == '' || $cover == '') {
        } else {
            $ukuran = $_FILES['cover']['size'];
            $error = $_FILES['cover']['error'];
            if ($ukuran > 0 || $error == 0) {
                $move = move_uploaded_file($_FILES['cover']['tmp_name'], '../assets/img/' . $cover);
                if ($move) {
                    echo "File '$cover' dengan ukuran $ukuran sudah terupload";
                } else {
                    echo "Terjadi kesalahan mengupload";
                }
            } else {
                echo "File Gagal Diupload" . $error;
            }
        }
        $query = $this->koneksi->query("UPDATE buku SET judul_buku='$judul',deskripsi='$deskripsi',penulis='$penulis',penerbit='$penerbit',gambar='$cover' WHERE id_buku=$id");
        if ($query) {
            session_start();
            $_SESSION['success'] = "Buku Berhasil di Ubah";
            header('location:../dashboard.php?pages=buku');
        }
    }
    public function tampilubahbuku($id)
    {
        $query = $this->koneksi->query("SELECT * FROM buku where id_buku=$id");
        $data = $query->fetch_object();
        return $data;
    }
    public function hapusbuku($id)
    {
        $query = $this->koneksi->query("DELETE FROM buku where id_buku=$id");

        if ($query) {
            session_start();
            $_SESSION['success'] = "Buku Berhasil di Hapus";
            header('location:../dashboard.php?pages=buku');
        }
    }
    public function jumlahbuku()
    {
        $query = $this->koneksi->query("SELECT * FROM buku");
        return $query->num_rows;
    }

    public function listpeminjaman()
    {
        $query = $this->koneksi->query("SELECT * FROM peminjaman
        INNER JOIN buku ON buku.id_buku = peminjaman.id_buku
        INNER JOIN siswa ON siswa.nisn = peminjaman.nisn");
        while ($pinjam = $query->fetch_array()) {
            $hasil[] = $pinjam;
        }
        return $hasil;
    }

    public function prosestambahpeminjaman($nomorpeminjaman, $siswa, $buku, $tanggalpinjam, $tanggalkembali)
    {
        $query = $this->koneksi->query("INSERT INTO peminjaman VALUES
        ('$nomorpeminjaman','$buku','$siswa','$tanggalpinjam','$tanggalkembali')");

        if ($query) {
            session_start();
            $_SESSION['success'] = 'Data peminjaman berhasil disimpan';
            header("location:../dashboard.php?pages=peminjaman");
        }
    }

    public function hapuspeminjaman($nisn)
    {
        $query = $this->koneksi->query("DELETE FROM peminjaman where nisn='$nisn'");

        if ($query) {
            session_start();
            $_SESSION['success'] = "Peminjaman Berhasil di Hapus";
            header('location:../dashboard.php?pages=peminjaman');
        }
    }

    public function buku()
    {
        $query = $this->koneksi->query("SELECT * FROM buku");
        while ($data = $query->fetch_object()) {
            $hasilbuku[] = $data;
        }
        return $hasilbuku;
    }

    public function jumlahpeminjaman()
    {
        $query = $this->koneksi->query("SELECT * FROM peminjaman");
        return $query->num_rows;
    }

    public function carinisn($nisn)
    {
        header("location:../dashboard.php?pages=peminjaman&act=tambah&nisn=$nisn");
    }
}

$perpus = new perpustakaan();
