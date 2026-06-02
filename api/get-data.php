<?php
include '../includes/db_connect.php';

$sql = "SELECT * FROM tank_telemetry WHERE id = 1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

header('Content-Type: application/json');
echo json_encode($data);
?>