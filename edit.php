<?php
include 'koneksi.php';

?>
<!DOCTYPE html>

<html>
<head>

<title>Edit Booking</title>

<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

</head>

<body>

<?php

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT * FROM bookings WHERE id='$id'")
);

if(isset($_POST['update'])){

if($_POST['pin'] == $data['pin']){

$name = $_POST['name'];
$purpose = $_POST['purpose'];

$date = $_POST['date'];
$start_time = $_POST['start_time'];

mysqli_query($conn,"
UPDATE bookings
SET
name='$name',
purpose='$purpose',
date='$date',
start_time='$start_time'
WHERE id='$id'
");

header("Location:index.php");
exit;
}else{

echo "
<script>
alert('PIN salah!');
window.location='index.php';
</script>
";

}
}
?>

<header class="topbar">

<div class="header-text">

<h1>Booking Meeting Room</h1>

<div class="subtitle">
Divisi Rantai Pasok
</div>

</div>

<img src="logo.png" class="logo-pal">

</header>

<div class="edit-container">

<h1>Edit Booking</h1>

<p>Perbarui Data Booking Ruang Rapat</p>

<form method="POST" class="edit-form">


<label>Nama</label>

<input
type="text"
name="name"
value="<?php echo $data['name']; ?>">

<label>Tanggal Booking</label>

<input
type="date"
name="date"
value="<?php echo $data['date']; ?>">

<label>Jam Mulai</label>

<input
type="time"
name="start_time"
value="<?php echo $data['start_time']; ?>">

<label>Keperluan</label>

<input
type="text"
name="purpose"
value="<?php echo $data['purpose']; ?>">

<label>PIN Verifikasi</label>

<input
type="password"
name="pin"
placeholder="Masukkan PIN">

<button name="update">Update</button>

<button
type="button"
onclick="window.location.href='index.php'"
class="btn-back">
Kembali
</button>

</form>
</div>
</body>
</html>