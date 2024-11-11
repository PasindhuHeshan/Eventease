<?php
namespace App\Controllers;

class HeaderController {
    public function render() {
        require __DIR__ . '/../Views/events/header.php';
    }
}
?>