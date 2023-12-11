<?php
session_start();
require_once 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Check if username exists in the admins table
  $query = "SELECT * FROM admins WHERE username = :username";
  $statement = $adminsConnection->prepare($query);
  $statement->bindValue(":username", $username);
  $statement->execute();
  $admin = $statement->fetch(PDO::FETCH_ASSOC);

  if ($admin) {
    // Verify the password
    if (password_verify($password, $admin["password_hash"])) {
      // Password is correct, store admin data in session
      $_SESSION["admin_id"] = $admin["adms_id"];
      $_SESSION["admin_username"] = $admin["username"];

      // Redirect to admin dashboard or desired page
      header("Location: admin_home.php");
      exit();
    } else {
      // Password is incorrect
      echo "<script>alert('Wrong Username or password');</script>";
    }
  } else {
    // Admin does not exist
    echo "<script>alert('Admin does not Exist');</script>";
  }
}
?>
