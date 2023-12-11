<?php
session_start();
require_once 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Check if username is already taken
  $query = "SELECT * FROM members WHERE username = :username";
  $statement = $membersConnection->prepare($query);
  $statement->bindValue(":username", $username);
  $statement->execute();
  $existingUser = $statement->fetch(PDO::FETCH_ASSOC);

  if ($existingUser) {
    // Username is already taken
    echo "<script>alert('Username Already Taken');</script>";
  } else {
    // Insert new user into database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO members (mem_id, firstname, lastname, username, password_hash) VALUES (NULL, :firstname, :lastname, :username, :password_hash)";
    $statement = $membersConnection->prepare($query);
    $statement->bindValue(":firstname", $firstname);
    $statement->bindValue(":lastname", $lastname);
    $statement->bindValue(":username", $username);
    $statement->bindValue(":password_hash", $hashedPassword);
    $statement->execute();

    // Registration successful
    echo header ("location: member_login.php");
  }
}
?>
