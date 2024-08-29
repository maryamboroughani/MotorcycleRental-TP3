<?php
// try {
//     $pdo = new \PDO('mysql:host=localhost;dbname=motorcycle_shop;port=8889;charset=utf8', 'root', 'root');
//     echo "Connection successful!";
// } catch (\PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }

// Route::get('/test', function() {
//     echo 'Route is working!';
// });

// Manual test script
$password = 'your_password_here'; // Replace with a test password
$hashedPassword = password_hash($password . 'H4@1&', PASSWORD_BCRYPT); // Replace 'H4@1&' with the actual salt used
echo "Hashed password: " . $hashedPassword . PHP_EOL;

if (password_verify($password . 'H4@1&', $hashedPassword)) {
    echo "Password matches!" . PHP_EOL;
} else {
    echo "Password does not match." . PHP_EOL;
}


?>
