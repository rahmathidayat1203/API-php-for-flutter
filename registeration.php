<?php
header('Content-Type: application/json; charset=utf-8');

class user
{
}

$date = date('h:i:sa');
$allow_extention = array('png', 'jpg');
$nama_foto = $_FILES['gambar']['name'];
$explode = explode('.', $nama_foto);
$extention = strtolower(end($explode));
$size = $_FILES['gambar']['size'];
$foto_temp = $_FILES['gambar']['tmp_name'];

$rand = rand();
$ekstensi = array('png', 'jpg', 'jpeg');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_images = str_replace(" ", "", $name) . strtotime($date) . '.' . $extention;

    move_uploaded_file($foto_temp, 'gambar/' . $user_images);
    $sql = "INSERT INTO users(name,email,password,images) VALUES('$name','$email','$password','$user_images')";

    require_once('conn.php');


    if (mysqli_query($conn, $sql)) {
        $response = new user();
        $response->error = false;
        $response->message = "Registrasi Berhasil";
        die(json_encode($response));
    } else {
        $response = new product();
        $response->error = true;
        $response->message = "Registrasi Gagal";
        die(json_encode($response));
    }
}
