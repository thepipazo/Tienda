<?php

    $username = 'libros';
    $password = 'libros';
    $connection_string = 'localhost/XE';

    //Connect to an Oracle database
    $con = oci_connect($username,$password,$connection_string);

// Check connection
if (!$con) {
    die("Connection fallida");
}
?>

