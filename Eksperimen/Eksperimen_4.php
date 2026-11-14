<?php
$error = "";
$nim = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nim = trim($_POST["nim"] ?? "");

    if (!ctype_digit($nim)) {
        $error = "NIM hanya boleh berisi angka.";
    } elseif (strlen($nim) != 9) {
        $error = "NIM harus terdiri dari 9 digit.";
    } else {
        $error = "NIM berhasil divalidasi.";
    }
}
?>

<h2>Validasi NIM Mahasiswa</h2>

<form method="POST">
    <label>Masukkan NIM:</label><br>

    <input type="text" name="nim"
        maxlength="9" placeholder="Masukkan 9 digit NIM"
        required>

    <button type="submit">Validasi</button>
</form>

<?php
if ($error != "") {
    echo "<p>" . htmlspecialchars($error) . "</p>";
}
?>