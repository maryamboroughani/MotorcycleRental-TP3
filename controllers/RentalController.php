<?php
namespace App\Controllers;

use App\Models\Rental;
use App\Providers\View;
use App\Providers\Validator;

class RentalController {
    public function index() {
        $rental = new Rental();
        $rentals = $rental->select(); // Retrieve all rentals
        View::render('rental/index', ['rentals' => $rentals]);
    }

    public function create() {
        View::render('rental/create', ['base' => BASE]);
    }

    public function show($data = []) {
        if (!empty($data['id'])) {
            $rental = new Rental();
            $rentalDetails = $rental->selectId($data['id']);
            if ($rentalDetails) {
                View::render('rental/show', ['rental' => $rentalDetails]);
            } else {
                View::render('error', ['msg' => 'Rental not found!']);
            }
        } else {
            View::render('error', ['msg' => 'Invalid rental ID!']);
        }
    }

    public function edit($data = []) {
        if (!empty($data['id'])) {
            $rental = new Rental();
            $rentalDetails = $rental->selectId($data['id']);
            if ($rentalDetails) {
                View::render('rental/edit', ['rental' => $rentalDetails]);
            } else {
                View::render('error', ['msg' => 'Rental not found!']);
            }
        } else {
            View::render('error', ['msg' => 'Invalid rental ID!']);
        }
    }
// controllers/RentalController.php
public function store($data) {
    $validator = new Validator();
    $validator->field('motorcycle_id', $data['motorcycle_id'])->required()->numeric();
    $validator->field('user_id', $data['user_id'])->required()->numeric();
    $validator->field('start_date', $data['start_date'])->required(); // Add date validation if needed
    $validator->field('end_date', $data['end_date'])->required(); // Add date validation if needed

    if ($validator->isSuccess()) {
        $rental = new Rental();
        $create = $rental->create($data); // Ensure the create method is defined in your Rental model
        if ($create) {
            View::redirect('rental/show?id=' . $rental->id); // Adjust based on your logic
        } else {
            View::render('error', ['msg' => 'Failed to create rental.']);
        }
    } else {
        $errors = $validator->getErrors();
        View::render('rental/create', ['errors' => $errors, 'rental' => $data]);
    }
}

    public function update($data, $get_data) {
        // Ensure 'id' is present in GET data
        if (!empty($get_data['id'])) {
            $id = $get_data['id'];
            
            // Initialize validator
            $validator = new Validator();
            
            // Validate fields
            $validator->field('motorcycle_id', $data['motorcycle_id'])->required()->numeric();
            $validator->field('user_id', $data['user_id'])->required()->numeric();
            $validator->field('start_date', $data['start_date'])->required(); // Add date validation if needed
            $validator->field('end_date', $data['end_date'])->required(); // Add date validation if needed
    
            // Check if validation passed
            if ($validator->isSuccess()) {
                // Initialize Rental model
                $rental = new Rental();
                
                // Attempt to update rental record
                $update = $rental->update($data, $id);
                
                // Check if update was successful
                if ($update) {
                    // Redirect to rental show page
                    View::redirect('rental/show?id=' . $id);
                } else {
                    // Render error view if update failed
                    View::render('error', ['msg' => 'Failed to update rental.']);
                }
            } else {
                // Get validation errors and render edit view with errors
                $errors = $validator->getErrors();
                View::render('rental/edit', ['errors' => $errors, 'rental' => $data]);
            }
        } else {
            // Render error view if 'id' is missing
            View::render('error', ['msg' => 'Invalid rental ID!']);
        }
    }
    

    public function delete($data) {
        if (!empty($data['id'])) {
            $rental = new Rental();
            $delete = $rental->delete($data['id']);
            if ($delete) {
                View::redirect('rental');
            } else {
                View::render('error', ['msg' => 'Failed to delete rental.']);
            }
        } else {
            View::render('error', ['msg' => 'Invalid rental ID!']);
        }
    }
}
?>
