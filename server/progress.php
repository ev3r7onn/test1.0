
<?php
ini_set('max_execution_time', 0);

$max = 10000000000;

function setProgress($progress) {
    $file = __DIR__ . '/p';
    if (!is_file($file))
        touch($file);
    file_put_contents($file, $progress);
}

for ($i = 0; $i < $max; $i++) {

    if ($i % 100000 === 0) {
        setProgress(($i * 100) / $max);
    }
}

echo true;
?>
