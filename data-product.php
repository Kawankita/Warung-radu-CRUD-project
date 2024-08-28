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
            <h3>Data Product</h3>
            <div class="box">
                <p><a href="tambah-product.php">Tambah Data Product</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th>Nama Product</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;  
                            $product = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                            if(mysqli_num_rows($product) > 0) {
                            while($row = mysqli_fetch_array($product)){
                        ?>
                        <tr>
                            <td><?php echo $no++?></td>
                            <td><?php echo $row['category_name']?></td>
                            <td><?php echo $row['product_name']?></td>
                            <td>Rp. <?php echo number_format($row['product_price'])?></td>
                            <td><a href="produk/<?php echo $row['product_image']?>" target="_blank"><img src="produk/<?php echo $row['product_image']?>" width="50px"></a></td>
                            <td><?php echo ($row['product_status'] == 0)? 'Tidak aktif':'Aktif'; ?></td>
                            <td>
                                <a href="edit-product.php?id=<?php echo $row['product_id'] ?>">Edit</a> || <a href="proses-hapus.php?idp=<?php echo $row['product_id']?>" onclick="return confirm('Yakin hapus product ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="7">Tidak ada data</td>
                            </tr>

                            <?php }?>
                    </tbody>
                </table>
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