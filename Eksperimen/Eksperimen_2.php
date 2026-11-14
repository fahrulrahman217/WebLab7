<?php
$mahasiswa = ["Fahrul", "Andi", "Budi", "Siti", "Rani"];

$hasil = null;

if (isset($_GET["nama"])) {
    $cari = trim($_GET["nama"]);

    foreach ($mahasiswa as $nama) {
        if (strcasecmp($nama, $cari) == 0) {
            $hasil = $nama;
            break;
        }
    }
}
?>

<h2>Pencarian Nama Mahasiswa</h2>

<form method="GET">
    <input type="text" name="nama"
        placeholder="Masukkan nama mahasiswa" required>
    <button type="submit">Cari</button>
</form>

<?php
if (isset($_GET["nama"])) {
    if ($hasil !== null) {
        echo "<p>Nama ditemukan: "
            . htmlspecialchars($hasil) . "</p>";
    } else {
        echo "<p>Nama mahasiswa tidak ditemukan.</p>";
    }
}
?>