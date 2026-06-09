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

<form method="POST">

<h3>Cancel Booking</h3>

<input type="password" name="pin" placeholder="Masukkan PIN">

<button name="hapus">Cancel Booking</button>

</form>