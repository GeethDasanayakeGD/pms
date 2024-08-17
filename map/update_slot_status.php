<?php
include '../db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a 'slots' table with 'slotId' and 'status' columns
    $slotId = $_POST['slotId'];

    // Update slot status to 0 (or any other desired value) in the database
    $sql = "UPDATE slots SET status = 0 WHERE slotId = $slotId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    // Close the database connection
    $conn->close();
} else {
    echo json_encode(['success' => false]);
}
?>
