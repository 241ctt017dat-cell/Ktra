<?php
include "db.php";

$mssv = $_GET['mssv'];

$sql = "DELETE FROM sinhvien
        WHERE mssv='$mssv'";

mysqli_query($conn,$sql);

header("Location: index.php");
?>