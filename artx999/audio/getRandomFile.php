<?php
$dir = $_GET["type"];
$files = glob($dir . '/*.*');
$file = array_rand($files);
$content = $files[$file];
$content = substr($content, strpos($content, "/") + 1);
header('Content-type: application/json');
print json_encode($content);