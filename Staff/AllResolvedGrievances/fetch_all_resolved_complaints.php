<?php
// fetch_complaints.php
session_start();

// Your database connection code goes here
$dbFile = '../../GRSystemDB';
$conn = new SQLite3($dbFile);


// Assuming you have a table named 'complaints'
$sql = "SELECT complaint_id, student_id, category, title, description, status, date_submitted FROM complaints WHERE status = 'Resolved'";
$stmt = $conn->prepare($sql);

$result = $stmt->execute();

$complaintsData = [];

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $complaintsData[] = $row;
}

// Close the database connection
$conn->close();

// Return the data as JSON
echo json_encode($complaintsData); //thsi object will return as response to the calling javascript code
?>

