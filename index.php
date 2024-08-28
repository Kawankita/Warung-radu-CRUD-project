<?php
    include 'koneksi.php';
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);
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
            <h1><a href="index.php">Warungradu</a></h1>
            <ul>
                <li><a href="product.php">Product</a></li>
            </ul>
        </div>
    </header>


     <!-- category -->
      <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php 
                    $kategori= mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori) > 0 ) {
                        while($k = mysqli_fetch_array($kategori)) {
                ?>
                    <a href="product.php?kat=<?php echo $k['category_id']?>">
                            <div class="col-5">
                                <img src="img/icon-kategory.png" width="50px" style="margin-bottom: 5px;">
                                <p><?php echo $k['category_name'] ?></p>
                            </div>
                        </a>
                <?php }}else{?>
                    <p>Kategori Tidak ada</p>
                <?php }?>
            </div>
        </div>
      </div>

      <!-- new product -->
       <div class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php 
                    $produk= mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 6");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk Anda" target="_blank">
                            <div class="col-4">
                                <img src="produk/<?php echo $p['product_image'] ?>">
                                <p class="nama"><?php echo $p['product_name']?></p>
                                <p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
                            </div>
                        </a>
                <?php }}else{?>
                    <p> Produk Tidak ada</p>
                <?php }?>
            </div>
        </div>
       </div>

       <!-- footer -->
        <div class="footer">
            <div class="container">
                <h4>Alamat</h4>
                <p><?php echo $a->admin_address?></p>

                <h4>Email</h4>
                <p><?php echo $a->admin_email?></p>

                <h4>No. Hp</h4>
                <p><?php echo $a->admin_telp?></p>

                <small>Copyright &copy; 2024 - Warungradu.</small>
            </div>
        </div>
</body>
</html>