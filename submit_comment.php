<?php
// Lakukan koneksi ke database
session_start();
include 'db.php';
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id ='" . $_SESSION['id'] . "'");
$d = mysqli_fetch_object($query);
$user = $d->username;
// Ambil data dari form
$image_id = $_POST['image_id'];
$comment_text = $_POST['comment_text'];

// Lakukan sanitasi data
$image_id = mysqli_real_escape_string($conn, $image_id);
$comment_text = mysqli_real_escape_string($conn, $comment_text);
$datetime = time();

// Query untuk menyimpan komentar ke database
$sql = "INSERT INTO tb_comments (image_id, user, content, time) VALUES ('$image_id', '$user', '$comment_text', '$datetime')";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    // Redirect kembali ke halaman detail
    header("Location: detail-image.php?id=$image_id");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Tutup koneksi ke database
mysqli_close($conn);
