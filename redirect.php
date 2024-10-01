<?php
require 'db.php';

// Get the short code from the URL
$shortCode = $_GET['code'] ?? '';

if ($shortCode) {
    // Find the original URL in the database
    $stmt = $pdo->prepare("SELECT original_url FROM urls WHERE short_code = :code LIMIT 1");
    $stmt->execute([':code' => $shortCode]);
    $originalUrl = $stmt->fetchColumn();

    if ($originalUrl) {
        // Redirect to the original URL
        
        header("Location: $originalUrl");
        exit;
    } else {
        // If the short code is not found, return a 404 error
        http_response_code(404);
        echo 'URL not found';
    }
} else {
    echo 'Invalid short URL';
}
?>
