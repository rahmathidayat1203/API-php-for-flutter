<?php
header('Content-Type: application/json; charset=utf-8');
class product
{
}


$date = date('h:i:sa');
$allow_extention = array('png', 'jpg');
$nama_foto = $_FILES['gambar']['name'];
$explode = explode('.', $nama_foto);
$extention = strtolower(end($explode));
$size = $_FILES['gambar']['size'];
$foto_temp = $_FILES['gambar']['tmp_name'];

$name_product = $_POST['name_product'];
$quantity_produt = $_POST['quantity_product'];
$price_product = $_POST['price_product'];
$product_pictures = str_replace(' ', '', $name_product) . strtotime($date) . '.' . $extention;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (in_array($extention, $allow_extention) === true) {
        if ($size < 1044070) {

            // query upload file
            move_uploaded_file($foto_temp, 'gambar/' . $product_pictures);
            $sql = "INSERT INTO products(name_product,quantity_product,price_product,product_pictures) VALUES('$name_product','$quantity_produt','$price_product','$product_pictures');";

            require_once('conn.php');
            if (mysqli_query($conn, $sql)) {
                $response = new product();
                $response->error = false;
                $response->message = "Data Berhasil Disimpan";
                die(json_encode($response));
            } else {
                $response = new product();
                $response->error = true;
                $response->message = "Data Gagal Disimpan";
                die(json_encode($response));
            }
        }
    }
}
