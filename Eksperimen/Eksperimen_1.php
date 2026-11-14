<?php
$nama = "Fahrul Rahman";

$tugas = 85;
$uts = 80;
$uas = 90;

$rataRata = ($tugas + $uts + $uas) / 3;

echo "<h2>Perhitungan Nilai Mahasiswa</h2>";
echo "Nama: " . $nama . "<br>";
echo "Nilai Tugas: " . $tugas . "<br>";
echo "Nilai UTS: " . $uts . "<br>";
echo "Nilai UAS: " . $uas . "<br>";
echo "Nilai Rata-rata: " . number_format($rataRata, 2);
