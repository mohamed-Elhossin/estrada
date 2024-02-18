<?php
include_once '../../vendor/functions.php';
  auth();
include_once '../../shared/head.php';
include_once '../../shared/header.php';
include_once '../../shared/aside.php';
include_once '../../vendor/configDatabase.php';
 

$select = "SELECT * FROM developers";
$allData = mysqli_query($conn, $select);



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
                    <h5 class="card-title">List Developers</h5>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>Name</th>
             
             

                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach ($allData as $item) : ?>
                                <tr>
                                <td> <?= $item['id'] ?> </td>
                                <td> <?= $item['name'] ?> </td>
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