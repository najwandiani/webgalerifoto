<?php
session_start();
include 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
$a = mysqli_fetch_object($kontak);
?>
<?php include 'templates/header.php' ?>


<!-- search -->
<div class="search">
    <div class="container">
        <form action="galeri.php">
            <input type="text" name="search" placeholder="Cari Foto" />
            <input type="submit" name="cari" value="Cari Foto" />
        </form>
    </div>
</div>

<!-- category -->
<div class="section">
    <h3>Kategori</h3>
    <div class="box">
        <?php
        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
        if (mysqli_num_rows($kategori) > 0) {
            while ($k = mysqli_fetch_array($kategori)) {
        ?>
                <a href="galeri.php?kat=<?php echo $k['category_id'] ?>">
                    <div class="col-5">
                        <i class="bi <?= $k['icon'] ?>" style="font-size: 32px;"></i>
                        <p><?php echo $k['category_name'] ?></p>
                    </div>
                </a>
            <?php }
        } else { ?>
            <p>Kategori tidak ada</p>
        <?php } ?>
    </div>
</div>
</div>

<!-- new product -->
<h3>Foto Terbaru</h3>
<div class="box">
    <?php
    $foto = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_status = 1 ORDER BY image_id DESC LIMIT 8");
    if (mysqli_num_rows($foto) > 0) {
        while ($p = mysqli_fetch_array($foto)) {
    ?>
            <a href="detail-image.php?id=<?php echo $p['image_id'] ?>">
                <div class="col-4">
                    <p style="color: #333;
                    font-weight: bold;"><?= $p['like_count'] ?> Likes</p>
                    <img src="foto/<?php echo $p['image'] ?>" height="150px" />
                    <p class="nama"><?php echo substr($p['image_name'], 0, 30)  ?></p>
                    <p class="admin">Nama User : <?php echo $p['admin_name'] ?></p>
                    <p class="nama"><?php echo $p['date_created']  ?></p>
                </div>
            </a>
        <?php }
    } else { ?>
        <p>Foto tidak ada</p>
    <?php } ?>
</div>

<?php include 'templates/footer.php' ?>

</body>

</html>