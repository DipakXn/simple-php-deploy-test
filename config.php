<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'ledgergenie_user'); // Replace with your full DB user
define('DB_PASS', ')dH_nqu-LUzGy]K2');  // Replace with your DB password
define('DB_NAME', 'ledgergenie_test_db');    // Replace with your full DB name

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Connection failed: " . $e->getMessage());
}
?>