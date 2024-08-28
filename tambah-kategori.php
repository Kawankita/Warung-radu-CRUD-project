<?php
    include 'koneksi.php';

    session_start();
    if($_SESSION['status_login'] != true) {
        echo '<script>window.location="login.php"</script>';
    }
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
            <h3>Tambah Kategori</h3>
            <div class="box">
                <form action="tambah-kategori.php" method="POST">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" required>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        $nama = ucwords($_POST['nama']);
                        $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES(
                                                null,
                                                '".$nama."')");
                        if($insert) {
                            echo '<script>alert ("Kategori berhasil ditambah")</script>';
                            echo '<script>window.location="data-kategori.php"</script>';
                        }else {
                            echo 'gagal' . mysqli_error($conn);
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