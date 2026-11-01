<?php
$matkul = [
    ["nama" => "Pemrograman Web", "sks" => 3, "nilai" => 85],
    ["nama" => "Sistem Basis Data", "sks" => 3, "nilai" => 78],
    ["nama" => "Jaringan Komputer", "sks" => 3, "nilai" => 65],
    ["nama" => "Sistem Operasi", "sks" => 3, "nilai" => 55],
    ["nama" => "Desain dan Analisis Algoritma", "sks" => 3, "nilai" => 90]
];

function hitungBobot($nilai) {
    if ($nilai >= 80) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 60) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

$totalSks = 0;
$totalBobotSks = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Nilai Mata Kuliah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 30px;
            color: #252525;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }
        h1, h2 { text-align: center; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 22px;
        }
        th, td {
            border: 1px solid #d8d8d8;
            padding: 11px;
            text-align: center;
        }
        th { background: #e8eaf6; }
        td:first-child { text-align: left; }
        .mengulang { background: #ffcaca; color: #9b111e; }
        .ringkasan {
            margin-top: 25px;
            padding: 18px;
            background: #f0f3ff;
            border-radius: 8px;
        }
        .ringkasan p { margin: 8px 0; }
    </style>
</head>
<body>
<div class="container">
    <h1>Rekap Nilai Mata Kuliah</h1>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Nilai Angka</th>
                <th>Nilai Huruf</th>
                <th>Bobot</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($matkul as $index => $mk): ?>
                <?php
                    $hasil = hitungBobot($mk["nilai"]);
                    $status = ($hasil["bobot"] >= 2.0) ? "LULUS" : "MENGULANG";

                    $totalSks += $mk["sks"];
                    $totalBobotSks += $hasil["bobot"] * $mk["sks"];
                ?>
                <tr class="<?= ($status == "MENGULANG") ? "mengulang" : "" ?>">
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($mk["nama"]) ?></td>
                    <td><?= $mk["sks"] ?></td>
                    <td><?= $mk["nilai"] ?></td>
                    <td><?= $hasil["huruf"] ?></td>
                    <td><?= number_format($hasil["bobot"], 1) ?></td>
                    <td><?= $status ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
        $ips = ($totalSks > 0) ? $totalBobotSks / $totalSks : 0;
        $maksSks = ($ips >= 3.00) ? 24 : 20;
    ?>

    <div class="ringkasan">
        <h2>Ringkasan IPS</h2>
        <p>Total SKS: <strong><?= $totalSks ?> SKS</strong></p>
        <p>Total Bobot x SKS: <strong><?= number_format($totalBobotSks, 2) ?></strong></p>
        <p>IPS: <strong><?= number_format($ips, 2) ?></strong></p>
        <p>Batas maksimal SKS semester depan:
            <strong><?= $maksSks ?> SKS</strong>
        </p>
    </div>
</div>
</body>
</html>
