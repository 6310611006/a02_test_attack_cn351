<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>

  
  <div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form method="POST" action="register_process.php">
        <div class="form-group">
                <label>Username</label>
                <input type="text" id="username" name="username" class="form-control" required><br><br>
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group">
                <label>Email</label>
                <input type="email" id="email" name="email" class="form-control" required><br><br>
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password" class="form-control" required><br><br>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
      
        <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Register">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
    <!-- <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <input type="submit" value="Register"> -->
  </form>
</body>
</html>

