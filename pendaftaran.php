<?php
$data = null;
$error = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $nim = trim($_POST["nim"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");
    $semesterInput = $_POST["semester"] ?? "";
    $email = trim($_POST["email"] ?? "");

    if ($nama === "") {
        $error[] = "Nama wajib diisi.";
    }

    if ($nim === "") {
        $error[] = "NIM wajib diisi.";
    }

    if ($prodi === "") {
        $error[] = "Program studi wajib diisi.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Format email tidak valid.";
    }

    if (
        !ctype_digit((string)$semesterInput) ||
        (int)$semesterInput < 1 ||
        (int)$semesterInput > 14
    ) {
        $error[] = "Semester harus berupa angka 1–14.";
    }

    if (!$error) {
        $data = compact("nama", "nim", "prodi", "email");
        $data["semester"] = (int)$semesterInput;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f7;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2563eb;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 11px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #1d4ed8;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 15px;
            border-radius: 6px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Form Pendaftaran Mahasiswa</h2>

        <?php if ($error): ?>
            <div class="error">
                <strong>Terjadi Kesalahan:</strong>
                <ul>
                    <?php foreach ($error as $pesan): ?>
                        <li><?= htmlspecialchars($pesan) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST">

            <label>Nama Lengkap</label>
            <input type="text" name="nama"
                value="<?= htmlspecialchars($_POST["nama"] ?? "") ?>">

            <label>NIM</label>
            <input type="text" name="nim"
                value="<?= htmlspecialchars($_POST["nim"] ?? "") ?>">

            <label>Program Studi</label>
            <select name="prodi">
                <option value="">-- Pilih Program Studi --</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Teknik Industri">Teknik Industri</option>
                <option value="Hukum">Hukum</option>
            </select>

            <label>Semester</label>
            <input type="number" name="semester" min="1" max="14"
                value="<?= htmlspecialchars($_POST["semester"] ?? "") ?>">

            <label>Email</label>
            <input type="email" name="email"
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

            <button type="submit">Daftar Sekarang</button>

        </form>

        <?php if ($data): ?>
            <div class="success">
                <h3>Pendaftaran Berhasil!</h3>

                <p>Nama: <?= htmlspecialchars($data["nama"]) ?></p>
                <p>NIM: <?= htmlspecialchars($data["nim"]) ?></p>
                <p>Program Studi: <?= htmlspecialchars($data["prodi"]) ?></p>
                <p>Semester: <?= $data["semester"] ?></p>
                <p>Email: <?= htmlspecialchars($data["email"]) ?></p>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>