<?php
// login.php

// In this, the "action" attribute in the form sends the post containing the data
// whereas in Registration.html, an eventListener is added to the "Register" button and then the data is manually encapsulated into an object in Javascript and then an XMLHttpRequest object is created which is used to send post to the php file.

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Assuming you have a SQLite3 database file named "users.db" with a "users" table
    $db = new SQLite3('../../GRSystemDB'); // do not put ".db" in the name
    
    // Retrieve user data from the database
    $stmt = $db->prepare('SELECT id, username, password FROM staff WHERE username = :username');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Login successful
        $_SESSION['username'] = $user['username'];
        $_SESSION['id'] = $user['id']; //so that id can be passed across session
        // header('Location: ../Profile/Profile.php');
        echo json_encode(["message" => "Succesfully logged in!"]);
        // exit();
    } else {
        // Login failed
         echo json_encode(["message" => "Invalid Credentials!"]);
        // echo 'Invalid credentials. <a href="StudentLogin.html">Try again</a>.';
    }

    $db->close();
}
?>
