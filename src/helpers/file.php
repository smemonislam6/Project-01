<?php
// Function to read JSON data from a file
function read(string $file): array {
    if (file_exists($file)) {
        $data = file_get_contents($file);
        return json_decode($data, true);
    }
    return [];
}

function write(string $file, array $data) {
    
    $existingData = [];
    if (file_exists($file)) {
        $existingData = json_decode(file_get_contents($file), true);
    }

    $existingData[] = $data;

    $jsonData = json_encode($existingData, JSON_PRETTY_PRINT);
    file_put_contents($file, $jsonData . PHP_EOL, LOCK_EX);
}


function printA(array $arr) {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

function form_validation(string $data): string {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function form_empty($data): ?string {
    return empty($data) ? "Field cannot be empty." : null;
}

