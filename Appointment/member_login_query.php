<?php
session_start();
require_once 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Check if username exists in the members table
  $query = "SELECT * FROM members WHERE username = :username";
  $statement = $membersConnection->prepare($query);
  $statement->bindValue(":username", $username);
  $statement->execute();
  $member = $statement->fetch(PDO::FETCH_ASSOC);

  if ($member) {
    // Verify the password
    if (password_verify($password, $member["password_hash"])) {
      // Password is correct, store user data in session
      $_SESSION["mem_id"] = $member["mem_id"];
      $_SESSION["username"] = $member["username"];

      // Redirect to a logged-in page
      header("Location: member_home.php");
      exit();
    } else {
      // Password is incorrect
      echo "<script>alert('Username & Password is Incorrect');</script>";
    }
  } else {
    // User does not exist
    echo "<script>alert('User does not Exist');</script>";
  }
}
?>
