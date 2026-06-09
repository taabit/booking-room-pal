<?php
include 'koneksi.php';

$q = mysqli_query($conn,"
SELECT *
FROM bookings
ORDER BY date DESC, start_time DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Riwayat Booking</title>

<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

</head>

<body>

<header class="topbar">

<div class="header-text">

<h1>Booking Meeting Room</h1>

<div class="subtitle">
Divisi Rantai Pasok
</div>

</div>

<img src="logo.png" class="logo-pal">

</header>

<div class="history-container">

<h1 class="history-title">
Riwayat Booking
</h1>

<div class="history-action">

<a href="index.php" class="btn-history">
← Kembali ke Dashboard
</a>

<button
type="button"
class="btn-export"
onclick="window.open('export.php','_blank')">

Download

</button>

</div>

<div class="history-table">

<table>

<thead>

<tr>
<th>Tanggal</th>
<th>Jam</th>
<th>Ruang</th>
<th>Nama</th>
<th>Departemen</th>
<th>Keperluan</th>
</tr>

</thead>

<tbody>

<?php while($d = mysqli_fetch_assoc($q)){ ?>

<tr>

<td><?php echo $d['date']; ?></td>

<td>
<?php echo $d['start_time']; ?>
-
<?php echo $d['end_time']; ?>
</td>

<td><?php echo $d['room']; ?></td>

<td><?php echo $d['name']; ?></td>

<td><?php echo $d['department']; ?></td>

<td><?php echo $d['purpose']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>

</html>