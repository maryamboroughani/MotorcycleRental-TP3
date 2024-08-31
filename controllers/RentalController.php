<?php
namespace App\Controllers;

use App\Models\Rental;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

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

    public function show($data = []) {
        // Check if 'id' is provided and valid
        if (isset($_GET['id']) && $data['id'] != null) {
            $rental = new Rental(); // Use the Rental model
            $selectId = $rental->selectId($data['id']);
            if ($selectId) {
                return View::render('rental/show', ['rental' => $selectId]);
            } else {
                return View::render('error', ['msg' => 'Rental not found!']);
            }
        } else {
            return View::render('error', ['msg' => 'Rental ID not provided or invalid.']);
        }    
    }

    public function edit($data = []) {
        if (isset($_GET['id']) && $data['id'] != null) {
            $rental = new Rental();
            $selectId = $rental->selectId($data['id']);
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
        $validator->field('motorcycle_id', $data['motorcycle_id'])->required()->numeric();
        $validator->field('user_id', $data['user_id'])->required()->numeric();
        $validator->field('start_date', $data['start_date'])->required(); 
        $validator->field('end_date', $data['end_date'])->required();

        if ($validator->isSuccess()) {
            $rental = new Rental();
            $insert = $rental->insert($data); // Ensure the insert method is defined in your Rental model
            if ($insert) {
                return View::redirect('rental/show?id=' . $rental->id); // Adjust this to use the correct id retrieval
            } else {
                return View::render('error', ['msg' => 'Failed to create rental.']);
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('rental/create', ['errors' => $errors, 'rental' => $data]);
        }
    }

    public function update($data, $get_data) {
        // Ensure 'id' is present in GET data
        if (isset($get_data['id']) && $get_data['id'] != null) {
            $id = $get_data['id'];
            
            // Initialize validator
            $validator = new Validator();
            
            // Validate fields
            $validator->field('motorcycle_id', $data['motorcycle_id'])->required()->numeric();
            $validator->field('user_id', $data['user_id'])->required()->numeric();
            $validator->field('start_date', $data['start_date'])->required(); 
            $validator->field('end_date', $data['end_date'])->required(); 
    
            // Check if validation passed
            if ($validator->isSuccess()) {
                // Initialize Rental model
                $rental = new Rental();
                
                // Attempt to update rental record
                $update = $rental->update($data, $id);
                
                // Check if update was successful
                if ($update) {
                    // Redirect to rental show page
                    return View::redirect('rental/show?id=' . $id);
                } else {
                    // Render error view if update failed
                    return View::render('error', ['msg' => 'Failed to update rental.']);
                }
            } else {
                // Get validation errors and render edit view with errors
                $errors = $validator->getErrors();
                return View::render('rental/edit', ['errors' => $errors, 'rental' => $data]);
            }
        } else {
            // Render error view if 'id' is missing
            return View::render('error', ['msg' => 'Invalid rental ID!']);
        }
    }

    public function delete($data) {
        $rental = new Rental();
        $delete = $rental->delete($data['id']);
        if ($delete) {
            return View::redirect('rental');
        } else {
            return View::render('error', ['msg' => 'Failed to delete rental.']);
        }
    }
}
