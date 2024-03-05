<?php
include '../admin/vendor/configDatabase.php';
session_start();
if (isset($_POST['send'])) {

    $userName = $_POST['userName'];
    $userPassword = $_POST['userPassword'];

    $select = "SELECT * FROM `users` WHERE `name` = '$userName' and  `password` = '$userPassword' ";
    $selectRow = mysqli_query($conn, $select);
    $num = mysqli_num_rows($selectRow);
    $row = mysqli_fetch_assoc($selectRow);
    if ($num > 0) {
        $_SESSION['userData'] = [
            "id" => $row['id'],
            "name" => $row['name'],
            "email" => $row['email'],
        ];
        header("location: /estrada/user/");
    } else {
        echo "false login";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1> Login Page </h1>


    <form action="" method="POST">
        <input type="text" name="userName">
        <input type="password" name="userPassword">
        <button name="send">Login</button>
    </form>
</body>

</html>