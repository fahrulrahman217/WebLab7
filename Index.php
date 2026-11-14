<?php
// DATA NILAI MAHASISWA
$nama = "Siti";
$tugas = 85;
$uts = 78;
$uas = 90;

// MENGHITUNG NILAI AKHIR
$nilaiAkhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);

// MENENTUKAN PREDIKAT
if ($nilaiAkhir >= 85) {
    $predikat = "A";
} elseif ($nilaiAkhir >= 75) {
    $predikat = "B";
} elseif ($nilaiAkhir >= 60) {
    $predikat = "C";
} else {
    $predikat = "D";
}

// ARRAY MAHASISWA
$mahasiswa = ["Alya", "Bima", "Citra", "Doni"];

// FUNCTION MENGHITUNG DISKON
function hitungDiskon($harga, $persen)
{
    $potongan = $harga * ($persen / 100);
    return $harga - $potongan;
}

$hargaAkhir = hitungDiskon(150000, 10);

// PROSES PENCARIAN GET
$kata = "";

if (isset($_GET["kata"])) {
    $kata = trim($_GET["kata"]);
}

// PROSES FORM POST MAHASISWA
$namaInput = "";
$prodiInput = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $namaInput = trim($_POST["nama"] ?? "");
    $prodiInput = trim($_POST["prodi"] ?? "");
}

// PROSES PERHITUNGAN BARANG
$error = "";
$barang = "";
$subtotal = null;

if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["hitung"])
) {

    $barang = trim($_POST["barang"] ?? "");
    $hargaInput = $_POST["harga"] ?? "";
    $jumlahInput = $_POST["jumlah"] ?? "";

    if (
        $barang === "" ||
        !is_numeric($hargaInput) ||
        !ctype_digit((string)$jumlahInput) ||
        (float)$hargaInput < 0 ||
        (int)$jumlahInput < 1
    ) {
        $error = "Periksa kembali nama barang, harga, dan jumlah.";
    } else {
        $harga = (float)$hargaInput;
        $jumlah = (int)$jumlahInput;
        $subtotal = $harga * $jumlah;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Praktikum PHP</title>
</head>

<body>

    <h1>Belajar PHP</h1>

    <?php
    echo "<p>PHP berhasil dijalankan.</p>";
    echo "<p>Waktu server: " . date("d-m-Y H:i:s") . "</p>";
    ?>

    <hr>

    <h2>Hasil Nilai Mahasiswa</h2>

    <?php
    echo "Nama: " . htmlspecialchars($nama) . "<br>";
    echo "Nilai akhir: " . number_format($nilaiAkhir, 2) . "<br>";
    echo "Predikat: " . $predikat;
    ?>

    <hr>

    <h2>Daftar Mahasiswa</h2>

    <ol>
        <?php
        foreach ($mahasiswa as $namaMahasiswa) {
            echo "<li>" . htmlspecialchars($namaMahasiswa) . "</li>";
        }
        ?>
    </ol>

    <hr>

    <h2>Perhitungan Diskon</h2>

    <?php
    echo "Harga awal: Rp150.000<br>";
    echo "Diskon: 10%<br>";
    echo "Harga setelah diskon: Rp" .
        number_format($hargaAkhir, 0, ",", ".");
    ?>

    <hr>

    <h2>Form Pencarian (GET)</h2>

    <form method="GET" action="">
        <label for="kata">Kata kunci:</label>
        <input
            id="kata"
            name="kata"
            type="text"
            value="<?php echo htmlspecialchars($kata, ENT_QUOTES, "UTF-8"); ?>">
        <button type="submit">Cari</button>
    </form>

    <?php
    if (isset($_GET["kata"])) {
        echo "<p>Kata kunci: " .
            htmlspecialchars($kata, ENT_QUOTES, "UTF-8") .
            "</p>";
    }
    ?>

    <hr>

    <h2>Form Data Mahasiswa (POST)</h2>

    <form method="POST" action="">
        <label for="nama">Nama:</label>
        <input
            id="nama"
            name="nama"
            type="text"
            required>

        <br><br>

        <label for="prodi">Program Studi:</label>
        <input
            id="prodi"
            name="prodi"
            type="text"
            required>

        <br><br>

        <button type="submit" name="kirim">Kirim Data</button>
    </form>

    <?php
    if (isset($_POST["kirim"])) {
        if ($namaInput === "" || $prodiInput === "") {
            echo "<p>Semua kolom wajib diisi.</p>";
        } else {
            echo "<h3>Data diterima</h3>";
            echo "Nama: " .
                htmlspecialchars($namaInput, ENT_QUOTES, "UTF-8") . "<br>";
            echo "Program Studi: " .
                htmlspecialchars($prodiInput, ENT_QUOTES, "UTF-8");
        }
    }
    ?>

    <hr>

    <h2>Form Perhitungan Subtotal Barang</h2>

    <form method="POST" action="">

        <label for="barang">Nama barang:</label>
        <input
            id="barang"
            name="barang"
            type="text"
            required>

        <br><br>

        <label for="harga">Harga:</label>
        <input
            id="harga"
            name="harga"
            type="number"
            min="0"
            step="0.01"
            required>

        <br><br>

        <label for="jumlah">Jumlah:</label>
        <input
            id="jumlah"
            name="jumlah"
            type="number"
            min="1"
            step="1"
            required>

        <br><br>

        <button type="submit" name="hitung">Hitung</button>

    </form>

    <?php
    if ($error !== "") {
        echo "<p>" . htmlspecialchars($error, ENT_QUOTES, "UTF-8") . "</p>";
    } elseif ($subtotal !== null) {
        echo "<h3>Hasil Perhitungan</h3>";
        echo "<p>Barang: " .
            htmlspecialchars($barang, ENT_QUOTES, "UTF-8") . "</p>";
        echo "<p>Subtotal: Rp" .
            number_format($subtotal, 0, ",", ".") . "</p>";
    }
    ?>

</body>

</html>