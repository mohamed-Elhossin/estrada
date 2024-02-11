<?php
session_start();
define("BASE_URL", "http://localhost/estrada/admin/");

function url($var = null)
{
    return BASE_URL . $var;
}



function getMessage($condition, $message)
{

    if ($condition) {
        $_SESSION['done'] = "$message Successfuly";
    }
}



function redirect($var)
{

    echo "<script>
window.location.replace('http://localhost/estrada/admin/app/$var')
</script>";
}


function clearSessionDone()
{
    if (isset($_POST['clearSession'])) {

        unset($_SESSION['done']);
    }
}


function auth()
{
    if (isset($_SESSION['admin'])) {
        //  redirect('')
    } else {

        echo "<script>
    window.location.replace('http://localhost/estrada/admin/pages-login.php')
    </script>";
    }
}


 