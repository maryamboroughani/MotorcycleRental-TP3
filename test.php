<?php
try {
    $pdo = new \PDO('mysql:host=localhost;dbname=motorcycle_shop;port=8889;charset=utf8', 'root', 'root');
    echo "Connection successful!";
} catch (\PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
