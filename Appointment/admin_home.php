<?php
session_start();
require_once 'dbconn.php';
$currentMonth = date('n');
$currentYear = date('Y');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
$firstDay = date('N', strtotime($currentYear . '-' . $currentMonth . '-01'));
$lastDay = date('N', strtotime($currentYear . '-' . $currentMonth . '-' . $daysInMonth));

// Fetch appointments for the current month
$startOfMonth = date('Y-m-01');
$endOfMonth = date('Y-m-t');
$sql = "SELECT * FROM appointments WHERE appointment_date >= :startOfMonth AND appointment_date <= :endOfMonth";
$stmt = $appointmentsConnection->prepare($sql);
$stmt->execute(['startOfMonth' => $startOfMonth, 'endOfMonth' => $endOfMonth]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group appointments by date
$appointmentsByDate = [];
foreach ($appointments as $appointment) {
  $date = date('j', strtotime($appointment['appointment_date']));
  $appointmentsByDate[$date][] = $appointment;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="admin_css/admin_home.css">
  <title>Admin Home</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-light">
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
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_appointment.php">Appointments</a>
        </li>
        <li class="nav-item">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Account Settings
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="admin_profile.php">Profile</a>
            <a class="dropdown-item" href="admin_account_settings.php">Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="admin_logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="container">
      <h2 class="text-center">May 2023</h2>
      <table class="calendar table table-bordered">
        <thead>
          <tr>
            <th>Sun</th>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <?php
            $day = 1 - $firstDay;
            for ($i = 0; $i < 6; $i++) {
              for ($j = 0; $j < 7; $j++) {
                if ($day >= 1 && $day <= $daysInMonth) {
                  $cellClass = ($day === date('j') && $currentMonth === date('n')) ? 'today' : '';
                  echo '<td class="' . $cellClass . '">' . $day;

                  // Display appointments for the current date
                  if (isset($appointmentsByDate[$day])) {
                    foreach ($appointmentsByDate[$day] as $appointment) {
                      echo '<div class="event">';
                      echo '<span class="event-title">' . $appointment['name'] . ' - ' . $appointment['pet_name'] . '</span></br>';
                      $appointmentTime = date('h:i A', strtotime($appointment['appointment_time']));
                      echo '<span class="event-time">' . $appointmentTime . '</span></br>';
                      echo '</div>';
                    }
                  }

                  echo '</td>';
                } else {
                  echo '<td class="prev-month"></td>';
                }
                $day++;
              }
              if ($day > $daysInMonth) break;
              echo '</tr><tr>';
            }
            ?>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

