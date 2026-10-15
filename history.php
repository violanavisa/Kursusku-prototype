<?php
require __DIR__ . '/helpers.php';

// Data dummy/tiruan
$history = [
    ['name' => 'Alya', 'course' => 'Web Dasar', 'total' => 240000],
    ['name' => 'Bima', 'course' => 'PHP Dasar', 'total' => 340000],
    ['name' => 'Citra', 'course' => 'Laravel Dasar', 'total' => 500000],
];
?>

<table>
<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>Kursus</th>
<th>Total</th>
</tr>
</thead>
<tbody>
<?php foreach ($history as $index => $item): ?>
<tr>
<td><?= $index + 1 ?></td>
<td><?= e($item['name']) ?></td>
<td><?= e($item['course']) ?></td>
<td><?= formatRupiah($item['total']) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<nav>
<a href="index.php">Beranda</a>
<a href="register.php">Daftar Kursus</a>
<a href="history.php">History Dummy</a>
</nav>