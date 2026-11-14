<?php
$hasil = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $nim = trim($_POST["nim"] ?? "");

    if ($nama == "" || $nim == "") {
        $hasil = "Semua data wajib diisi.";
    } else {
        $hasil = "Data berhasil dikirim.";
    }
}
?>

<h2>Form Data Mahasiswa</h2>

<form method="POST">

    <label>Nama Mahasiswa:</label><br>
    <input type="text" name="nama" required>
    <br><br>

    <label>NIM:</label><br>
    <input type="text" name="nim" required>
    <br><br>

    <button type="submit">Kirim Data</button>

    <button type="reset">Reset</button>

</form>

<?php
if ($hasil != "") {
    echo "<p>" . htmlspecialchars($hasil) . "</p>";
}
?>