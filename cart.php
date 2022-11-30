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

                    $foodSearched = $_GET['btnSearch'];

                    $food = mysqli_query($conn, "SELECT * FROM tblProducts WHERE productName = '$foodSearched'");
                    if(mysqli_num_rows($food)> 0) {

                        foreach($food as $product) {

                            ?>

        <div class="col-4 text-success text-center ">
            <div class="card " style="width: 300px;">
                <img class="card-img-top m-5" src="img/<?php echo $product['imageName'] ?>" alt="Card image cap" style="width: 250px; height: 250px">
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
        <div class="col-4 text-success text-center ">
            <div class="card " style="width: 300px;">
                <img class="card-img-top m-5" src="img/<?php echo $product['imageName'] ?>" alt="Card image cap" style="width: 250px; height: 250px">
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
        <table class="table table-bordered table-white  text-success align-middle">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
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
                    <form action="functions.php" method="GET">
                        <button class="btn btn-border btn-danger mx-5 mt-2" value="<?php echo $food['id']; ?>"
                            id="removeFromCart" name="removeFromCart">REMOVE</button>
                    </form>
                </td>
                <td><?php echo "₱".$food['price']; ?> </td>
                <td><input type="number" onchange="myFunctionTotal()" name="qty" id="qty<?php echo $food['id']; ?>"
                        value="<?php echo $food['quantity']; ?>"></td>
                <td id="tootal"><?php echo "₱".$food['price']; ?></td>
            </tr>
            <script>

                function myFunctionTotal(){
                    var qtyyy = document.getElementById("qty<?php echo $food['id']; ?>").value;
                    document.getElementById("tootal").innerHTML = "<?php echo "₱".$food['price']*$food['quantity']; ?>";
                }

            </script>
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
            <div class="col-12 d-flex justify-content-end">
                <form action="checkOut.php" method="get">
                    <button class=" btn btn-success" name="btnCheckOut" id="btnCheckOut" onclick="change()"
                        value="1">Check Out</button>
                </form>
            </div>
        </div>
        <?php
                    }
                }
                ?>

    </div>

    <div class="container">

        <hr>

        <?php include "footer.php"; ?>

    </div>

</body>

</html>

<script>
    function showPass() {
        var pass = document.getElementById("password");
        if (pass.type === "password") {
            pass.type = "text";
        } else {
            pass.type = "password";
        }

    }
</script>