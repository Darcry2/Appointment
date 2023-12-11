<!DOCTYPE html>
<html>
<head>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="admin_css/admin_account_settings.css">
  <title>Admin Settings</title>
</head>
<body>
  <div class="container">
    <h2 class="mt-4">Admin Settings</h2>
    <?php
      session_start();
      require_once 'dbconn.php';

      // Check if the admin is logged in
      if (isset($_SESSION["admin_id"])) {
        $adminId = $_SESSION["admin_id"];

        // Fetch the admin's profile from the database
        $query = "SELECT * FROM admins WHERE adms_id = :admin_id";
        $statement = $adminsConnection->prepare($query);
        $statement->bindValue(":admin_id", $adminId);
        $statement->execute();
        $admin = $statement->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
          $username = $admin['username'];
          $password = $admin['password_hash'];
          ?>
          
    <a href="admin_home.php">Go back to Admin Home</a> 
    <form action="admin_account_settings_query.php" method="POST" class="mt-4">
      <div class="form-group">
        <label for="username"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
         <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
         <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
       </svg></label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>" class="form-control input-field" required>
      </div>

      <div class="form-group">
        <label for="password"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-file-lock-fill" viewBox="0 0 16 16">
          <path d="M7 6a1 1 0 0 1 2 0v1H7V6zM6 8.3c0-.042.02-.107.105-.175A.637.637 0 0 1 6.5 8h3a.64.64 0 0 1 .395.125c.085.068.105.133.105.175v2.4c0 .042-.02.107-.105.175A.637.637 0 0 1 9.5 11h-3a.637.637 0 0 1-.395-.125C6.02 10.807 6 10.742 6 10.7V8.3z"/>
          <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-2 6v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V8.3c0-.627.46-1.058 1-1.224V6a2 2 0 1 1 4 0z"/>
        </svg></label>
        <input type="password" name="password" id="password" value="<?php echo $password; ?>" class="form-control input-field" required>
      </div>

      <div class="form-group">
        <label for="confirm_password"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-file-lock-fill" viewBox="0 0 16 16">
          <path d="M7 6a1 1 0 0 1 2 0v1H7V6zM6 8.3c0-.042.02-.107.105-.175A.637.637 0 0 1 6.5 8h3a.64.64 0 0 1 .395.125c.085.068.105.133.105.175v2.4c0 .042-.02.107-.105.175A.637.637 0 0 1 9.5 11h-3a.637.637 0 0 1-.395-.125C6.02 10.807 6 10.742 6 10.7V8.3z"/>
          <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-2 6v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V8.3c0-.627.46-1.058 1-1.224V6a2 2 0 1 1 4 0z"/>
        </svg></label>
        <input type="password" class="form-control input-field" id="confirm_password" value="<?php echo $password; ?>" name="confirm_password" required>
      </div>

      <input type="submit" value="update" name="update" class="btn btn-primary">
    </form>

    <br>

    <form action="admin_account_settings_query.php" method="POST" onsubmit="return confirmDelete();">
      <input type="submit" value="Delete" name="delete" class="btn btn-danger">
    </form>
<?php
        } else {
          echo "<script>alert('Admin Profile not Found');</script>";
        }
      } else {
        // Redirect to the login page if not logged in
        header("Location: admin_login.php");
        exit();
      }
      ?>
<script>
  function confirmDelete() {
    if (confirm('Are you sure you want to delete your account?')) {
      window.location.href = 'admin_login.php?delete=1';
      return true;
    }
    return false;
  }
</script>
  </div>
</body>
</html>
