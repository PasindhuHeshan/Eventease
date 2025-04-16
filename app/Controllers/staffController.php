<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Database;

class staffController
{
    public function index() {
        require __DIR__ . '/../views/events/staff.php';
    }
}