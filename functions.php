<?php
session_start();
require "conn.php";

if (isset($_POST['create'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO tblAccounts (firstName, lastName, email, password) 
                VALUES ('$firstName', '$lastName', '$email', '$password')";
    $result = mysqli_query($conn, $query);

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    
    header("Location: index.php");
}

if (isset($_POST['logIn'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM tblAccounts WHERE email = '$email' AND password = '$password'");
    $row = mysqli_fetch_array($query);

    if(is_array($row)) {

        $_SESSION['email'] = $row['email'];
        $S_SESSION['password'] = $row['password'];
        header("Location: index.php");
    }
    else {
        echo "WRONG PASSWORD ";
    }

}

