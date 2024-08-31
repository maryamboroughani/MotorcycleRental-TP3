<?php
namespace App\Controllers;

use App\Models\Log; 

class LogController {
    public function index() {
        $log = new Log();
        $entries = $log->select(); // Retrieve all log entries
        View::render('admin/logs', ['logs' => $entries]);
    }
}
?>
