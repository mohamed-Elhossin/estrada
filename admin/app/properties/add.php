<?php
include_once '../../vendor/functions.php';
auth();
include_once '../../shared/head.php';
include_once '../../shared/header.php';
include_once '../../shared/aside.php';
include_once '../../vendor/configDatabase.php';


if (isset($_POST['send'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $developer = $_POST['developer'];
    $agent = $_POST['agent'];
    $admin = $_SESSION['admin']['id'];

    // image Code
    $image_House = url('app/properties/upload/');
    $image_name =  rand(0, 55) . rand(0, 55) . $_FILES['image']['name'];

    $image_path =  $image_House . $image_name;

    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "./upload/$image_name";

    move_uploaded_file($tmp_name, $location);

    $insert = "INSERT INTO properties VALUES (null , '$title','$description',$price,'$image_name','$image_path' ,$agent,$admin,$developer)";
    $mysqli_run = mysqli_query($conn, $insert);

    redirect('properties/add.php');
    getMessage($mysqli_run, "Add properties");
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
                    <input type="file"    name="image" class="form-control" placeholder="Image">
                </div>
                <div class="form-group">
                    <div class="row">

                        <div class="col-md-6  mt-3">
                            <div class="form-group">
                                <select name="developer" id="" class="form-control">
                                    <option selected disabled>-- Developer Name --</option>
                                    <?php foreach ($delevloprs as $item) :  ?>
                                        <option value=" <?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <select name="agent" id="" class="form-control">
                                    <option selected disabled>-- Sales Name --</option>
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