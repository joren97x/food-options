<?php
    require "conn.php";
    session_start();

    if(isset($_SESSION['email'])) {

        header("Location: index.php");

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Account - Food Options</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
</head>
<body>

        <?php include "header.php"; ?>

        <div class="container">

        <?php

            if(isset($_GET['btnSearch'])) {

                $foodSearched = strtolower($_GET['btnSearch']);

                $food = mysqli_query($conn, "SELECT * FROM tblProducts WHERE productName = '$foodSearched'");
                if(mysqli_num_rows($food)> 0) {

                    foreach($food as $product) {

                        ?>

            <div class="col-4 text-success text-center ">
                <div class="card " style="width: 300px;">
                <img class="card-img-top m-5" src="img/<?php echo $product['imageName'] ?>" alt="Card image cap" style="width: 250px; height: 250px">
                    <div class="card-body">
                        
                    <form action="functions.php" action="get">
                            <button class="btn btn-success"  value="<?php echo $product['id'] ?>"  id="addToCart" name="addToCart" >Add to Cart</button>
                            <h5 class="card-title"><?php echo $product['productName']; ?></h5>
                            <p class="card-text"><?php echo "₱".$product['price']; ?></p>
                            <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="userId" id="userId">
                            <input type="hidden" value="<?php echo $product['imageName'] ?>" name="imageName" id="imageName">
                        </form>
                            
                    </div>
                </div>
            </div>

                        <?php

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
                            ?>
                <div class="col-4 text-success text-center ">
                    <div class="card " style="width: 300px;">
                    <img class="card-img-top m-5" src="img/<?php echo $product['imageName'] ?>" alt="Card image cap" style="width: 250px; height: 250px">
                        <div class="card-body">
                            
                        <form action="functions.php" action="get">
                                <button class="btn btn-success"  value="<?php echo $product['id'] ?>"  id="addToCart" name="addToCart" >Add to Cart</button>
                                <h5 class="card-title"><?php echo $product['productName']; ?></h5>
                                <p class="card-text"><?php echo "₱".$product['price']; ?></p>
                                <input type="hidden" value="<?php echo $_SESSION['id']; ?>"name="userId" id="userId">
                                <input type="hidden" value="<?php echo $product['imageName'] ?>" name="imageName" id="imageName">
                            </form>
                                
                        </div>
                    </div>
                </div>
                            <?php

                        }

                    }
                    else {

                        echo "<p class='display-6 text-center'>NO PRODUCT FOUND </p>";

                    }                            
                    }
                    else {
                        ?>

            <form action="functions.php" method="POST" class="text-success">
                <p class="display-6 fw-bold">Create Account</p>
                <p>Welcome to Food Options! If you're new to our online store, please create a new account.</p>
                
                <div class="form-group w-50" >
                    <input type="text" placeholder="First Name" id="firstName" name="firstName"  class="form-control my-3" style="background-color: #f4f4f4";>
                    <input type="text" placeholder="Last Name" id="lastName" name="lastName"  class="form-control my-3" style="background-color: #f4f4f4";>
                    <input type="text" placeholder="Email" id="email" name="email"  class="form-control my-3 " style="background-color: #f4f4f4";>
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control mt-3 " style="background-color: #f4f4f4";><input type="checkbox" onclick="showPass()"> Show password
                    <input type="submit" id="createUser" name="createUser"  value="CREATE" class="form-control text-white bg-success mt-3">
                    <input type="submit" id="createAdmin" name="createAdmin"  value="CREATE ADMIN" class="form-control text-white bg-danger mt-3">
                </div>

            </form>
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