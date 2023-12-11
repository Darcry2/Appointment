<?php
session_start();
require_once 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Check if username is already taken
  $query = "SELECT * FROM admins WHERE username = :username";
  $statement = $adminsConnection->prepare($query);
  $statement->bindValue(":username", $username);
  $statement->execute();
  $existingUser = $statement->fetch(PDO::FETCH_ASSOC);

  if ($existingUser) {
    // Username is already taken
    echo "<script>alert('Username is Already taken');</script>";
  } else {
    // Insert new user into database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO admins (adms_id, username, password_hash) VALUES (NULL,  :username, :password_hash)";
    $statement = $adminsConnection->prepare($query);
    $statement->bindValue(":username", $username);
    $statement->bindValue(":password_hash", $hashedPassword);
    $statement->execute();

    // Registration successful
    echo header ("location: admin_login.php");
  }
}
?>