<?php
include 'koneksi.php';

$room = $_POST['room'];
$name = $_POST['name'];
$dept = $_POST['department'];
$nik = $_POST['nik'];
$pin = $_POST['pin'];
$date = $_POST['date'];
$start = $_POST['start_time'];
$duration = $_POST['duration'];
$purpose = $_POST['purpose'];

$end = date("H:i:s", strtotime("+$duration hour", strtotime($start)));

// cek bentrok
$cek = mysqli_query($conn,"
SELECT * FROM bookings 
WHERE room='$room'
AND date='$date'
AND (
(start_time <= '$start' AND end_time > '$start')
OR
(start_time < '$end' AND end_time >= '$end')
)
");

if(mysqli_num_rows($cek) > 0){

echo "
<script>
alert('Jadwal bentrok!');
window.location='index.php';
</script>
";

exit;
}

// simpan booking
$query = mysqli_query($conn,"
INSERT INTO bookings
(room,name,department,nik,pin,date,start_time,end_time,purpose)
VALUES
('$room','$name','$dept','$nik','$pin','$date','$start','$end','$purpose')
");

if($query){
  header("Location: index.php");
}else{
  echo "Gagal: " . mysqli_error($conn);
}
?>