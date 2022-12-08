<?php
session_start();
require "conn.php";

if (isset($_POST['createUser'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = "user";

    mysqli_query($conn, "INSERT INTO tblAccounts (firstName, lastName, email, password, userType) 
    VALUES ('$firstName', '$lastName', '$email', '$password', '$userType')");

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['userType'] = $userType;

    $getId = mysqli_query($conn, "SELECT * FROM tblAccounts WHERE email = '$email'");
    $resultOfGetId = mysqli_fetch_array($getId);
    $_SESSION['id'] = $resultOfGetId['id'];

    header("Location: index.php");
}

if (isset($_POST['createAdmin'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = "admin";
    
    mysqli_query($conn,"INSERT INTO tblAccounts (firstName, lastName, email, password, userType) 
    VALUES ('$firstName', '$lastName', '$email', '$password', '$userType')");

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['userType'] = $userType;

    $getId = mysqli_query($conn, "SELECT * FROM tblAccounts WHERE email = '$email'");
    $resultOfGetId = mysqli_fetch_array($getId);
    $_SESSION['id'] = $resultOfGetId['id'];
    
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
        $_SESSION['id'] = $row['id'];
        
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

    $userId = $_GET['userId'];
    $foodId = $_GET['addToCart'];
    $imageName = $_GET['imageName'];
    $queryGetFood = "SELECT * FROM tblproducts WHERE id='$foodId'";
    $queryResultFood = mysqli_query($conn, $queryGetFood);
    echo $foodId;
    echo $imageName;

    if(mysqli_num_rows($queryResultFood)> 0) {

        $food = mysqli_fetch_array($queryResultFood);

            $foodName = $food['productName'];
            $foodPrice = $food['price'];
            $foodQty = $food['quantity'];
            $queryInsertFood = mysqli_query($conn, "INSERT INTO tblCart (productName, imageName, price, quantity, userID) VALUES ('$foodName', '$imageName', '$foodPrice','$foodQty', '$userId')");
           
        }    
    }
    header("Location: cart.php");

}

if(isset($_GET['addProduct'])) {
    $categoryID = $_GET['category'];
    $imageName = $_GET['image'];
    $productName = $_GET['productName'];
    $price = $_GET['price'];
    $qty = 1;
    
    mysqli_query($conn, "INSERT INTO tblProducts (productName, imageName, price, quantity, categoryID) VALUES ('$productName', '$imageName', '$price', '$qty', '$categoryID')");
    header("Location: myAccount.php");

}

if(isset($_GET['deleteHistory'])) {

    $orderID = $_GET['deleteHistory'];
    mysqli_query($conn, "DELETE FROM tblOrderHistory WHERE id='$orderID'");
    header("Location: myAccount.php");

}

if(isset($_POST['btnShipping'])) {

    $userID = $_SESSION['id'];
    $date = $_POST['btnShipping'];
    $total = $_POST['total'];
    $foodFromCart = mysqli_query($conn, "SELECT * FROM tblcart WHERE userID = '$userID'");

    if(mysqli_num_rows($foodFromCart) > 0) {
        foreach($foodFromCart as $food) {
            $productName =  $food['productName'];
            mysqli_query($conn, "INSERT INTO tblOrderHistory (userID, productName, total, date) VALUES ('$userID', '$productName', '$total', '$date')");
        }
    }
    mysqli_query($conn,"DELETE FROM tblCart WHERE userID = '$userID'");
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
    echo $newCategory;
    echo "ih";
    mysqli_query($conn,"INSERT INTO tblCategory (categoryName) VALUES ('$newCategory')");
    header("Location: myAccount.php");

}

if(isset($_GET['deleteCategory'])) {

    $deleteCategory = $_GET['deleteCate'];
    mysqli_query($conn, "DELETE FROM tblCategory WHERE id = '$deleteCategory'");
    header("Location: myAccount.php");

}

if(isset($_GET['editCategory'])) {

    $IDcategory = $_GET['editCate'];
    $newCateName = $_GET['newCategory2'];

    mysqli_query($conn, "UPDATE tblCategory SET categoryName = '$newCateName' WHERE id='$IDcategory'");
    header("Location: myAccount.php");

}

if(isset($_GET['editProduct'])) {

    $IDfood = $_GET['food'];
    $newImg = $_GET['image2'];
    $newName = $_GET['productName2'];
    $newPrice = $_GET['price2'];
    $quantity = 1;
    $newCategoryID = $_GET['newCategoryEdit'];

    mysqli_query($conn, "UPDATE tblProducts SET productName = '$newName', imageName ='$newImg', price ='$newPrice', quantity = '$quantity', categoryID ='$newCategoryID' WHERE id = '$IDfood'");
    header("Location: myAccount.php");
}

if(isset($_GET['deleteProduct'])) {

    $productId = $_GET['deleteProd'];
    mysqli_query($conn, "DELETE FROM tblProducts WHERE id='$productId'");
    header("Location: myAccount.php");

}