<?php
$conn = mysqli_connect("localhost","root","","qlsinhvien");

if (!$conn) {
    die("Lỗi kết nối!".mysqli_connect_error());
}
?>