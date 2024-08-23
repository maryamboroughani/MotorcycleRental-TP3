<?php
namespace App\Providers;

class Validator {
    protected $fields = [];
    protected $errors = [];

    // Define a field and its validation rules
    public function field($name, $value) {
        $this->fields[$name] = $value;
        return $this;
    }

    // Check if a field is required
    public function required() {
        $name = array_key_last($this->fields);
        if (empty($this->fields[$name])) {
            $this->errors[$name][] = "$name is required.";
        }
        return $this;
    }

    // Check if a field is numeric
    public function numeric() {
        $name = array_key_last($this->fields);
        if (!is_numeric($this->fields[$name])) {
            $this->errors[$name][] = "$name must be a number.";
        }
        return $this;
    }

    // Check if a field is a valid date
    public function date() {
        $name = array_key_last($this->fields);
        $date = $this->fields[$name];
        if (!DateTime::createFromFormat('Y-m-d', $date)) {
            $this->errors[$name][] = "$name must be a valid date (YYYY-MM-DD).";
        }
        return $this;
    }

    // Check if validation passed
    public function isSuccess() {
        return empty($this->errors);
    }

    // Get validation errors
    public function getErrors() {
        return $this->errors;
    }
}
?>
