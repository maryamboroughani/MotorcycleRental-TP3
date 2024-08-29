<?php
namespace App\Models;

use App\Models\CRUD;

class User extends CRUD {
    protected $table = 'users'; // Adjusted table name
    protected $primaryKey = 'id'; // Primary key field
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'privilege_id']; // Fillable fields
    private $salt = "H4@1&"; // Salt for password hashing

    /**
     * Hash the password using bcrypt with a salt.
     */
    public function hashPassword($password, $cost = 10) {
        $options = [
            'cost' => $cost
        ];
        return password_hash($password . $this->salt, PASSWORD_BCRYPT, $options);
    }

    /**
     * Check user credentials.
     */
    public function checkUser($email, $password) {
        $user = $this->unique('email', $email); // Fetch user by email
    
        if ($user) {
            error_log('User data fetched: ' . json_encode($user)); // Debugging: Log user data fetched from the database
    
            if (password_verify($password . $this->salt, $user['password'])) {
                // Password verification successful
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['privilege_id'] = $user['privilege_id'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                return true;
            } else {
                error_log('Password verification failed for user with email: ' . $email);
                return false; // Password is incorrect
            }
        } else {
            error_log('User not found with email: ' . $email);
            return false; // Email does not exist
        }
    }
    
}
?>
