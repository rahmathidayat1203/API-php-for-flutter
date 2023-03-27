<?php
header('Content-Type: application/json; charset=utf-8');
$id = $_POST['id'];

class product
{
}
require_once('conn.php');

$query = "SELECT * FROM products WHERE id=$id";
$res = mysqli_query($conn, $query);
$json = array();
while ($row = mysqli_fetch_assoc($res)) {
    $json[] = $row;
}
$response = new product();
$response->data = $json;
unlink('gambar/' . strval(trim($response->data[0]['product_pictures'], ' ')));
$sql = "DELETE FROM products WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    $response = new product();
    $response->error = false;
    $response->message = "Data Berhasil Di Hapus";
    die(json_encode($response));
} else {
    $response = new product();
    $response->error = true;
    $response->message = "Data Gagal Di Hapus";
    die(json_encode($response));
}

mysqli_close($conn);
