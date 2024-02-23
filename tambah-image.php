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
        <h3>Tambah Data Foto</h3>
        <div class="box">

            <form action="" method="POST" enctype="multipart/form-data">

                <?php $result = mysqli_query($conn, "select * from tb_category");
                $jsArray = "var prdName = new Array();\n";
                echo '<select class="input-control" name="kategori" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]" required>  <option>-Pilih Kategori Foto-</option>';
                while ($row = mysqli_fetch_array($result)) {
                    echo ' <option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                    $jsArray .= "prdName['" . $row['category_id'] . "'] = '" . addslashes($row['category_name']) . "';\n";
                }
                echo '</select>'; ?>
                </select>
                <input type="hidden" name="nama_kategori" id="prd_name">
                <input type="hidden" name="adminid" value="<?php echo $_SESSION['a_global']->admin_id ?>">
                <input type="text" name="namaadmin" class="input-control" value="<?php echo $_SESSION['a_global']->admin_name ?>" readonly="readonly">
                <input type="text" name="nama" class="input-control" placeholder="Nama Foto" required>
                <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br />
                <input type="file" name="gambar" class="input-control" required>
                <select class="input-control" name="status">
                    <option value="">--Pilih--</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
                <input type="submit" name="submit" value="Submit" class="btn">
            </form>
            <?php
            if (isset($_POST['submit'])) {

                // print_r($_FILES[gambar']);
                // menampung inputan dari form
                $kategori  = $_POST['kategori'];
                $nama_ka   = $_POST['nama_kategori'];
                $ida         = $_POST['adminid'];
                $user      = $_POST['namaadmin'];
                $nama      = $_POST['nama'];
                $deskripsi = $_POST['deskripsi'];
                $status    = $_POST['status'];

                // menampung data file yang diupload
                $filename = $_FILES['gambar']['name'];
                $tmp_name = $_FILES['gambar']['tmp_name'];

                $type1 = explode('.', $filename);
                $type2 = $type1[1];

                $newname = 'foto' . time() . '.' . $type2;

                // menampung data format file yang diizinkan
                $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                // validasi format file
                if (!in_array($type2, $tipe_diizinkan)) {
                    // jika format file tidak ada di dalam tipe diizinkan
                    echo '<script>alert("Format file tidak diizinkan")</script>';
                } else {
                    // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                    // proses upload file sekaligus insert ke database
                    move_uploaded_file($tmp_name, './foto/' . $newname);

                    $insert = mysqli_query($conn, "INSERT INTO tb_image VALUES (
						               null,
									   '" . $kategori . "',
									   '" . $nama_ka . "',
									   '" . $ida . "',
									   '" . $user . "',
									   '" . $nama . "',
									   '" . $deskripsi . "',
									   '" . $newname . "',
									   '" . $status . "',
									   null,
                                       '" . 0 . "'
						                   ) ");

                    if ($insert) {
                        echo '<script>alert("Tambah Foto berhasil")</script>';
                        echo '<script>window.location="data-image.php"</script>';
                    } else {
                        echo 'gagal' . mysqli_error($conn);
                    }
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