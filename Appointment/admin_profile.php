<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="admin_css/admin_profile.css">
  <title>Admin Profile</title>
  <script>
    function showPassword() {
      var passwordInput = document.getElementById("password");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
      } else {
        passwordInput.type = "password";
      }
    }
  </script>
</head>
<body>
  <div class="container">
    <h2>Admin Profile</h2>
    <a href="admin_home.php">Go back to Admin Home</a> <!-- Added link to admin_home.php -->
    <form>
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
          ?>
          
          <div class="form-group">
            <label>Username:</label>
            <h1><?php echo $username; ?></h1>
          </div>

          <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="********" readonly>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" onclick="showPassword()">
              <label class="form-check-label" for="showPassword">Show Password</label>
            </div>
          </div>
          
        <?php
        } else {
          echo "<script>alert('Admin Profile does not Exist');</script>";
        }
      } else {
        // Redirect to the login page if not logged in
        header("Location: admin_login.php");
        exit();
      }
      ?>
    </form>
  </div>
  
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
