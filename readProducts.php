<?php
header('Content-Type: application/json; charset=utf-8');
require_once('conn.php');
class product
{
}
$sql = "SELECT * FROM products;";

// get result
$res = mysqli_query($conn, $sql);

$result = array();
$json = array();
while ($row = mysqli_fetch_assoc($res)) {
    $json[] = $row;
}
if ($res) {
    $response = new product();
    $response->error = false;
    $paket = array();
    $response->message = "Success";
    $response->data = $json;
    die(json_encode($response));
} else {
    $response = new product();
    $response->error = true;
    $response->message = "Error Mengambil Data";
    die(json_encode($response));
}
mysqli_close($conn);
