<?php
namespace App\Models;

class Rental extends CRUD {
    protected $table = 'rentals'; // Table name
    protected $primaryKey = 'id'; // Primary key column name
    protected $fillable = ['motorcycle_id', 'user_id', 'start_date', 'end_date'];
}
?>
