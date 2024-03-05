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

function redirect2($var)
{

    echo "<script>
window.location.replace('http://localhost/estrada/admin/$var')
</script>";
}


function clearSessionDone()
{
    if (isset($_POST['clearSession'])) {

        unset($_SESSION['done']);
    }
}


function auth( $ruleTwo = null, $ruleThree = null)
{
    if (isset($_SESSION['admin'])) {

        if ($_SESSION['admin']['rule'] == 1 || $_SESSION['admin']['rule'] == $ruleTwo
        || $_SESSION['admin']['rule'] == $ruleThree) {
        } else {
            redirect2('pages-error-404.php');
        }
    } else {

        echo "<script>
    window.location.replace('http://localhost/estrada/admin/pages-login.php')
    </script>";
    }
}

// Validation Filter Function


function filterValidation($input)
{
    $input = trim($input);
    $input = strip_tags($input);
    $input = htmlspecialchars($input);
    $input = stripslashes($input);

    return $input;
}



function stringValidation($input, $minLengthSize = 2, $maxSize = 20)
{
    $empty = empty($input);
    $minLength = strlen($input) < $minLengthSize;
    $maxLength = strlen($input) > $maxSize;
    if ($empty == true || $minLength == true || $maxLength == true) {
        return true;
    } else {
        return false;
    }
}


function numberValidtion($input)
{
    $empty = empty($input);
    $isNegtive = $input < 0;
    $NotNumber = filter_var($input, FILTER_VALIDATE_FLOAT) == false;
    if ($empty == true || $isNegtive == true || $NotNumber == true) {
        return true;
    } else {
        return false;
    }
}

function fileSizeValidation($image_Size, $your_size = 2)
{
    $size = ($image_Size / 1024) / 1024;

    $sizeBiger = $size > $your_size;
    if ($sizeBiger == true) {
        return true;
    } else {
        return false;
    }
}


function filterTypeValidation($file_type, $type1 = null, $type2 = null, $type3 = null, $type4 = null)
{
    if ($file_type == "$type1" || $file_type == "$type2" || $file_type == "$type3" || $file_type == "$type4") {
        return false;
    } else {
        return true;
    }
}
