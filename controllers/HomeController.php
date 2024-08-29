<?php
namespace App\Controllers;

use App\Models\ExampleModel;
use App\Providers\View;

class HomeController{
    public function index(){
        //echo 'Home Controller';
        $model = new ExampleModel;
        $data = $model->getData();
        View::render("home", ["data"=>$data]);
       // include('views/home.php');
    }

    public function test(){
        echo 'test';
    }
}

?>