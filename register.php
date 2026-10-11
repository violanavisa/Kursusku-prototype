<?php
require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';
?>
<!doctype html>
<html lang="id">
<head>
 <meta charset="utf-8">
 <title>Pendaftaran - KursusKu</title>
 <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
 <main class="container">
 <h1>Form Pendaftaran KursusKu</h1>
 
 <form method="POST" action="process.php">
 <label for="name">Nama lengkap</label>
 <input id="name" name="name" type="text" required>

 <label for="email">Email</label>
 <input id="email" name="email" type="email" required>

 <label for="course_code">Pilih kursus</label>
 <select id="course_code" name="course_code" required>
 <option value="">-- Pilih kursus --</option>
 <?php foreach ($courses as $course): ?>
 <option value="<?= e($course['code']) ?>">
 <?= e($course['name']) ?> - <?= formatRupiah($course['fee']) ?>
 </option>
 <?php endforeach; ?>
 </select>

 <fieldset>
 <legend>Tipe peserta</legend>
 <label><input type="radio" name="participant_type" value="mahasiswa" required> Mahasiswa</label>
 <label><input type="radio" name="participant_type" value="guru"> Guru</label>
 <label><input type="radio" name="participant_type" value="umum"> Umum</label>
 </fieldset>

 <fieldset>
 <legend>Minat belajar</legend>
 <?php foreach ($interestOptions as $value => $label): ?>
 <label>
 <input type="checkbox" name="interests[]" value="<?= e($value) ?>">
 <?= e($label) ?>
 </label>
 <?php endforeach; ?>
 </fieldset>

 <label for="learning_mode">Metode belajar</label>
 <select id="learning_mode" name="learning_mode" required>
 <option value="">-- Pilih metode --</option>
 <option value="offline">Tatap Muka</option>
 <option value="online">Online</option>
 <option value="hybrid">Hybrid</option>
 </select>

 <label for="package_count">Jumlah paket</label>
 <select id="package_count" name="package_count" required>
 <?php for ($i = 1; $i <= 3; $i++): ?>
 <option value="<?= $i ?>"><?= $i ?> paket</option>
 <?php endfor; ?>
 </select>

 <button type="submit">Proses Pendaftaran</button>
 </form>
 </main>
</body>
</html>