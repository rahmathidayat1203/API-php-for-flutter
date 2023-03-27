<?php
header('Content-Type: application/json; charset=utf-8');

require_once('conn.php');
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

$id_product = $_POST['id'];
$nama_product = $_POST['name_product'];
$quantity_product = $_POST['quantity_product'];
$price_product = $_POST['price_product'];
$product_pictures = str_replace(' ', '', $nama_product) . strtotime($date) . '.' . $extention;



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (in_array($extention, $allow_extention) === true) {
        $query = "SELECT * FROM products WHERE id='$id_product'";
        $res = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($res);
        unlink('gambar/' . $row['product_pictures']);
        $sql = "UPDATE products SET name_product='$nama_product',quantity_product='$quantity_product',price_product='$price_product',product_pictures='$product_pictures' WHERE id='$id_product'";
        move_uploaded_file($foto_temp, 'gambar/' . $product_pictures);
        $response = new product();
        if (mysqli_query($conn, $sql)) {
            $response = new product();
            $response->error = false;
            $response->message = "Data Berhasil Di Edit";
            die(json_encode($response));
        } else {
            $response = new product();
            $response->error = true;
            $response->message = "Data Gagal Di Edit";
            die(json_encode($response));
        }
    }
}
