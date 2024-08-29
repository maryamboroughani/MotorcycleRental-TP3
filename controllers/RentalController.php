<?php
namespace App\Controllers;

use App\Models\Rental;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

require_once 'upload.php';

class RentalController {

    public function index() {
        $rental = new Rental();
        $select = $rental->select(); // Retrieve all rentals
        View::render('rental/index', ['rentals' => $select]);
    }

    public function create() {
        Auth::session();
        View::render('rental/create');
    }

    public function show() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $rental = new Rental();
            $selectId = $rental->selectId($_GET['id']);

            if ($selectId) {
                return View::render('rental/show', ['rental' => $selectId]);
            } else {
                return View::render('error', ['msg' => 'Rental not found!']);
            }
        } else {
            return View::render('error', ['msg' => 'Invalid rental ID!']);
        }
    }

    public function edit() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $rental = new Rental();
            $selectId = $rental->selectId($_GET['id']);

            if ($selectId) {
                return View::render('rental/edit', ['rental' => $selectId]);
            } else {
                return View::render('error', ['msg' => 'Rental not found!']);
            }
        } else {
            return View::render('error', ['msg' => 'Invalid rental ID!']);
        }
    }

    public function store($data) {
        $validator = new Validator();
        $validator->field('motorcycle_id', $data['motorcycle_id'] ?? null)->required()->numeric();
        $validator->field('user_id', $data['user_id'] ?? null)->required()->numeric();
        $validator->field('start_date', $data['start_date'] ?? null)->required(); 
        $validator->field('end_date', $data['end_date'] ?? null)->required();

        if ($validator->isSuccess()) {
            $rental = new Rental();
            $photoResponse = handleFileUpload($_FILES['photo']); // Handle file upload

            if (isset($photoResponse['error'])) {
                return View::render('rental/create', ['errors' => [$photoResponse['error']], 'rental' => $data]);
            }

            $data['photo'] = $photoResponse['file']; // Include photo in data
            $insert = $rental->insert($data); 
            if ($insert) {
                return View::redirect('rental/show?id=' . $rental->id); // Redirect to the rental show page
            } else {
                return View::render('error', ['msg' => 'Failed to create rental.']);
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('rental/create', ['errors' => $errors, 'rental' => $data]);
        }
    }

    public function update($data, $get_data) {
        if (isset($get_data['id']) && !empty($get_data['id'])) {
            $id = $get_data['id'];

            $validator = new Validator();
            $validator->field('motorcycle_id', $data['motorcycle_id'] ?? null)->required()->numeric();
            $validator->field('user_id', $data['user_id'] ?? null)->required()->numeric();
            $validator->field('start_date', $data['start_date'] ?? null)->required(); 
            $validator->field('end_date', $data['end_date'] ?? null)->required(); 

            if ($validator->isSuccess()) {
                $rental = new Rental();
               
            }
        }
    }
}