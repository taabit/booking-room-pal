<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT * FROM bookings WHERE id='$id'")
);

if(isset($_POST['hapus'])){

if($_POST['pin'] == $data['pin']){

mysqli_query($conn,"DELETE FROM bookings WHERE id='$id'");

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

<!DOCTYPE html>
<html>

<head>

<title>Hapus Booking</title>

<link rel="stylesheet"
href="style.css?v=<?php echo time(); ?>">

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

<div class="edit-container">

<h1>Hapus Booking</h1>

<p>
Masukkan PIN untuk membatalkan booking
</p>

<form method="POST" class="edit-form">

<label>Nama Pemesan</label>

<input
type="text"
value="<?php echo $data['name']; ?>"
readonly>

<label>Ruang</label>

<input
type="text"
value="<?php echo $data['room']; ?>"
readonly>

<label>PIN</label>

<input
type="password"
name="pin"
placeholder="Masukkan PIN"
required>

<button
type="submit"
name="hapus"
class="btn-delete">

Hapus Booking

</button>

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
