<?php

session_start();
require_once 'dbconn.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch appointments for the logged-in user from the database
$user_id = $_SESSION['mem_id'];

$sql = "SELECT a.*, m.mem_id 
        FROM appointments AS a
        JOIN members AS m ON a.mem_id = m.mem_id
        WHERE a.mem_id = :mem_id
        AND (a.name LIKE :search OR a.pet_name LIKE :search OR a.breed LIKE :search OR a.phone LIKE :search OR a.email LIKE :search OR a.appointment_date LIKE :search OR a.appointment_time LIKE :search OR a.message LIKE :search)";

$stmt = $appointmentsConnection->prepare($sql);
$stmt->bindValue(':mem_id', $user_id);
$stmt->bindValue(':search', "%$search%");
$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Grooming</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="member_css/member_appointment.css">
</head>
<body>
  <nav class="navbar navbar-expand-md">
    <a class="navbar-brand" href="member_home.php">Pet Grooming</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="member_home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="member_profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="member_account_settings.php">Account Settings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="member_logout.php">Logout</a>
        </li>
        <li class="nav-item">
          <form method="GET" action="" class="form-inline">
            <div class="input-group">
              <input type="text" class="form-control transparent-input" name="search" placeholder="Search" value="<?php echo htmlspecialchars($search); ?>">
              <div class="input-group-append">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
              </div>
            </div>
          </form>
        </li>
      </ul>
    </div>
  </nav>
  
  <div class="container-fluid">
    <h1 class="text-center mt-3 mb-2">Appointments</h1>
    </form>
    <table class="table">
      <thead class="text-center">
        <tr>
          <th>Name</th>
          <th>Pet Name</th>
          <th>Breed</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Date</th>
          <th>Time</th>
          <th>Message</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="text-center">
      <?php if (!empty($appointments)): ?>
  <?php foreach ($appointments as $appointment): ?>
    <tr>
      <td><?php echo $appointment['name']; ?></td>
      <td><?php echo $appointment['pet_name']; ?></td>
      <td><?php echo $appointment['breed']; ?></td>
      <td><?php echo $appointment['phone']; ?></td>
      <td><?php echo $appointment['email']; ?></td>
      <td><?php echo $appointment['appointment_date']; ?></td>
      <td><?php echo date('h:i A', strtotime($appointment['appointment_time'])); ?></td>
      <td><?php echo $appointment['message']; ?></td>
      <td>
        <form action="member_appointment_query.php" method="post">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal">Update</button>
              <input type="hidden" name="appo_id" value="<?php echo $appointment['appo_id']; ?>">
              <input type="hidden" name="action" value="delete">
              <button type="submit" name="delete" id="delete" class="btn btn-danger">Delete</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
      <tr>
    <td colspan="9">No appointments found</td>
     </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>

<!-- Add the following code at the end of the HTML body -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add your update form here -->
        <form action="member_appointment_query.php" method="post">
          <!-- Include the necessary form fields for updating -->
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="appo_id" value="<?php echo $appointment['appo_id']; ?>">
          <!-- Add the remaining form fields -->
          <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control transparent-input" id="name" name="name" value="<?php echo $appointment['name']; ?>" required>
        </div>
        <div class="form-group">
          <label for="pet_name" class="mt-2">Pet Name:</label>
          <input type="text" class="form-control transparent-input" id="pet_name" name="pet_name" value="<?php echo $appointment['pet_name']; ?>" required>
        </div>
        <div class="form-group">
          <label for="breed" class="mt-2">Breed:</label>
          <input type="text" class="form-control transparent-input" id="breed" name="breed" value="<?php echo $appointment['breed']; ?>" required>
        </div>
        <div class="form-group">
          <label for="phone" class="mt-2">Phone: </label>
          <input type="tel" class="form-control transparent-input" name="phone" id="phone" value="<?php echo $appointment['phone']; ?>" required>
        </div>
        <div class="form-group">
          <label for="email" class="mt-2">Email:</label>
          <input type="email" class="form-control transparent-input" id="email" name="email" value="<?php echo $appointment['email']; ?>" required>
        </div>
        <div class="form-group">
          <label for="date" class="mt-2">Preferred Date:</label>
          <input type="date" class="form-control transparent-input" id="appointment_date" name="appointment_date" value="<?php echo $appointment['appointment_date']; ?>" required>
        </div>
        <div class="form-group">
          <label for="time" class="mt-2">Preferred Time:</label>
          <input type="time" class="form-control transparent-input" id="appointment_time" name="appointment_time" value="<?php echo $appointment['appointment_time']; ?>"required>
        </div>
        <div class="form-group">
          <label for="message" class="mt-2">Message:</label>
          <textarea class="form-control transparent-input" id="message" name="message" rows="5" value="<?php echo $appointment['message']; ?>"></textarea>
        </div>
          <!-- Add a submit button for the update action -->
          <button type="submit" name="update" id="update" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>    

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
