<?php
require_once(__DIR__ . '/../includes/db.php');

$type = $_GET['type'] ?? '';

if ($type === 'hotel') {
    $stmt = $conn->prepare("SELECT id, name FROM hotels");
} elseif ($type === 'activity') {
    $stmt = $conn->prepare("SELECT id, name FROM activities");
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid type']);
    exit;
}

$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

header('Content-Type: application/json');
echo json_encode($items);
?>
