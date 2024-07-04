<?php
include_once '../config/database.php';
include_once '../models/Event.php';

class EventController {
    private $db;
    private $event;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->event = new Event($this->db);
    }

    public function createEvent($data) {
        return $this->event->create($data);
    }

    public function getEvents($filters) {
        return $this->event->getAll($filters);
    }
}
?>
