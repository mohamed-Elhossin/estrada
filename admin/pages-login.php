<?php

include_once 'shared/head.php';

include_once 'vendor/configDatabase.php';
include_once 'vendor/functions.php';

if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $password =  $_POST['password'];
  $hash_password = sha1($password);

  $select = "SELECT * FROM admins WHERE `email`='$email' and `password` ='$hash_password'";
  $selectRun = mysqli_query($conn, $select);

  $numRows = mysqli_num_rows($selectRun);


  if ($numRows == 1) {
    $_SESSION['admin'] = $email;
    header('location: /estrada/admin/index.php');
  } else {
    // redirect('admins/add.php');
    getMessage(true, "False Admin");
  }
}
if (isset($_GET['logout'])) {
  session_unset();
  session_destroy();
}
clearSessionDone();
print_r($_SESSION);
?>

<div class="container col-md-4 text-center mt-5">
  <div class="card">
    <div class="card-body">

      <h5 class="card-title">Login As Admin</h5>

      <?php if (isset($_SESSION['done'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $_SESSION['done']; ?>
          <form action="" method="POST">
            <button type="submit" name="clearSession" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </form>
        </div>
      <?php endif; ?>

      <!-- No LaclearSessionbels Form -->
      <form method="POST" class="row g-3">

        <div class="form-group">
          <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>


        <div class="text-center">
          <button type="submit" name="login" class="btn btn-primary">Login</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form><!-- End No Labels Form -->

    </div>
  </div>
</div>

<?php
include_once "shared/footer.php";
include_once 'shared/script.php';
?>