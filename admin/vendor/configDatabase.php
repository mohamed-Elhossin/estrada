
<?php
try{
    $conn = mysqli_connect("localhost", "root", "", "estrada");
}catch(Exception $e){
    echo $e->getMessage();
}


