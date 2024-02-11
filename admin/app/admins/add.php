<?php
include_once '../../vendor/functions.php';
  auth();
include_once '../../shared/head.php';
include_once '../../shared/header.php';
include_once '../../shared/aside.php';
include_once '../../vendor/configDatabase.php';


if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password =  $_POST['password'];
    $hash_password = sha1($password);
    $insert = "INSERT INTO admins VALUES (null , '$name','$hash_password','$email')";
    $mysqli_run = mysqli_query($conn, $insert);
    // header("http://localhost/estrada/admin/app/admins/add.php");
    redirect('admins/add.php');
    getMessage($mysqli_run, "Add Admin");
}

clearSessionDone();


?>

<div class="container col-8">
    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Create New Admin</h5>

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
                <div class="col-md-12">
                    <input type="text" name="name" class="form-control" placeholder="Your Name">
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="col-md-6">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>


                <div class="text-center">
                    <button type="submit" name="send" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- End No Labels Form -->

        </div>
    </div>
</div>

<?php
include_once "../../shared/footer.php";
include_once '../../shared/script.php';
?>