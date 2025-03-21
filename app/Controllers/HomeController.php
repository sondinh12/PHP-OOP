<?php
namespace App\Controllers;
use App\Common\Blade;

class HomeController {
    public function home(){
        Blade::render('home');
    }
}
?>