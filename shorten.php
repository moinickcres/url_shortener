<?php
require 'db.php';

function generateShortCode($length = 6) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $originalUrl = filter_var($_POST['url'], FILTER_VALIDATE_URL);

    if ($originalUrl) {
        // Check if URL already exists in the database
        $stmt = $pdo->prepare("SELECT short_code FROM urls WHERE original_url = :url LIMIT 1");
        $stmt->execute([':url' => $originalUrl]);
        $existingShortCode = $stmt->fetchColumn();

        if ($existingShortCode) {
            // URL already exists, return the existing short code
            $shortUrl = "http://localhost/url_shortener/{$existingShortCode}";
        } else {
            // Generate a new short code and insert the URL into the database
            $shortCode = generateShortCode();
            $stmt = $pdo->prepare("INSERT INTO urls (original_url, short_code) VALUES (:url, :code)");
            $stmt->execute([':url' => $originalUrl, ':code' => $shortCode]);

            // Return the newly created short URL
            $shortUrl = "http://localhost/url_shortener/{$shortCode}";
        }
        echo json_encode(['short_url' => $shortUrl]);
    } else {
        echo json_encode(['error' => 'Invalid URL']);
    }
}
?>
