<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="admin_css/admin_login.css">  
  <title>Admin Login</title>
</head>

<body>
<div class="container mt-5">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
    <h2 class="text-center mt-3">Admin Login<hr></h2>
    <form method="POST" action="admin_login_query.php">
      <div class="form-group mt-5">
        <label for="username"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                </svg></label>
        <input type="text" class="form-control input-field mb-4" id="username" name="username" placeholder="Username" required>
      </div>
      <div class="form-group">
        <label for="password"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-file-lock-fill" viewBox="0 0 16 16">
                  <path d="M7 6a1 1 0 0 1 2 0v1H7V6zM6 8.3c0-.042.02-.107.105-.175A.637.637 0 0 1 6.5 8h3a.64.64 0 0 1 .395.125c.085.068.105.133.105.175v2.4c0 .042-.02.107-.105.175A.637.637 0 0 1 9.5 11h-3a.637.637 0 0 1-.395-.125C6.02 10.807 6 10.742 6 10.7V8.3z"/>
                  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-2 6v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V8.3c0-.627.46-1.058 1-1.224V6a2 2 0 1 1 4 0z"/>
                </svg></label>
        <input type="password" class="form-control input-field mt-1 mb-4" id="password" placeholder="Password" name="password" required>
      </div>
      <div class="form-group text-center">
      <button type="submit" class="form-control button mb-5">Login</button>
      </div>
    <div class="text-center mb-3">
          <p>Don't have an account? <a href="admin_register.php">Sign up</a></p>
          <p>Admin Login: <a href="member_login.php">Member Login</a></p>
        </div>
        </form>
        </div>
      </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
