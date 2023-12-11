<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="member_css/member_profile.css">
    <title>Member Profile</title>
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
    <div class="container mt-5">
        <h2 class="text-center mt-5">Member Profile</h2>
        <div class="home-link">
            <a href="member_home.php">Go back to Member Home</a>
        </div>
        <form action="">
                <?php
      session_start();
      require_once 'dbconn.php';
      
      // Retrieve member profile information from the database
      $query = "SELECT firstname, lastname, username FROM members WHERE mem_id = :mem_id";
      $statement = $membersConnection->prepare($query);
      $statement->bindValue(":mem_id", $_SESSION['mem_id']);
      $statement->execute();
      $member = $statement->fetch(PDO::FETCH_ASSOC);
      
      if ($member) {
        $firstname = $member['firstname'];
        $lastname = $member['lastname'];
        $username = $member['username'];
        ?>
        
        <div class="left-section">
            <div class="form-group">
                <label>First Name:</label>
                <h1><?php echo $firstname; ?></h1>
            </div>
            <div class="form-group">
                <label>Last Name:</label>
                <h1><?php echo $lastname; ?></h1>
            </div>
        </div>
        <div class="right-section">
            <div class="form-group ">
                <label>Username:</label>
                <h1><?php echo $username; ?></h1>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="********" readonly>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" onclick="showPassword()">
                    <label class="form-check-label mb-5" for="showPassword">Show Password</label>
                </div>
            </div>
        </div>
        <?php
      } else {
        echo "Member not found.";
      }
      ?>
      </form>
    </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
