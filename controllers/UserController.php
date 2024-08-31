<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UserController {

    public function __construct() {
     //   Auth::session();
    }

    public function create() {

        $privilege = new Privilege;
            $privileges = $privilege->select('privilege_name');
            return View::render('user/create', ['privileges' => $privileges]);


        if ($_SESSION['privilege_id'] == 1) {
            
        } else {
            return View::redirect('login');
        }
    }

    public function store($data) {
      //  Auth::session();
        $validator = new Validator;

        // Validate data
        $validator->field('first_name', $data['first_name'])->min(2)->max(50);
        $validator->field('last_name', $data['last_name'])->min(2)->max(50);
        $validator->field('email', $data['email'])->email()->required()->max(50)->isUnique('User', 'email');
        $validator->field('password', $data['password'])->min(5)->max(20);
        $validator->field('privilege_id', $data['privilege_id'], 'privilege')->required()->isExist('Privilege');

        if ($validator->isSuccess()) {
            $user = new User;

            // Hash the password before insertion
            $data['password'] = $user->hashPassword($data['password']);

            // Insert user data
            $insert = $user->insert($data);
            if ($insert) {
                return View::redirect('login');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            // Prepare privileges data for re-render
            $privilege = new Privilege;
            $privileges = $privilege->select('privilege_name');

            return View::render('user/create', ['errors' => $errors, 'user' => $data, 'privileges' => $privileges]);
        }
    }
}
?>