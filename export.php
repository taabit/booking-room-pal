<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Riwayat_Booking.xls");

echo "
<table border='1'>

<tr>
<th>Tanggal</th>
<th>Jam Mulai</th>
<th>Jam Selesai</th>
<th>Ruang</th>
<th>Nama</th>
<th>Departemen</th>
<th>Keperluan</th>
</tr>
";

$q = mysqli_query($conn,"
SELECT *
FROM bookings
ORDER BY date DESC
");

while($d = mysqli_fetch_assoc($q)){

echo "

<tr>

<td>$d[date]</td>

<td>$d[start_time]</td>

<td>$d[end_time]</td>

<td>$d[room]</td>

<td>$d[name]</td>

<td>$d[department]</td>

<td>$d[purpose]</td>

</tr>

";

}

echo "</table>";
?>