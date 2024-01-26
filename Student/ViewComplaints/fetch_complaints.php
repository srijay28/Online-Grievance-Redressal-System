<?php
// fetch_complaints.php
session_start();

// Your database connection code goes here
$dbFile = '../../GRSystemDB';
$conn = new SQLite3($dbFile);

$student_id = $_SESSION['id'];

// Assuming you have a table named 'complaints'
$sql = "SELECT complaint_id, category, title, description, status, date_submitted FROM complaints WHERE student_id = :student_id AND status <> 'Resolved'";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':student_id', $student_id, SQLITE3_INTEGER);
$result = $stmt->execute();

$complaintsData = [];

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $complaintsData[] = $row;
}

// Close the database connection
$conn->close();

// Return the data as JSON
echo json_encode($complaintsData);
?>

