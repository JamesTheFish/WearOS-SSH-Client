<?php
$filepath = __DIR__ . "/Befehle.txt";

if (!file_exists($filepath)) {
    http_response_code(404);
    echo json_encode(["error" => "Befehle.txt not found"]);
    exit;
}

$lines = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
header("Content-Type: application/json");
echo json_encode($lines);
