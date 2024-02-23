<?php
session_start();
error_reporting(0);
include 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
$a = mysqli_fetch_object($kontak);
?>
<?php include 'templates/header.php' ?>

<!-- search -->
<div class="search">
    <form action="galeri.php">
        <input type="text" name="search" placeholder="Cari Foto" value="<?php echo $_GET['search'] ?>" />
        <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
        <input type="submit" name="cari" value="Cari Foto" />
    </form>
</div>

<div class="section">
    <h3>Galeri Najwa</h3>
    <div class="box">
        <?php
        $where = "";
        if (!empty($_GET['search'])) {
            $search = mysqli_real_escape_string($conn, $_GET['search']);
            $where .= "AND image_name LIKE '%$search%' ";
        }
        if (!empty($_GET['kat'])) {
            $kat = mysqli_real_escape_string($conn, $_GET['kat']);
            $where .= "AND category_id LIKE '%$kat%' ";
        }
        $foto = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_status = 1 $where ORDER BY image_id DESC");
        if (mysqli_num_rows($foto) > 0) {
            while ($p = mysqli_fetch_array($foto)) {
        ?>
                <a href="detail-image.php?id=<?php echo $p['image_id'] ?>">
                    <div class="col-4">
                        <img src="foto/<?php echo $p['image'] ?>" height="150px" />
                        <p class="nama"><?php echo substr($p['image_name'], 0, 30) ?></p>
                        <p class="admin">Nama User : <?php echo $p['admin_name'] ?></p>
                        <p class="tanggal">Tanggal : <?php echo $p['date_created'] ?></p>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "<p>Foto tidak ada</p>";
        }
        ?>
    </div>
</div>


<!-- footer -->
<?php include 'templates/footer.php' ?>
</body>

</html>