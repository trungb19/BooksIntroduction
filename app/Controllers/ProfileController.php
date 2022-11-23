<?php

namespace App\Controllers;

Class ProfileController extends Controller {
    // Hiển thị profile người dùng;
    public function showProfile(){
        if (isset($_SESSION['user'])){
            $this->sendPage('layouts/profile');
        }else {
            redirect('/');
        }
    }
}