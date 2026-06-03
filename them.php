<?php
include "db.php";

if(isset($_POST['them']))
{
    $mssv = trim($_POST['mssv']);
    $hoten = trim($_POST['hoten']);
    $php = $_POST['php'];
    $mysql = $_POST['mysql'];
    $html = $_POST['html'];

    if(empty($mssv) || empty($hoten))
    {
        echo "Không được để trống dữ liệu";
    }
    elseif($php < 0 || $php > 10 ||
           $mysql < 0 || $mysql > 10 ||
           $html < 0 || $html > 10)
    {
        echo "Điểm phải từ 0 đến 10";
    }
    else
    {
        $check = "SELECT * FROM sinhvien
                  WHERE mssv='$mssv'";

        $result = mysqli_query($conn, $check);

        if(mysqli_num_rows($result) > 0)
        {
            echo "Mã sinh viên đã tồn tại!";
        }
        else
        {
            $sql = "INSERT INTO sinhvien
                    VALUES('$mssv','$hoten',
                           $php,$mysql,$html)";

            mysqli_query($conn,$sql);

            header("Location: index.php");
            exit();
        }
    }
}
?>
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Quản lý sinh viên</title>
</head>
<body>

<h2>THÊM SINH VIÊN</h2>

<form method="post">

    MSSV:
    <input type="text" name="mssv"><br><br>

    Họ tên:
    <input type="text" name="hoten"><br><br>

    Điểm PHP:
    <input type="number" step="0.1" name="php"><br><br>

    Điểm MySQL:
    <input type="number" step="0.1" name="mysql"><br><br>

    Điểm HTML:
    <input type="number" step="0.1" name="html"><br><br>

    <input type="submit" name="them" value="Thêm">

</form>
