<?php
require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$courseCode = $_POST['course_code'] ?? '';
$participantType = $_POST['participant_type'] ?? '';
$learningMode = $_POST['learning_mode'] ?? '';
$packageCount = (int) ($_POST['package_count'] ?? 1);
$notes = trim($_POST['notes'] ?? '');
$interests = $_POST['interests'] ?? [];

if (!is_array($interests)) {
    $interests = [];
}

$allowedInterestKeys = array_keys($interestOptions);
$interests = array_values(array_intersect($interests, $allowedInterestKeys));

// Validasi dasar
$errors = [];
if ($name === '') {
    $errors[] = 'Nama wajib diisi.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}
$course = findCourse($courses, $courseCode);
if ($course === null) {
    $errors[] = 'Kursus tidak ditemukan.';
}
if (!in_array($participantType, ['mahasiswa', 'guru', 'umum'], true)) {
    $errors[] = 'Tipe peserta tidak valid.';
}
if (!in_array($learningMode, ['offline', 'online', 'hybrid'], true)) {
    $errors[] = 'Metode belajar tidak valid.';
}
if (!in_array($packageCount, [1, 2, 3], true)) {
    $errors[] = 'Jumlah paket tidak valid.';
}

if ($errors !== []) {
    ?>
    <!doctype html>
    <html lang="id">
    <head><meta charset="utf-8"><title>Data Belum Valid</title></head>
    <body>
    <main>
     <h1>Data belum dapat diproses</h1>
     <ul>
     <?php foreach ($errors as $error): ?>
     <li><?= e($error) ?></li>
     <?php endforeach; ?>
     </ul>
     <a href="register.php">Kembali ke form</a>
    </main>
    </body>
    </html>
    <?php
    exit;
}

$discountPercent = getDiscountPercent($participantType);
$grossTotal = $course['fee'] * $packageCount;
$discountAmount = intdiv($grossTotal * $discountPercent, 100);
$finalTotal = $grossTotal - $discountAmount;
$learningModeLabel = getLearningModeLabel($learningMode);
?>
<!doctype html>
<html lang="id">
<head>
 <meta charset="utf-8">
 <title>Ringkasan Pendaftaran - KursusKu</title>
 <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="container">
 <h1>Pendaftaran Berhasil Diproses</h1>
 <p><b>Nama:</b> <?= e($name) ?></p>
 <p><b>Email:</b> <?= e($email) ?></p>
 <p><b>Kursus:</b> <?= e($course['name']) ?></p>
 <p><b>Tipe peserta:</b> <?= e($participantType) ?></p>
 <p><b>Metode:</b> <?= e($learningModeLabel) ?></p>
 <p><b>Jumlah paket:</b> <?= $packageCount ?></p>
 <h2>Rincian Biaya</h2>
 <p>Subtotal: <?= formatRupiah($grossTotal) ?></p>
 <p>Diskon: <?= $discountPercent ?>% (-<?= formatRupiah($discountAmount) ?>)</p>
 <p><b>Total akhir: <?= formatRupiah($finalTotal) ?></b></p>
 <h2>Minat</h2>
 <ul>
 <?php if ($interests === []): ?>
 <li>Belum memilih minat.</li>
 <?php else: ?>
 <?php foreach ($interests as $interest): ?>
 <?php $label = $interestOptions[$interest] ?? $interest; ?>
 <li><?= e($label) ?></li>
 <?php endforeach; ?>
 <?php endif; ?>
 </ul>
 <br>
 <a href="register.php">Kembali ke Pendaftaran</a>
</main>
</body>
</html>