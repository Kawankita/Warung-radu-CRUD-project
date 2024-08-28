<?php
    include 'koneksi.php';

    session_start();
    if($_SESSION['status_login'] != true) {
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['a_id']."'");
    $d = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warungradu</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Warungradu</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-product.php">Data Product</a></li>
                <li><a href="log-out.php">Log Out</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
     <div class="section">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
                <form action="profil.php" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                    <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $d->admin_telp ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_address ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>
                <?php
                if(isset($_POST['submit'])){
                    $nama   = ucwords($_POST['nama']);
                    $user   = $_POST['user'];
                    $hp     = $_POST['hp'];
                    $email  = $_POST['email'];
                    $alamat = ucwords($_POST['alamat']);

                    $update = mysqli_query($conn, "UPDATE tb_admin SET
                                        admin_name = '".$nama."',
                                        username = '".$user."',
                                        admin_telp = '".$hp."',
                                        admin_email = '".$email."',
                                        admin_address = '".$alamat."'
                                        WHERE admin_id = '".$d->admin_id."'");
                    if($update){
                        echo '<script>alert("Ubah data berhasil")</script>';
                        echo '<script>window.location="profil.php"</script>';
                    }else {
                        echo 'Gagal' . mysqli_error($conn);
                    }
                }
                ?>
            </div>
            <h3>Ubah Password</h3>
            <div class="box">
                <form action="profil.php" method="POST">
                    <input type="password" name="password1" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="password2" placeholder="Konfirmasi Password" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                </form>
                <?php
                if(isset($_POST['ubah_password'])){
                    $password1   = $_POST['password1'];
                    $password2   = $_POST['password2'];

                    if($password2 != $password1){
                        echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
                    }else {
                        $u_password = mysqli_query($conn, "UPDATE tb_admin SET
                                        password = '".MD5($password1)."'
                                        WHERE admin_id = '".$d->admin_id."'");

                        if($u_password){
                            echo '<script>alert("Ubah Password berhasil")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        } else{
                            echo 'Gagal' . mysqli_error($conn);
                        }
                    }

                }
                ?>
            </div>
        </div>
     </div>

     <!-- footer -->
      <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Warungradu.</small>
        </div>
      </footer>
</body>
</html>