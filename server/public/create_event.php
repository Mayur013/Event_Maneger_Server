<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once 'config.php'; // Ensure this file contains your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = $_POST['event_name'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Handle image upload
    if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] === UPLOAD_ERR_OK) {
        $imgData = file_get_contents($_FILES['banner_image']['tmp_name']);
        $imgType = $_FILES['banner_image']['type'];

        $stmt = $conn->prepare("INSERT INTO events (event_name, start_time, end_time, location, description, category, banner_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssss', $event_name, $start_time, $end_time, $location, $description, $category, $imgData);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Event created successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to create event']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid image file']);
    }
}

$conn->close();
?>
