<?php
session_start();
error_reporting(0);
include 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
$a = mysqli_fetch_object($kontak);

$produk = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_id = '" . $_GET['id'] . "' ");
$p = mysqli_fetch_object($produk);
if (isset($_POST['like'])) {
    $image_id = $_GET['id']; // Ambil ID gambar dari URL atau dari POST jika menggunakan hidden input
    $query = "UPDATE tb_image SET like_count = like_count + 1 WHERE image_id = $image_id";
    mysqli_query($conn, $query);
    // Redirect atau refresh halaman untuk memperbarui jumlah like
    header("Refresh:0");
}
if (isset($_POST['unlike'])) {
    if ($p->like_count == 0) {
        header("Refresh:0");
        return; // Keluar dari skrip jika like_count sudah 0
    } else {
        $image_id = $_GET['id']; // Ambil ID gambar dari URL atau dari POST jika menggunakan hidden input
        $query = "UPDATE tb_image SET like_count = like_count - 1 WHERE image_id = $image_id";
    }
    mysqli_query($conn, $query);
    // Redirect atau refresh halaman untuk memperbarui jumlah like
    header("Refresh:0");
    exit; // Pastikan untuk keluar dari skrip setelah mengirimkan header
}
?>

<?php include 'templates/header.php' ?>

<!-- search -->
<div class="search">
    <div class="container">
        <form action="galeri.php">
            <input type="text" name="search" placeholder="Cari Foto" value="<?php echo $_GET['search'] ?>" />
            <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
            <input type="submit" name="cari" value="Cari Foto" />
        </form>
    </div>
</div>

<!-- product detail -->
<div class="section">
    <h3>Detail Foto</h3>
    <div class="box">
        <div class="col-2">
            <img src="foto/<?php echo $p->image ?>" width="100%" />
        </div>
        <div class="col-2">
            <h3><?php echo $p->image_name ?><br />Kategori : <?php echo $p->category_name  ?></h3>
            <h4>Nama User : <?php echo $p->admin_name ?><br />
                Upload Pada Tanggal : <?php echo $p->date_created  ?></h4>
            <p>Deskripsi :<br />
                <?php echo $p->image_description ?>
            </p>
        </div>
        <!-- Tombol Like -->
        <span class="like-count" style="margin-right: 10px;"><?= $p->like_count ?> Likes</span>
        <form method="POST" style="display: inline;">
            <button type="submit" name="like" class="btn-like"><i class="bi bi-hand-thumbs-up" style="font-size: 20px"></i></button>
        </form>
        <form method="POST" style="display: inline;">
            <button type="submit" name="unlike" class="btn-like"><i class="bi bi-hand-thumbs-down" style="font-size: 20px"></i></button>
        </form>
        <!-- Jumlah Like -->


    </div>
    <h4>Komentar</h4>
    <!-- Komentar -->
    <?php require_once 'convert_time.php' ?>
    <div class="komentar" style="margin-top: 12px;">

        <!-- Daftar Komentar -->
        <div class="daftar-komentar">
            <?php
            $comments = mysqli_query($conn, "SELECT * FROM tb_comments WHERE image_id = $p->image_id ORDER BY comment_id DESC");
            if (mysqli_num_rows($comments) > 0) {
                while ($comment = mysqli_fetch_array($comments)) {
            ?>
                    <div class="komentar-item">
                        <p><strong><?php echo $comment['user']; ?> - <?php echo time_ago($comment['time']); ?></strong>
                        <div style="margin-left: 10px;"><?php echo $comment['content']; ?></div>
                        </p>
                        <p class="komentar-tanggal"></p>
                    </div>
            <?php
                }
            } else {
                echo "<p>Belum ada komentar.</p>";
            }
            ?>
        </div>
        <!-- Form Komentar -->
        <?php if ($_SESSION['status_login'] == true) : ?>
            <form method="POST" action="submit_comment.php" style="margin-top: 12px;">
                <textarea name="comment_text" placeholder="Tambahkan komentar Anda"></textarea>
                <input type="hidden" name="image_id" value="<?php echo $p->image_id ?>">
                <button class="btn btn-primary" type="submit">Kirim Komentar</button>
            </form>
        <?php else : ?>
            Login untuk menambahan komentar
            <a style="margin-top: 20px; " href="login.php" class="btn">Login</a>
        <?php endif; ?>
    </div>

</div>

<?php include 'templates/footer.php' ?>

</body>

</html>