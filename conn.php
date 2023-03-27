<?php

define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "product_management");

$conn = mysqli_connect(HOST, USER, PASS, DB) or die("Unnable to Connect");
