<?php

require __DIR__ . '/../vendor/autoload.php';

foreach (['public/certificates/cert-schneider.png', 'public/certificates/cert-legrand.jpg', 'public/certificates/cert-gae.png'] as $f) {
    if (file_exists($f)) {
        $size = getimagesize($f);
        echo "$f: {$size[0]} x {$size[1]} (ratio: " . round($size[0] / $size[1], 3) . ")\n";
    } else {
        echo "$f: NOT FOUND\n";
    }
}
