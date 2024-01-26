<?php
// register.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registrationType = $_POST['registrationType'];
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Assuming you have a SQLite3 database file named "users.db" with a "users" table
    $db = new SQLite3('../GRSystemDB'); //Do not put ".db"
    
    if ($registrationType === "Staff Registration") {
        // Code for Staff Registration
        $db->exec('CREATE TABLE IF NOT EXISTS staff (id INTEGER PRIMARY KEY, username TEXT, email TEXT, password TEXT, phone NUMBER)');

        // Insert user data into the database
        $stmt = $db->prepare('INSERT INTO staff (id,username,email,password) VALUES (:id,:username,:email, :password)');
        $stmt->bindValue(':id', $id, SQLITE3_TEXT);
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        
        if ($stmt->execute()) {
            echo 'Registration successful. <a href="login.html">Login here</a>.';
        } else {
            echo 'Registration failed.';
        }
    } elseif ($registrationType === "Student Registration") {
        // Code for Student Registration
        $db->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, username TEXT, email TEXT, password TEXT, phone NUMBER)');

    // Insert user data into the database
        $stmt = $db->prepare('INSERT INTO users (id,username,email,password) VALUES (:id,:username,:email, :password)');
        $stmt->bindValue(':id', $id, SQLITE3_TEXT);
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        
        if ($stmt->execute()) {
            echo 'Registration successful. <a href="login.html">Login here</a>.';
        } else {
            echo 'Registration failed.';
        }
    } 


    $db->close();
}
?>