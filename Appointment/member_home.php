<?php 

  session_start();
  require_once 'dbconn.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="member_css/member_home.css">
  <title>Pet Grooming</title>
</head>
<body>
  <nav class="navbar navbar-expand-md">
    <a class="navbar-brand" href="#">Pet Grooming</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="member_appointment.php">Appointment</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Account Settings
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="member_profile.php">Profile</a>
            <a class="dropdown-item" href="member_account_settings.php">Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="member_logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
      <h1 class="text-center"Schedule an Appointment for Pet Grooming</h1>
      <form action="member_appointment_query.php" method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control transparent-input" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="pet_name" class="mt-5">Pet Name</label>
          <input type="text" class="form-control transparent-input" id="pet_name" name="pet_name" required>
        </div>
        <div class="form-group">
          <label for="breed" class="mt-5">Breed</label>
          <input type="text" class="form-control transparent-input" id="breed" name="breed" required>
        </div>
        <div class="form-group">
          <label for="phone" class="mt-5">Phone</label>
          <input type="tel" class="form-control transparent-input" name="phone" id="phone" required>
        </div>
        <div class="form-group">
          <label for="email" class="mt-5">Email</label>
          <input type="email" class="form-control transparent-input" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="date" class="mt-5">Preferred Date</label>
          <input type="date" class="form-control transparent-input" id="appointment_date" name="appointment_date" required>
        </div>
        <div class="form-group">
          <label for="time" class="mt-5">Preferred Time</label>
          <input type="time" class="form-control transparent-input mt-3" id="appointment_time" name="appointment_time" required>
        </div>
        <div class="form-group">
          <label for="message" class="mt-5">Message</label>
          <textarea class="form-control transparent-input mt-3" id="message" name="message" rows="5"></textarea>
        </div>
        <input type="hidden" name="action" value="insert">
        <button type="submit" class="mt-5" name="insert" value="insert">Submit</button>
      </form>
    </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
