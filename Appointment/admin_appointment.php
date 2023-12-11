<?php
session_start();
require_once 'dbconn.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM appointments WHERE name LIKE :search OR pet_name LIKE :search OR breed LIKE :search OR phone LIKE :search OR email LIKE :search OR appointment_date LIKE :search OR appointment_time LIKE :search OR message LIKE :search";
$stmt = $appointmentsConnection->prepare($sql);
$stmt->execute(['search' => "%$search%"]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="admin_css/admin_appointment.css">
  <title>Pet Grooming</title>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <!-- Navbar content -->
  </nav>
  
  <div class="container">
    <h1 class="text-center">All Appointment List</h1>
    <form method="GET" action="">
      <div class="form-group">
        <input type="text" class="form-control" name="search" placeholder="Search" value="<?php echo htmlspecialchars($search); ?>">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Pet Name</th>
          <th>Breed</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Date</th>
          <th>Time</th>
          <th>Message</th>
        </tr>
      </thead>
      <tbody>
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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
