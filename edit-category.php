<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

$produk = mysqli_query($conn, "SELECT * FROM  tb_category WHERE category_id = '" . $_GET['id'] . "'");
if (mysqli_num_rows($produk) == 0) {
    echo '<script>window.location="data-image.php"</script>';
}
$p = mysqli_fetch_object($produk);
?>
<?php include 'templates/header.php' ?>

<!-- content -->
<div class="section">
    <h3>Edit Data Foto</h3>
    <div class="box">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="kategori" class="input-control" placeholder="Nama kategori" value="<?php echo $p->category_name ?>" required>
            <input type="text" name="icon" class="input-control" placeholder="Nama Foto" value="<?php echo $p->icon ?>" required>
            <small style="color: red;">cari icon di: <a href="https://icons.getbootstrap.com/icons/">https://icons.getbootstrap.com/icons/</a></small><br>
            <input type="submit" name="submit" value="Submit" class="btn">
        </form>
        <?php
        if (isset($_POST['submit'])) {

            // data inputan dari form
            $kategori  = $_POST['kategori'];
            $icon      = $_POST['icon'];

            //query update data produk
            $update = mysqli_query($conn, "UPDATE tb_category SET
                                   category_name  = '" . $kategori . "',
                                   icon  = '" . $icon . "'
                                   WHERE category_id = '" . $p->category_id . "' ");
            if ($update) {
                echo '<script>alert("Ubah data berhasil")</script>';
                echo '<script>window.location="data-category.php"</script>';
            } else {
                echo 'gagal' . mysqli_error($conn);
            }
        }

        ?>
    </div>
</div>
</div>

<?php include 'templates/footer.php' ?>
<script>
    CKEDITOR.replace('deskripsi');
</script>
</body>

</html>