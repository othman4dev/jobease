<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Registration or Sign Up form in HTML CSS | CodingLab </title>
  <link rel="stylesheet" href="styles/registerstyle.css">
  <script>
  function confirmPassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    if (password != confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }
    return true;
}
function changeDisabled(e) {
  document.getElementById("submit").disabled = !e.checked;
}
</script>
</head>

<body>
  <div class="wrapper">
    <h2>Registration</h2>
    <form action="verifyUser.php" onsubmit="return confirmPassword()" method="POST">
      <div class="input-box">
        <input type="text" placeholder="Enter your name" required name="name">
      </div>
      <div class="input-box">
        <input type="text" placeholder="Enter your email" required name="email">
      </div>
      <div class="input-box">
        <input type="password" placeholder="Create password" required id="password" name="password">
      </div>
      <div class="input-box">
        <input type="password" placeholder="Confirm password" id="confirmPassword" required name="confirmedPassword">
        <?php 
          if (isset($_GET['error'])) {
            echo "<span style='color:red;font-size:11px'>" . $_GET['error'] . "</span>";
          }
        ?>
      </div>
      <div class="policy">
        <input type="checkbox" onchange="changeDisabled(this)">
        <h3>I accept all terms & condition</h3>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Register Now" name="register" id="submit" disabled>
      </div>
      <div class="text">
        <h3>Already have an account? <a href="login.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>
</html>
