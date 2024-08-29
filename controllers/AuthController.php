<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;

class AuthController {
    public function index() {
        View::render('auth/index');
    }

    public function store($data) {
        //  var_dump($data);
        //  exit;
    
        // Check if 'email' and 'password' keys are set
        $email = isset($data['email']) ? $data['email'] : '';
        $password = isset($data['password']) ? $data['password'] : '';
    
        $validator = new Validator;
        $validator->field('email', $email)->email()->required()->max(50)->isExist('User', 'email');
        $validator->field('password', $password)->min(5)->max(20);
    
        if ($validator->isSuccess()) {
            $user = new User;
            $checkUser = $user->checkUser($email, $password); 
    
            if ($checkUser) {
                return View::redirect('rental');
            } else {
                $errors['message'] = "Please check your credentials";
                return View::render('auth/index', ['errors' => $errors, 'user' => $data]);
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('auth/index', ['errors' => $errors, 'user' => $data]);
        }
    }
    

    public function delete() {
        session_destroy();
        return View::redirect('login');
    }
}
?>
