<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "data_distribusi";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


function registrasi($data) {
    global $db;

    $nama = mysqli_real_escape_string($db, strtolower(stripslashes($data["nama"])));
    $email = mysqli_real_escape_string($db, trim($data["email"]));
    $password = mysqli_real_escape_string($db, $data["pass"]);
    $confirm_pass = mysqli_real_escape_string($db, $data["confirm_pass"]);

    $return = mysqli_query($db, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_fetch_assoc($return)) {
        echo "<script>
                alert('Email sudah terdaftar!');
            </script>";
        return false;
    }


    if ($password !== $confirm_pass) {
        echo "<script>
                alert('Konfirmasi password tidak cocok!');
            </script>";
        return false;
    }

    $password_hashed = password_hash($password, PASSWORD_ARGON2ID);

    $query = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password_hashed')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}



    
    













?>