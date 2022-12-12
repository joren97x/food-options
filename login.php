<?php
require "conn.php";
    session_start();

    if (isset($_SESSION['email'])) {

        header("Location: index.php");

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log In - Food Options</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
</head>
<body>

        <?php
            include "header.php";
        ?>

        <div class="container">

        <?php

if(isset($_GET['btnSearch'])) {

    $foodSearched = strtolower($_GET['btnSearch']);

    $food = mysqli_query($conn, "SELECT * FROM tblProducts WHERE productName = '$foodSearched'");
    if(mysqli_num_rows($food)> 0) {

        foreach($food as $product) {
            require "showProduct.php";
        }

    }
    else {
        echo "<p class='display-6 text-center'>NO PRODUCT FOUND </p>";
    }

}
else {
                if(isset($_GET['btnCategory'])) {

                    echo "<div class='row'>";

                    $categoryID = $_GET['btnCategory'];
                    $query = "SELECT * FROM tblProducts WHERE categoryID ='$categoryID'";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        
                        foreach($result as $product) {
                            require "showProduct.php";
                        }

                    }
                    else {
                        echo "<p class='display-6 text-center'>NO PRODUCT FOUND </p>";
                    }                            
                }
                else {
                        ?>

<form action="functions.php" method="POST" class="text-success">
                 <p class="display-6 fw-bold">Log In</p>
                <div class="form-group w-50" id="input">
                    <input type="text" placeholder="Email" id="email" name="email"  class="form-control my-3" style="background-color: #f4f4f4";>
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control my-3 " style="background-color: #f4f4f4";><input type="checkbox" onclick="showPass()"> Show password
                    <input type="submit" id="logIn" name="logIn"  value="SIGN IN" class="form-control text-white bg-success">
                </div>
            </form>
                    <a href="create.php" class="text-success " style="text-decoration: none;"><p class="my-3" > Create Account</p> </a>
                    <a href="forgotPassword.php" class="text-success " style="text-decoration: none;"><p class="mb-5" > Forgot Password?</p>  </a>

                    <?php
                    }

                }
        ?>

            

            <hr>

            <?php include "footer.php"; ?>  

        </div>
    
</body>
</html>

<script>
    function showPass(){
        var pass = document.getElementById("password");
        if (pass.type === "password") {
            pass.type = "text";
        }
        else {
            pass.type = "password";
        }

    }

    

</script>