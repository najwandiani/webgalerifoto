<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>
<?php include 'templates/header.php' ?>


<!-- content -->
<div class="section">
    <div class="container">
        <h3>Tambah Data category_id</h3>
        <div class="box">

            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="kategori" class="input-control" placeholder="Nama kategori" required>
                <input type="text" name="icon" class="input-control" placeholder="Nama icon" required>
                <small style="color: red;">cari icon di: <a href="https://icons.getbootstrap.com/icons/">https://icons.getbootstrap.com/icons/</a></small><br>
                <input style="margin-top: 10px;" type="submit" name="submit" value="Submit" class="btn">
            </form>
            <?php
            if (isset($_POST['submit'])) {
                $kategori = $_POST['kategori'];
                $icon = $_POST['icon'];

                $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (
						               null,
									   '" . $kategori . "',
									   '" . $icon . "'
						                   ) ");
                if ($insert) {
                    echo '<script>alert("Tambah Foto berhasil")</script>';
                    echo '<script>window.location="data-category.php"</script>';
                } else {
                    echo 'gagal' . mysqli_error($conn);
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- footer -->
<?php include 'templates/footer.php' ?>

<script>
    CKEDITOR.replace('deskripsi');
</script>
<script type="text/javascript">
    <?php echo $jsArray; ?>
</script>
</body>

</html>