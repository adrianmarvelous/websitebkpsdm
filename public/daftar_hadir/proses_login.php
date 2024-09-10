<?php
ini_set('display_errors', 1);
error_reporting(~0);
include "koneksi.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Your authentication logic goes here
    // For demonstration, let's assume the username is "admin" and password is "password"
    
    $query_get_data_lo = $db->prepare('SELECT * FROM data_master_lo WHERE nip_nik = :username AND password = :password');
    $query_get_data_lo->bindParam(':username', $username);
    $query_get_data_lo->bindParam(':password', $password);
    $query_get_data_lo->execute();
    $data_query_get_data_lo = $query_get_data_lo->fetch(PDO::FETCH_ASSOC);
    $id_lo = $data_query_get_data_lo['id'];
    $valid_username = $data_query_get_data_lo['nip_nik'];
    $valid_password = $data_query_get_data_lo['password'];

    // Check if the provided username and password match the valid credentials
    if ($username === $valid_username && $password === $valid_password) {
        // If credentials are valid, redirect the user to a secure page
        header("Location: index.php?id_lo=$id_lo");
        exit();
    } else {
        // If credentials are not valid, display an error message
        echo "Invalid username or password.";
    }
}
?>
