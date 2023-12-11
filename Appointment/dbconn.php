<?php
$host = "localhost";
$dbname = "my_database";
$username = "root";
$password = "";

try {
  // Establish a connection for the members table
  $membersConnection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $membersConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Establish a connection for the admins table
  $adminsConnection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $adminsConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Establish a connection for the appointments table
  $appointmentsConnection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $appointmentsConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>
