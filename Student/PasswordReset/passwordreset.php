<?php
session_start(); // contains username and user_id of the current user.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];       // These are the variables received from the post
    $password = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
    $id = $_SESSION['id'];

    $db = new SQLite3('../../GRSystemDB'); //Do not put ".db"

    $stmt = $db->prepare('SELECT password from users where id=:id');

    $stmt->bindValue(':id', $id, SQLITE3_TEXT);
    $result = $stmt->execute();
    $storedPassword = $result->fetchArray(SQLITE3_ASSOC)['password'];

    if ($result && password_verify($oldpassword, $storedPassword)) {
       
        $stmt1 = $db->prepare('UPDATE users SET password = :password WHERE id=:id');
        $stmt1->bindValue(':id', $id, SQLITE3_TEXT);
        $stmt1->bindValue(':password', $password, SQLITE3_TEXT);
        if ($stmt1->execute()) {
            echo json_encode(["message" => "Password was reset successfully!"]);
        } else {
            echo json_encode(["message" => "Error updating password in database"]);
        }
    } else{
        echo json_encode(["message" => "Incorrect Password"]);
    }

    $db->close();
}
?>