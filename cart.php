<?php
    require "conn.php";
    session_start();

    if(!isset($_SESSION['email'])) {

        header("Location: login.php");

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cart - Food Options</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    <style>
        input .qty {
            width: 60px;
        }
    </style>
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

                    <div class="col-3 mt-3 text-success text-center">
                            <div class="card" style="width: 200px;">
                            <img class="card-img-top rounded " src="img/<?php echo $product['imageName'] ?>" alt="Card image cap" style="width: 150px; height: 150px; margin-left: 25px; margin-top: 20px;">

                <div class="card-body">

                    <form action="functions.php" action="get">
                        <button class="btn btn-success" value="<?php echo $product['id'] ?>" id="addToCart"
                            name="addToCart">Add to Cart</button>
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
            <div class="col-3 mt-3 text-success text-center">
                            <div class="card" style="width: 200px;">
                            <img class="card-img-top rounded " src="img/<?php echo $product['imageName'] ?>" alt="Card image cap" style="width: 150px; height: 150px; margin-left: 25px; margin-top: 20px;">

                    <div class="card-body">

                        <form action="functions.php" action="get">
                            <button class="btn btn-success" value="<?php echo $product['id'] ?>" id="addToCart"
                                name="addToCart">Add to Cart</button>
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
                        ?>
        
        <div class="container">

<form action="checkOut.php">
        <table class="table table-bordered bg-light  text-success align-middle">
            <tr class="text-center">
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>

            <?php

                   
                    $userID = $_SESSION['id'];
                    $queryGetFoodFromCartTable = "SELECT * FROM tblcart WHERE userID ='$userID'";
                    $queryFoodFromCart = mysqli_query($conn, $queryGetFoodFromCartTable);

                    if(mysqli_num_rows($queryFoodFromCart)> 0) {

                        foreach($queryFoodFromCart as $food) {

                            ?>

            <tr>
                
                <td><img src="img/<?php echo $food['imageName'] ?>" style="width: 100px; height: 100px;"><?php echo $food['productName']; ?> <br>
                    
                </td>
                <td class="text-center"><?php echo "₱".$food['price']; ?> </td>
                <td class="d-flex justify-content-center mt-4"><input class="form-control w-25" type="number" name="quantity<?php echo $food['id']; ?>" value="<?php echo $food['quantity']; ?>"></td>
                <td><button class="btn btn-border btn-danger mx-5 mt-2" value="<?php echo $food['id']; ?>"
                            id="removeFromCart" name="removeFromCart">REMOVE</button></td>
            </tr>
            
            <?php
                        }

                    }
                    else {
                        
                        echo "<tr><td class='text-center' colspan='12'>Your cart is currently empty.</td></tr>";
                    }
                    

                ?>

        </table>

        <?php
                    }

        ?>

        <?php
                    $userID = $_SESSION['id'];
                    $queryGetFoodFromCartTable = "SELECT * FROM tblcart WHERE userID = '$userID'";
                    $queryFoodFromCart = mysqli_query($conn, $queryGetFoodFromCartTable);

                    if(mysqli_num_rows($queryFoodFromCart)> 0) {
                ?>

            <div class="row">
                <div class="col-lg-12 d-flex justify-content-end">
                        <button class=" btn btn-success" name="btnCheckOut" id="btnCheckOut" >Check Out</button>
                </div>
            </div>
        <?php
                    }
                    ?>
                    </form>
                    </div>
                    <?php
                }
                ?>
        


    </div>

    <div class="container">

        <hr>

        <?php include "footer.php"; ?>

    </div>

</body>

</html>
