<?php
// register.php
session_start(); //resumes exisiting session.
//id, username and password exists in session.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $id = $_SESSION['id'];

    $db = new SQLite3('../../GRSystemDB');
     // Assuming you have a user ID stored in the session
    // $query = "SELECT username, email FROM users WHERE username = :username";
    
    $stmt = $db->prepare('UPDATE users SET username = :username, email = :email, phone = :phone WHERE id = :id;');
    $stmt->bindValue(':id', $id, SQLITE3_TEXT);
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':phone', $phone, SQLITE3_TEXT);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Profile updated successfully"]);
    } else {
        echo json_encode(["message" => "Error updating profile"]);
    }

    $db->close();
}
?>