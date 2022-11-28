<?php
session_start();
require "conn.php";

if (isset($_POST['createUser'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = "user";

    $query = "INSERT INTO tblAccounts (firstName, lastName, email, password, userType) 
                VALUES ('$firstName', '$lastName', '$email', '$password', '$userType')";
    $result = mysqli_query($conn, $query);

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['userType'] = $userType;
    
    header("Location: index.php");
}

if (isset($_POST['createAdmin'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = "admin";

    $query = "INSERT INTO tblAccounts (firstName, lastName, email, password, userType) 
                VALUES ('$firstName', '$lastName', '$email', '$password', '$userType')";
    $result = mysqli_query($conn, $query);

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['userType'] = $userType;
    
    header("Location: index.php");
}

if (isset($_POST['logIn'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM tblAccounts WHERE email = '$email' AND password = '$password'");
    $row = mysqli_fetch_array($query);

    if(is_array($row)) {

        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['lastName'] = $row['lastName'];
        $_SESSION['userType'] = $row['userType'];
        header("Location: index.php");
    }
    else {
        echo "TRY AGAIN";
    }

}

if(isset($_GET['addToCart'])) {

    if(!isset($_SESSION['email'])) {
        header("Location: login.php");
    }
    else {

    $foodId = $_GET['addToCart'];
    echo $foodId;
    $queryGetFood = "SELECT * FROM tblproducts WHERE id='$foodId'";
    $queryResultFood = mysqli_query($conn, $queryGetFood);

    if(mysqli_num_rows($queryResultFood)> 0) {

        $food = mysqli_fetch_array($queryResultFood);

            $foodName = $food['productName'];
            $foodPrice = $food['price'];
            $foodQty = $food['quantity'];
            $queryInsertFood = "INSERT INTO tblcart (productName, price, quantity) VALUES ('$foodName', '$foodPrice','$foodQty')";
            $queryInsertedFood = mysqli_query($conn, $queryInsertFood);
    }    
    header("Location: cart.php");

    }

}

if(isset($_GET['removeFromCart'])) {

    $hey = $_GET['removeFromCart'];

    $queryDeleteFromDB = ("DELETE FROM tblCart WHERE orderID = '$hey'");
    $queryDagan = mysqli_query($conn, $queryDeleteFromDB);
    header("Location: cart.php");

}

if(isset($_POST['btnShipping'])) {

    mysqli_query($conn,"DELETE FROM tblCart");
    header("Location: index.php");

}

if(isset($_POST['deleteAcc'])) {

    $email = $_SESSION['email'];
    mysqli_query($conn, "DELETE FROM tblAccounts WHERE email = '$email'");
    session_destroy();
    header("Location: login.php");

}

if(isset($_POST['editAcc'])) {

    $sessionEmail = $_SESSION['email'];
    $fname = $_POST['firstNameEdit'];
    $lname = $_POST['lastNameEdit'];
    $email = $_POST['emailEdit'];
    $pass = $_POST['password2'];
    echo $sessionEmail;
    $query = "UPDATE tblAccounts SET firstName = '$fname', lastName = '$lname', email = '$email', password = '$pass' WHERE email ='$sessionEmail'";
    mysqli_query($conn, $query);
    $_SESSION['email'] = $email;
    header("Location: myAccount.php");
}

if(isset($_GET['createCategory'])) {

    $newCategory = $_GET['newCategory'];
    mysqli_query($conn,"INSERT INTO tblCategory (categoryName) VALUES ('$newCategory')");
    header("Location: myAccount.php");

}
