<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}
// Database connection
require_once 'config.php';


// Fetch all event data including banner image
$sql = "SELECT id, event_name, start_time, end_time, location, description, category, banner_image FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $events = [];
    while($row = $result->fetch_assoc()) {
        // Encode the banner image data to base64
        $row['banner_image'] = base64_encode($row['banner_image']);
        $events[] = $row;
    }

    // Output JSON response
    header('Content-Type: application/json');
    echo json_encode($events);
} else {
    // Output JSON error response
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No events found']);
}

$conn->close();
?>

