<?php
include_once '../../vendor/functions.php';
  auth();
include_once '../../shared/head.php';
include_once '../../shared/header.php';
include_once '../../shared/aside.php';
include_once '../../vendor/configDatabase.php';


if (isset($_POST['send'])) {
    $name = $_POST['name'];
 
    $insert = "INSERT INTO developers VALUES (null , '$name')";
    $mysqli_run = mysqli_query($conn, $insert);
 
    redirect('developers/add.php');
    getMessage($mysqli_run, "Add Developer");
}

clearSessionDone();


?>

<div class="container col-8">
    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Create New Developers</h5>

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