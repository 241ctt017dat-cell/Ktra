<?php include("db.php"); ?>
<h2>DANH SÁCH SINH VIÊN</h2>
<a href="them.php">Them Sinh Vien</a>
<table border="1">

<tr>
    <th>MSSV</th>
    <th>Họ tên</th>
    <th>ĐTB</th>
    <th>Xếp loại</th>
    <th>Học bổng</th>
    <th>Cao nhất</th>
    <th>Thấp nhất</th>
    <th>TB các môn</th>
    <th>Xóa</th>
</tr>

<?php

$sql = "SELECT * FROM sinhvien";
$result = mysqli_query($conn,$sql);

$tongSV = 0;
$tongHB = 0;

$gioi = 0;
$kha = 0;
$tb = 0;
$yeu = 0;
while($row = mysqli_fetch_assoc($result))
{
    $dtb =
    ($row['php']*2 +
     $row['mysql']*2 +
     $row['html']) / 5;

    if($dtb >= 8)
        $xeploai = "Giỏi";
    elseif($dtb >= 6.5)
        $xeploai = "Khá";
    elseif($dtb >= 5)
        $xeploai = "Trung bình";
    else
        $xeploai = "Yếu";
        $tongSV++;
    // Học bổng
    if($dtb >= 8 &&
       $row['php'] >= 7 &&
       $row['mysql'] >= 7 &&
       $row['html'] >= 7)
    {
        $hocbong = "Đủ điều kiện";
    }
    else
    {
        $hocbong = "Không đủ";
    }

    // Cao nhất - thấp nhất
    $max = max(
        $row['php'],
        $row['mysql'],
        $row['html']
    );

    $min = min(
        $row['php'],
        $row['mysql'],
        $row['html']
    );
    $tbmon = round(
        ($row['php'] +
         $row['mysql'] +
         $row['html']) / 3,
        2);
    // Đếm xếp loại
if($xeploai == "Giỏi")
$gioi++;
elseif($xeploai == "Khá")
$kha++;
elseif($xeploai == "Trung bình")
$tb++;
else
$yeu++;
?>

<tr>
    <td><?= $row['mssv']; ?></td>
    <td><?= $row['hoten']; ?></td>
    <td><?= round($dtb,2); ?></td>
    <td><?= $xeploai; ?></td>
    <td><?= $hocbong ?></td>
    <td><?= $max ?></td>
    <td><?= $min ?></td>
    <td><?= $tbmon; ?></td>
    <td>
    <a href="xoa.php?mssv=<?= $row['mssv']; ?>"
       onclick="return confirm('Bạn có chắc muốn xóa sinh viên này không?');">
       Xóa
    </a>
</td>
</tr>
<?php 
}
?>
</table>
<h3>THỐNG KÊ</h3>

<p>Tổng sinh viên:
    <?= $tongSV ?>
</p>

<p>Tổng sinh viên có học bổng:
    <?= $tongHB ?>
</p>

<p>Số sinh viên Giỏi:
    <?= $gioi ?>
</p>

<p>Số sinh viên Khá:
    <?= $kha ?>
</p>

<p>Số sinh viên Trung bình:
    <?= $tb ?>
</p>

<p>Số sinh viên Yếu:
    <?= $yeu ?>
</p>