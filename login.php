<?php
header('Content-Type: application/json; charset=utf-8');

class user
{
}


require_once('conn.php');

$email = $_POST['email'];
$password = $_POST['password'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password';";
    $res = mysqli_query($conn, $sql);
    if ($res->num_rows > 0) {
        $response = new user();
        $response->error = false;
        $paket = array();
        $response->message = "LOGIN SUCCESSFULLY";
        die(json_encode($response));
    } else {
        $response = new user();
        $response->error = true;
        $response->message = "LOGIN ERROR YOUR CREDENTIAL IS INVALID";
        die(json_encode($response));
    }
}
