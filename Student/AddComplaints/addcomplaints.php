<?php
session_start(); // contains username and user of the current user.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $title = $_POST['title'];       // These are the variables received from post
    $description = $_POST['description'];

    $student_id = $_SESSION['id'];

    // Assuming you have a SQLite3 database file named "users.db" with a "users" table
    $db = new SQLite3('../../GRSystemDB'); //Do not put ".db"

    // Create the complaints table if it doesn't exist
    $db->exec('CREATE TABLE IF NOT EXISTS complaints (complaint_id INTEGER PRIMARY KEY AUTOINCREMENT, student_id INT, category VARCHAR(20),title VARCHAR(255), description varchar(1000), status VARCHAR(50),date_submitted DATETIME DEFAULT CURRENT_TIMESTAMP)');

    // Insert user data into the database
    $stmt = $db->prepare('INSERT INTO complaints (student_id,category,title,description,status) VALUES (:student_id,:category,:title, :description,"Not Viewed")');
    $stmt->bindValue(':student_id', $student_id, SQLITE3_TEXT);
    $stmt->bindValue(':category', $category, SQLITE3_TEXT);
    $stmt->bindValue(':title', $title, SQLITE3_TEXT);
    $stmt->bindValue(':description', $description, SQLITE3_TEXT);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Succesfully added complaint"]);
    } else {
        echo json_encode(["message" => "Error adding complaint"]);
    }

    $db->close();
}
?>