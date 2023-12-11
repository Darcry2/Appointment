<?php
session_start();
require_once 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Update Settings
  if (isset($_POST["update"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Update user details in the database
    $query = "UPDATE members SET firstname = :firstname, lastname = :lastname, username = :new_username, password_hash = :password_hash WHERE mem_id = :mem_id";
    $statement = $membersConnection->prepare($query);
    $statement->bindValue(":firstname", $firstname);
    $statement->bindValue(":lastname", $lastname);
    $statement->bindValue(":new_username", $username);
    $statement->bindValue(":password_hash", password_hash($password, PASSWORD_DEFAULT));
    $statement->bindValue(":mem_id", $_SESSION['mem_id']);
    $statement->execute();

    // Redirect to a success page or display a success message
    echo header("Location: member_login.php");
  }

  // Delete Account
  if (isset($_POST["delete"])) {
    // Delete user account from the database
    $query = "DELETE FROM members WHERE mem_id = :mem_id";
    $statement = $membersConnection->prepare($query);
    $statement->bindValue(":mem_id", $_SESSION['mem_id']);
    $statement->execute();

    // Redirect to a success page or display a success message
    echo header("Location: member_login.php");
  }
}
?>
