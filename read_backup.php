<?php
$file = 'backup.sql';
if (file_exists($file)) {
    // Read UTF-16LE file
    $content = file_get_contents($file);
    // Convert to UTF-8
    $content_utf8 = mb_convert_encoding($content, 'UTF-8', 'UTF-16LE');
    $lines = explode("\n", $content_utf8);
    for ($i = 95; $i <= 125; $i++) {
        if (isset($lines[$i])) {
            echo ($i + 1) . ": " . $lines[$i] . "\n";
        }
    }
} else {
    echo "File not found.";
}
?>
