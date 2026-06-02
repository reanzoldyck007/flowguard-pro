<?php
/**
 * FlowGuard Pro – get-device-status.php
 * Returns live device_status row as JSON for the status page JS.
 */
include '../includes/db_connect.php';

$sql    = "SELECT * FROM device_status WHERE id = 1";
$result = $conn->query($sql);
$data   = $result->fetch_assoc();

// Enrich with human-readable signal strength label
$dbm = (int)($data['wifi_signal_dbm'] ?? 0);
if ($dbm >= -50)      $data['wifi_label'] = 'Excellent';
elseif ($dbm >= -60)  $data['wifi_label'] = 'Strong';
elseif ($dbm >= -70)  $data['wifi_label'] = 'Fair';
else                  $data['wifi_label'] = 'Weak';

$data['wifi_bars'] = ($dbm >= -50) ? 4 : (($dbm >= -60) ? 3 : (($dbm >= -70) ? 2 : 1));

header('Content-Type: application/json');
echo json_encode($data);
?>
