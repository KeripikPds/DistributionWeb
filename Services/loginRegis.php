<?php
require "Services/function.php";

global $db;

if (isset($_POST["regis"])) {

    if ( registrasi ($_POST) > 0) {
        echo "<script>
                alert('Registrasi Berhasil!');
                document.location.href = 'login.php';
            </script>";
    } else {
        $pesan_error = mysqli_error($db);
        echo "<script>
                alert('Registrasi Gagal!')" . $pesan_error . "';
            </script>";
    }
}

if (isset($_POST["Login"])) {
    $email = $_POST["email"];
    $password = $_POST["pass"];

    $return = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");

    if (mysqli_num_rows($return) === 1) {
        $row = mysqli_fetch_assoc($return);
        if (password_verify($password, $row["password"])) {

            header("Location: index.php");
            exit;
        }
    }
    
    $error = true;

}



?>