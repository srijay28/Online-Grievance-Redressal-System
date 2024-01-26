<?php
// update_status.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the AJAX request
    $data = json_decode(file_get_contents('php://input'), true); 
    $complaintId = $data['complaintId'];
    $newStatus = $data['newStatus'];

    $db = new SQLite3('../../GRSystemDB');
    
    $stmt = $db->prepare('UPDATE complaints SET status = :newStatus WHERE complaint_id = :complaintId');
    $stmt->bindValue(':newStatus', $newStatus, SQLITE3_TEXT);
    $stmt->bindValue(':complaintId', $complaintId, SQLITE3_INTEGER);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Status updated successfully"]);
    } else {
        echo json_encode(["message" => "Error updating status"]);
    }

    $db->close();
}
?>
