<?php
// Uji coba bitwise permission 
$siteName = 'KursusKu';

// Definisi flag permission
$READ   = 1; // 001
$WRITE  = 2; // 010
$DELETE = 4; // 100

// Penggabungan izin dengan operator OR
$permission = $READ | $WRITE;

// Pengecekan izin delete dengan operator AND
$canDelete = ($permission & $DELETE) === $DELETE;

// Helper kecil: angka -> biner 3 digit
function bin3(int $n): string
{
    return str_pad(decbin($n), 3, '0', STR_PAD_LEFT);
}

// Tangkap output var_dump supaya bisa ditampilkan di dalam kotak
ob_start();
var_dump($canDelete);
$dumpOutput = trim(ob_get_clean());

$flags = [
    'READ'   => $READ,
    'WRITE'  => $WRITE,
    'DELETE' => $DELETE,
];
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bitwise Test - <?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?></title>

    }

<main class="panel">
    <h1>
        <span class="brand"><?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?></span>
        Uji Coba Bitwise Permission (bitwise-test.php)
    </h1>

    <section>
        <h2>Definisi Nilai Flag:</h2>
        <ul class="flags">
            <?php foreach ($flags as $label => $value): ?>
                <li>
                    <span class="chip">$<?= $label ?></span>
                    = <?= $value ?> (biner: <?= bin3($value) ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section>
        <h2>Penggabungan Izin: <code>$permission = $READ | $WRITE;</code></h2>
        <p>
            Nilai $permission: <strong><?= $permission ?></strong>
            (biner: <?= bin3($permission) ?>)
        </p>
        <p>
            <span class="bits" aria-label="Bit izin aktif">
                <?php foreach (array_reverse($flags, true) as $label => $value): ?>
                    <span class="bit <?= ($permission & $value) === $value ? 'on' : '' ?>">
                        <?= ($permission & $value) === $value ? '1' : '0' ?>
                    </span>
                <?php endforeach; ?>
            </span>
            <span class="bit-labels">
                <?php foreach (array_reverse($flags, true) as $label => $value): ?>
                    <span><?= substr($label, 0, 1) ?></span>
                <?php endforeach; ?>
            </span>
        </p>
    </section>

    <section>
        <h2>Pengecekan Izin Delete: <code>$canDelete = ($permission &amp; $DELETE) === $DELETE;</code></h2>
        <p>
            Nilai $canDelete:
            <span class="<?= $canDelete ? 'value-true' : 'value-false' ?>">
                <?= $canDelete ? 'true' : 'false' ?>
            </span>
        </p>
        <p class="note">
            <?php if ($canDelete): ?>
                (Alasan: true karena flag DELETE bernilai <?= $DELETE ?> ikut tergabung di dalam $permission)
            <?php else: ?>
                (Alasan: false karena flag DELETE bernilai <?= $DELETE ?> tidak digabungkan ke dalam $permission)
            <?php endif; ?>
        </p>
    </section>

    <section>
        <h2>Output var_dump($canDelete):</h2>
        <pre class="dump"><?= htmlspecialchars($dumpOutput, ENT_QUOTES, 'UTF-8') ?></pre>
    </section>
</main>

<footer>&copy; <?= date('Y') ?> <?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?></footer>

</body>
</html>