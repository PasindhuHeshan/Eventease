<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Database;

class EventController
{
    private $eventModel;

    public function __construct(Database $database)
    {
        $this->eventModel = new EventModel($database);
    }

    public function index()
    {
        $events = $this->eventModel->getAllEvents();
        $upevents = $this->eventModel->getAllupcomingEvents();
        include __DIR__ . '/../Views/events/index.php';
    }

    public function event(){
        $no = isset($_GET['no']) ? $_GET['no'] : null;
        if ($event = $this->eventModel->getEvent($no)) {
            include __DIR__ . '/../Views/events/event.php';
        } else {
            echo "Event not found.";
        }
    }
}
