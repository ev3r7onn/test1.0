<?php

// Make a request to another domain so browser doesn't block you
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

if (is_file(__DIR__ . '/p')) {
    echo file_get_contents(__DIR__ . '/p'); // Note: if the file is busy (being rewritten, this will result in nothing.
} else {
    echo 0;
}

?>