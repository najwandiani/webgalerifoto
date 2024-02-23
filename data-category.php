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
    <h3>Data category</h3>
    <div class="box">
        <button style="margin-bottom: 17px;" class="btn btn-primary" onclick="window.location='tambah-category.php'">Tambah data</button>
        <table border="1" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th width="60px">No</th>
                    <th>Kategori</th>
                    <th>icon</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $user = $_SESSION['a_global']->admin_id;
                $foto = mysqli_query($conn, "SELECT * FROM tb_category");
                if (mysqli_num_rows($foto) > 0) {
                    while ($row = mysqli_fetch_array($foto)) {
                ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['icon'] ?></td>
                            <td>
                                <a href="edit-category.php?id=<?php echo $row['category_id'] ?>">Edit</a> |
                                <a href="proses-hapus-category.php?id=<?php echo $row['category_id'] ?>" onclick="return confirm('Yakin Ingin Hapus ?')">Hapus</a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="8">Tidak ada data.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- footer -->
<?php include 'templates/footer.php' ?>

</body>

</html>