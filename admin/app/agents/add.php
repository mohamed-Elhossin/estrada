<?php
include_once '../../vendor/functions.php';
auth();
include_once '../../shared/head.php';
include_once '../../shared/header.php';
include_once '../../shared/aside.php';
include_once '../../vendor/configDatabase.php';


if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $phone =  $_POST['phone'];
    // image Code
    $image_name = rand(0, 55) . rand(0, 55) . $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "./upload/$image_name";
    move_uploaded_file($tmp_name, $location);


    $insert = "INSERT INTO agents VALUES (null , '$name','$image_name','$phone')";
    $mysqli_run = mysqli_query($conn, $insert);

    redirect('agents/add.php');
    getMessage($mysqli_run, "Add Agent");
}

clearSessionDone();


?>

<div class="container col-8">
    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Create New Agent</h5>

            <?php if (isset($_SESSION['done'])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['done']; ?>
                    <form action="" method="POST">
                        <button type="submit" name="clearSession" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </form>
                </div>
            <?php endif; ?>

            <!-- No LaclearSessionbels Form -->
            <form method="POST" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-12">
                    <input type="text" name="name" class="form-control" placeholder="Your Name">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="phone" class="form-control" placeholder="Password">
                        </div>

                        <div class="col-md-6">

                            <input type="file" name="image" class="form-control" placeholder="Image">
                        </div>
                    </div>
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