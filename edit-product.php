<?php
    include 'koneksi.php';

    session_start();
    if($_SESSION['status_login'] != true) {
        echo '<script>window.location="login.php"</script>';
    }

    $product = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($product) == 0){
        echo '<script>window.location="data-product.php"</script>';
    }
    $p = mysqli_fetch_object($product);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warungradu</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
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
            <h3>Edit Product</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih--</option>
                        <?php 
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id']?>"<?php echo ($r['category_id'] == $p->category_id)?'selected':'';?>><?php echo $r['category_name']?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Product" value="<?php echo $p->product_name?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->product_price?>"required>
                    
                    <img src="produk/<?php echo $p->product_image ?>" width="100px">
                    <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="input-control">
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->product_description?></textarea><br>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($p->product_status == 1)? 'selected':'';?>>Aktif</option>
                        <option value="0" <?php echo ($p->product_status == 0)? 'selected':'';?>>Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                    // data inputan dari form
                    $kategori   = $_POST['kategori'];
                    $nama       = $_POST['nama'];
                    $harga      = $_POST['harga'];
                    $deskripsi  = $_POST['deskripsi'];
                    $status     = $_POST['status'];
                    $foto     = $_POST['foto'];  

                    // data gambar yang baru
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                   

                    // jika admin ganti gambar
                    if($filename != '') {
                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];
    
                        $newname = 'produk' .time().'.'.$type2;
    
                        // menampung data format file yang diijinkan
                        $tipe_diijinkan = array('jpg','jpeg','png', 'gif');

                        if(!in_array($type2, $tipe_diijinkan)) {
                            // jika format file tidak ada didalam array diijinkan
                            echo '<script>alert ("Format File Tidak Diijinkan")</script>';

                        }else{
                             unlink('./produk/'.$foto);
                             move_uploaded_file($tmp_name, './produk/' .$newname);
                             $namagambar = $newname;
                        }

                    }else {
                        // jika admin tidak ganti gambar
                        $namagambar = $foto;
                    }

                    // query update data product
                    $update = mysqli_query($conn, "UPDATE tb_product SET
                                                category_id = '".$kategori."',
                                                product_name = '".$nama."',
                                                product_price = '".$harga."',
                                                product_description = '".$deskripsi."',
                                                product_image = '".$namagambar."',
                                                product_status = '".$status."'
                                                WHERE product_id = '".$p->product_id."' ");
                    if($update) {
                                echo '<script>alert ("Edit data berhasil")</script>';
                                echo '<script>window.location="data-product.php"</script>';
                       } else {
                             echo 'Edit data gagal' .mysqli_error($conn);
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
      <script>
            CKEDITOR.replace('deskripsi');
      </script>
</body>
</html>