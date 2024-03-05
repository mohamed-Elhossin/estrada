<?php

include_once '../../vendor/functions.php';
auth(2);
include_once '../../shared/head.php';
include_once '../../shared/header.php';
include_once '../../shared/aside.php';
include_once '../../vendor/configDatabase.php';

$validation_Errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validation_Errors = [];
    if (isset($_POST['send'])) {
        $validation_Errors = [];
        $title =  filterValidation($_POST['title']);
        $description = filterValidation($_POST['description']);
        $price = filterValidation($_POST['price']);
        $developer = filterValidation($_POST['developer']);
        $agent = filterValidation($_POST['agent']);
        $admin = $_SESSION['admin']['id'];

        if (stringValidation($title)) {
            $validation_Errors[] = "You Must Enter Valid Title";
        }
        if (stringValidation($description)) {
            $validation_Errors[] = "You Must Enter Valid description";
        }

        if (stringValidation($developer, 1)) {
            $validation_Errors[] = "You Must Enter Valid developer";
        }

        if (stringValidation($agent, 1)) {
            $validation_Errors[] = "You Must Enter Valid agent";
        }
        if (numberValidtion($price)) {
            $validation_Errors[] = "Please Enter Valid Price";
        }

        // image Code
        $image_House = url('app/properties/upload/');
        $image_name =  rand(0, 55) . rand(0, 55) . $_FILES['image']['name'];
        $image_path =  $image_House . $image_name;
        $tmp_name = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_type = $_FILES['image']['type'];
        $type = substr($image_name, -3);
        if (filterTypeValidation($type, 'jpg', 'png', 'jif')) {
            $validation_Errors[] = "You Must Enter Image ";
        }
        // if (filterTypeValidation()) {
        // }
        if (fileSizeValidation($image_size, 1)) {
            $validation_Errors[] = "Please Enter Valid Image less than 1 miga";
        }
        $location = "./upload/$image_name";
        if (empty($validation_Errors)) {
            move_uploaded_file($tmp_name, $location);
            $insert = "INSERT INTO properties VALUES (null , '$title','$description',$price,'$image_name','$image_path' ,$agent,$admin,$developer , Default)";
            $mysqli_run = mysqli_query($conn, $insert);
            redirect('properties/add.php');
            getMessage($mysqli_run, "Add properties");
        }
    }
}
clearSessionDone();


$selectAgents = "SELECT * FROM agents";
$agents = mysqli_query($conn, $selectAgents);
$selectdeveloppers = "SELECT * FROM developers";
$delevloprs = mysqli_query($conn, $selectdeveloppers);




?>

<div class="container col-8">
    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Create New Properies</h5>

            <?php if (isset($_SESSION['done'])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['done']; ?>
                    <form action="" method="POST">
                        <button type="submit" name="clearSession" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </form>
                </div>
            <?php endif; ?>
            <?php if (!empty($validation_Errors)) :  ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($validation_Errors as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach;  ?>
                    </ul>
                </div>
            <?php endif; ?>
            <!-- No LaclearSessionbels Form -->
            <form method="POST" class="row g-3" enctype="multipart/form-data">
                <div class="col-md-12">
                    <input type="text" name="title" class="form-control" placeholder="Your title">
                </div>
                <div class="form-group">
                    <div class="row">

                        <div class="col-md-6  mt-3">
                            <div class="form-group">
                                <input type="text" name="description" class="form-control" placeholder="description">

                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <input type="number" name="price" class="form-control" placeholder="price">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">image Pic.</label>
                    <input type="file" name="image" class="form-control" placeholder="Image">
                </div>
                <div class="form-group">
                    <div class="row">

                        <div class="col-md-6  mt-3">
                            <div class="form-group">
                                <select name="developer" id="" class="form-control">
                                    <option value=" " selected>-- Developer Name --</option>
                                    <?php foreach ($delevloprs as $item) :  ?>
                                        <option value=" <?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <select name="agent" id="" class="form-control">
                                    <option value=" " selected>-- Sales Name --</option>
                                    <?php foreach ($agents as $item) :  ?>
                                        <option value=" <?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
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