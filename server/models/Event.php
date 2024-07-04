<?php
class Event {
    private $conn;
    private $table_name = "events";

    public $id;
    public $user_id;
    public $name;
    public $start_time;
    public $end_time;
    public $location;
    public $description;
    public $category;
    public $banner_image;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " SET user_id=:user_id, name=:name, start_time=:start_time, end_time=:end_time, location=:location, description=:description, category=:category, banner_image=:banner_image";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $data['user_id']);
        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":start_time", $data['start_time']);
        $stmt->bindParam(":end_time", $data['end_time']);
        $stmt->bindParam(":location", $data['location']);
        $stmt->bindParam(":description", $data['description']);
        $stmt->bindParam(":category", $data['category']);
        $stmt->bindParam(":banner_image", $data['banner_image']);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll($filters) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE 1=1";
        if (!empty($filters['date'])) {
            $query .= " AND (DATE(start_time) <= :date AND DATE(end_time) >= :date)";
        }
        if (!empty($filters['city'])) {
            $query .= " AND location LIKE :city";
        }
        if (!empty($filters['category'])) {
            $query .= " AND category = :category";
        }
        $stmt = $this->conn->prepare($query);

        if (!empty($filters['date'])) {
            $stmt->bindParam(":date", $filters['date']);
        }
        if (!empty($filters['city'])) {
            $city = "%" . $filters['city'] . "%";
            $stmt->bindParam(":city", $city);
        }
        if (!empty($filters['category'])) {
            $stmt->bindParam(":category", $filters['category']);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
