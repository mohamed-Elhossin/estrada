<?php
include_once '../../vendor/functions.php';
auth();
include_once '../../shared/head.php';
include_once '../../shared/header.php';
include_once '../../shared/aside.php';
include_once '../../vendor/configDatabase.php';


$select = "SELECT * FROM properties";
$allData = mysqli_query($conn, $select);



if (isset($_GET['status'])) {
    $id = $_GET['status'];
    $selectOne = "SELECT * FROM properties where id = $id";
    $allDataOne = mysqli_query($conn, $selectOne);
    $row = mysqli_fetch_assoc($allDataOne);

    if ($row['status'] == 'wating') {
        $update = "UPDATE properties SET `status`= 'approve' where id =$id";
        mysqli_query($conn, $update);
        redirect('properties/list.php');
    } else {
        $update = "UPDATE properties SET `status`= 'wating' where id =$id";
        mysqli_query($conn, $update);
        redirect('properties/list.php');
    }
}

?>

<div class="pagetitle">
    <h1>Data Tables</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List Admins</h5>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>title</th>
                                <th>description</th>
                                <th>status</th>

                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach ($allData as $item) : ?>
                                <tr>
                                    <td> <?= $item['id'] ?> </td>
                                    <td> <?= $item['title'] ?> </td>
                                    <td> <?= $item['description'] ?> </td>
                                    <?php if ($item['status'] == 'wating') :  ?>
                                        <td> <a href="<?= url('app/properties/list.php') ?>?status=<?= $item['id'] ?>" class="btn btn-info"><?= $item['status'] ?> </a> </td>
                                    <?php else : ?>
                                        <td><a href="<?= url('app/properties/list.php') ?>?status=<?= $item['id'] ?>" class="btn btn-success"><?= $item['status'] ?></a> </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>

<?php
include_once "../../shared/footer.php";
include_once '../../shared/script.php';
?>