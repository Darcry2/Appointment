<?php
session_start();
require_once 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Update Settings
  if (isset($_POST["update"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Update admin details in the database
    $query = "UPDATE admins SET username = :new_username, password_hash = :password_hash WHERE adms_id = :adms_id";
    $statement = $adminsConnection->prepare($query);
    $statement->bindValue(":new_username", $username);
    $statement->bindValue(":password_hash", password_hash($password, PASSWORD_DEFAULT));
    $statement->bindValue(":adms_id", $_SESSION['admin_id']); // Update this line to use the correct session variable name
    $statement->execute();

    // Redirect to a success page or display a success message
    header("Location: admin_home.php");
    exit();
  }

  // Delete Account
  if (isset($_POST["delete"])) {
    // Delete admin account from the database
    $query = "DELETE FROM admins WHERE adms_id = :adms_id"; // Update the column name in the query
    $statement = $adminsConnection->prepare($query);
    $statement->bindValue(":adms_id", $_SESSION['admin_id']); // Update this line to use the correct session variable name
    $statement->execute();

    // Redirect to a success page or display a success message
    header("Location: admin_login.php");
    exit();
  }
}
?>
