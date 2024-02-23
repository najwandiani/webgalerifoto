<?php

include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '$id'");
    if ($delete) {
        header("Location: data-category.php");
        exit; // Pastikan untuk keluar setelah melakukan redirect
    } else {
        echo 'gagal' . mysqli_error($conn);
    }
}
