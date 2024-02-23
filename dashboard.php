<?php
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>
<?php include 'templates/header.php'  ?>


<!-- content -->
<div class="section">
    <h3>Dashboard</h3>
    <div class="box">
        <h4>Selamat Datang <?= $_SESSION['a_global']->admin_name ?> di Website Galeri Foto.</h4>
    </div>
    <button class="btn btn-primary" onclick="window.location='data-image.php'">Lihat data image</button>
    <button class="btn btn-primary" onclick="window.location='data-category.php'">Lihat data kategori</button>
</div>

<?php include 'templates/footer.php' ?>