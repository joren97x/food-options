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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    <style>
        input .qty{
            width: 60px;
        }
    </style>
</head>
<body>

        <div class="container">
            <div class="row mt-3 text-success">
                <div class="col-2 text-start" >
                    <a href="create.php" class="text-success" style="text-decoration: none;"><?php if (!isset($_SESSION['email'])) { echo "<a href='login.php' class='text-success' style='text-decoration: none;'><i class='bi bi-box-arrow-in-right'></i> Log In</a>";} else {echo "<a href='myAccount.php' class='text-success' style='text-decoration: none;'><i class='bi bi-person-circle'></i> My Account</a>";}  ?></a>
                </div>
                <div class="col-2 text-start" >
                <?php if (!isset($_SESSION['email'])) { echo "<a href='create.php' class='text-success' style='text-decoration: none;'><i class='bi bi-person-add'></i> Create Account</a>";} else {echo "<a href='logOut.php' class='text-success' style='text-decoration: none;'> <i class='bi bi-box-arrow-right'></i> Log Out</a>";}  ?>

                </div>
                <div class="col-7 text-center">
                <form method="GET">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search for a food here" style="border: 0" name="btnSearch" id="btnSearch">
                    </form>
                </div>
                <div class="col-1">
                    <i class="bi bi-cart3"></i>
                    <a href='cart.php' class='text-success' style='text-decoration: none;'> Cart</a>
                </div>
                <hr class="mt-3">
            </div>

            <div class="row">
                <div class="col display-4 text-center justify-content-center text-success">
                    <a href="index.php" class="text-success " style="text-decoration: none;">Food <i class="bi bi-egg"></i>ptions</a>
                </div>
            </div>

            <div class="row bg-success mt-3 text-center p-2">

            <?php

                $query = "SELECT * FROM tblCategory";
                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) > 0) {

                    foreach($result as $category) {

            ?>

                <div class="col">
                        <form action="" method="GET">
                            <a href="functions.php"><button class=" btn btn-success " name="btnCategory" id="btnCategory" value="<?php echo $category['id']; ?>" ><?php  echo $category['categoryName']; ?></button></a>
                        </form>
                </div>
                        

            <?php

                    }

                }

            ?>
            </div>
            <hr>

            <?php

if(isset($_GET['btnSearch'])) {

    $foodSearched = $_GET['btnSearch'];

    $food = mysqli_query($conn, "SELECT * FROM tblProducts WHERE productName = '$foodSearched'");
    if(mysqli_num_rows($food)> 0) {

        foreach($food as $product) {

            ?>

<div class="col-4 text-success text-center ">
    <div class="card " style="width: 300px;">
    <img class="card-img-top m-5" src="img/egg.png" alt="Card image cap" style="width: 250px;">
        <div class="card-body">
            
        <form action="functions.php" action="get">
                <button class="btn btn-success"  value="<?php echo $product['id'] ?>"  id="addToCart" name="addToCart" >Add to Cart</button>
                <h5 class="card-title"><?php echo $product['productName']; ?></h5>
                <p class="card-text"><?php echo "₱".$product['price']; ?></p>
                <input type="hidden" value="<?php echo $_SESSION['id']; ?>"name="userId" id="userId">
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
                    <img class="card-img-top m-5" src="img/egg.png" alt="Card image cap" style="width: 250px;">
                        <div class="card-body">
                            
                        <form action="functions.php" action="get">
                                <button class="btn btn-success"  value="<?php echo $product['id'] ?>"  id="addToCart" name="addToCart" >Add to Cart</button>
                                <h5 class="card-title"><?php echo $product['productName']; ?></h5>
                                <p class="card-text"><?php echo "₱".$product['price']; ?></p>
                                <input type="hidden" value="<?php echo $_SESSION['id']; ?>"name="userId" id="userId">
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
                            <th >Product</th>
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
                            <td ><img src="img/egg.png"><?php echo $food['productName']; ?> <br> <form action="functions.php" method="GET">
                                <button class="btn btn-border btn-danger mx-5 mt-2" value="<?php echo $food['orderID']; ?>" id="removeFromCart" name="removeFromCart">REMOVE</button>
                            </form> </td>
                            <td ><?php echo "₱".$food['price']; ?> </td>
                            <td><input type="number" onchange name="qty" id="qty<?php echo $food['orderID']; ?>" value="<?php echo $food['quantity']; ?>" ></td>
                            <td><?php echo "₱".$food['price'] * $food['quantity']; ?></td>
                        </tr>
                        <script>
                        
                        qty<?php echo $food['orderID']; ?>.oninput = function () {
                            btnCheckOut.value = qty<?php echo $food['orderID']; ?>.value;
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
                            <button class=" btn btn-success" name="btnCheckOut" id="btnCheckOut" onclick="change()" value="1">Check Out</button>
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

            <div class="footer py-3 text-success">

                <div class="row fw-bold my-4">
                    <div class="col">Account</div>
                    <div class="col">Links</div>
                    <div class="col">Follow Us</div>
                </div>
                <div class="row">
                    <div class="col"><a href='create.php' class='text-success' style='text-decoration: none;'>Create Account</a></div>
                    <div class="col"><a href='aboutUs.php' class='text-success' style='text-decoration: none;'>About Us</a></div>
                    <div class="col"><i class="bi bi-instagram"></i> Instagram</div>
                </div>
                <div class="row">
                    <div class="col"><a href='myAccount.php' class='text-success' style='text-decoration: none;'>My Account</a></div>
                    <div class="col">Privacy Policy</div>
                    <div class="col"><i class="bi bi-facebook"></i> Facebook</div>
                </div>
                <div class="row">
                    <div class="col"><a href='logIn.php' class='text-success' style='text-decoration: none;'>Log In</a></div>
                    <div class="col">Hello</div>
                    <div class="col"><i class="bi bi-youtube"></i> Youtube</div>
                </div>

            </div>

            <hr>

            <div class="row p-3 text-success">
                Copyright © 2022, Food Options.
            </div>

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