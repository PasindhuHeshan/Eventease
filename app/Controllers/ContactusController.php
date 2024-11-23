<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Database;

class ContactusController{
    public function index() {
        require __DIR__ . '/../Views/events/contactus.php';
    }
}