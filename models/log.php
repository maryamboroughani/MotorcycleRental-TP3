<?php
namespace App\Models;

use App\Models\CRUD;

class Log extends CRUD {
    protected $table = 'log'; // Table name
    protected $primaryKey = 'id'; // Primary key field

    /**
     * Fetch all logs from the database.
     */
    public function selectAll() {
        $sql = "SELECT * FROM $this->table ORDER BY log_date DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
?>
