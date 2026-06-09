<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Booking Room</title>
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
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

<?php

$totalBooking = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
")
)['total'];

$bookingHariIni = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
WHERE date=CURDATE()
")
)['total'];

$ruangFavorit = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT room,
COUNT(*) total
FROM bookings
GROUP BY room
ORDER BY total DESC
LIMIT 1
")
);

?>

<div class="dashboard">
  <div class="dash-card">
    <h2><?php echo $totalBooking; ?></h2>
      <p>Total Booking</p>
  </div>

  <div class="dash-card">
    <h2><?php echo $bookingHariIni; ?></h2>
      <p>Booking Hari Ini</p>
  </div>

  <div class="dash-card">
    <h2><?php echo $ruangFavorit['room']; ?></h2>
      <p>Paling Sering Digunakan</p>
  </div>

  <div class="dash-card">
    <h2>4</h2>
      <p>Total Ruangan</p>
  </div>
</div>

<div class="container">

  <!-- LEFT -->
<div class="left">
  <div class="rooms">

  <?php
  $rooms = [
    "Ruang Rapat 1",
    "Ruang Rapat 2",
    "Ruang Rapat 3",
    "Ruang Rapat 4"];

  $info = [
  "Ruang Rapat 1"=> "",
  "Ruang Rapat 2"=> "",
  "Ruang Rapat 3" => "Ex Pingpong",
  "Ruang Rapat 4" => "Timur Adaprod"
  ];

  foreach($rooms as $r){

  $cek = mysqli_query($conn,"
  SELECT * FROM bookings
  WHERE room='$r'
  AND date = CURDATE()
  AND CURTIME() BETWEEN start_time AND end_time
  ");

  if(mysqli_num_rows($cek) > 0){

  $dataRoom = mysqli_fetch_assoc($cek);

  $status = "
    <p class='used'>
    🔴 Dipakai sampai
    ".$dataRoom['end_time']."
    </p>
  ";

  }else{

  $status = "
    <p class='available'>
    🟢 Kosong
    </p>
  ";

  }

echo "
<div class='card'>
  <h3>$r</h3>
  <p class='room-desc'>
".$info[$r]."
</p>
  $status
  <button onclick=\"openModal('$r')\">
    Book Now
  </button>
</div>
";
}
?>

    </div>

  </div>

<!-- RIGHT -->
<div class="right">

  <div class="schedule">
    <form method="GET" class="filter-form">
      <input type="date"
        name="tanggal"
        value="<?php
        echo isset($_GET['tanggal'])
        ? $_GET['tanggal']
        : date('Y-m-d');
        ?>">

      <button type="submit">
      Filter
      </button>

      <a href="history.php"
      class="btn-history">
      Riwayat Booking
      </a>
    </form>

    <h3>Jadwal Booking</h3>

    <div class='booking-list'>
      <div class="booking-header">
      <span>Jam</span>
      <span>Ruang</span>
      <span>Nama</span>
      <span>Keperluan</span>
      </div>

<?php

$tanggal = isset($_GET['tanggal'])
? $_GET['tanggal']
: date('Y-m-d');

$q = mysqli_query($conn,"
SELECT * FROM bookings
WHERE date='$tanggal'
ORDER BY start_time
");

while($d = mysqli_fetch_assoc($q)){

echo "

<div class='booking-item'>
  <div class='booking-info'>
    <span>$d[start_time] - $d[end_time]</span>
    <span>$d[room]</span>
    <span>$d[name]</span>
    <span>$d[purpose]</span>
  </div>

  <div class='booking-hover'>
    <a href='edit.php?id=$d[id]'>
    Edit
    </a>
    <a href='delete.php?id=$d[id]'>
    Hapus
    </a>
  </div>
</div>

";

}

?>

</div>

    </div>

  </div>

</div>

<!-- MODAL -->
<div id="modal" class="modal">
  <form method="POST" action="booking.php" class="modal-content">
    <input type="hidden" name="room" id="roomInput">
    <input type="text" name="name" placeholder="Nama" required>
    <input type="text" name="department" placeholder="Departemen" required>
    <input type="number" name="pin" placeholder="PIN untuk edit dan hapus booking" required>
    <input type="date" name="date" required>
    <input type="time" name="start_time" required>
    <input type="number" name="duration" placeholder="Durasi (jam)" required>
    <textarea name="purpose" placeholder="Keperluan"></textarea>
    <button type="submit">Booking</button>
    <button type="button" onclick="closeModal()">Batal</button>
  </form>
</div>

<script>
function openModal(room){
  document.getElementById('modal').style.display='block';
  document.getElementById('roomInput').value=room;
}

function closeModal(){
  document.getElementById('modal').style.display='none';
}
</script>

<footer class="footer">

© 2026 PT PAL Indonesia | Developed by Byrlianty Tsabita El Haqq (ITS)

</footer>

</body>
</html>