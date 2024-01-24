<?php
include('conn.php');

// Data jam dan tanggal
date_default_timezone_set('Asia/Jakarta');
$jam = date('H:i:s');
$tanggal = date('d-m-y');

// Pengiriman data sensor dengan GET
$data_sensor = $_GET['data_sensor'];

// Ambil data suhu dari database (gantilah 'nama_tabel' dan 'kolom_suhu' sesuai dengan struktur database Anda)
$query = mysqli_query($koneksi, "SELECT data_sensor FROM data ORDER BY id DESC LIMIT 1");
$row = mysqli_fetch_assoc($query);
$suhu_terkini = $row['data_sensor'];

// Tentukan nilai status berdasarkan kondisi suhu
if ($suhu_terkini > 33) {
    $status = 'AC Menyala / Menurunkan Temperatur';
} else {
    $status = 'Suhu Normal';
}

// Input data ke database
$input = mysqli_query($koneksi, "INSERT INTO data (tanggal, jam, data_sensor, status) VALUES ('$tanggal', '$jam', '$data_sensor', '$status')");

// Periksa apakah input berhasil atau tidak
if ($input == TRUE) {
    echo "Data Sensor Berhasil Di Input. Status: $status";
} else {
    echo "Gagal Input data sensor";
}
?>
