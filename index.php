<?php
    session_start();
    ob_start();
    require "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home - Food Options</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
</head>
<body>

        <div class="container">

            <div class="row  mt-3 text-success" >
                <div class="col-2" >
                    <?php if (!isset($_SESSION['email'])) { echo "<a href='login.php' class='text-success' style='text-decoration: none;'><i class='bi bi-box-arrow-in-right'></i> Log In</a>";} else {echo "<a href='myAccount.php' class='text-success' style='text-decoration: none;'><i class='bi bi-person-circle'></i> My Account</a>";}  ?>
                </div>
                <div class="col-2" >
                    <?php if (!isset($_SESSION['email'] )) { echo "<a href='create.php' class='text-success' style='text-decoration: none;'><i class='bi bi-person-add'></i> Create Account</a>";} else {echo "<a href='logOut.php' class='text-success' style='text-decoration: none;'> <i class='bi bi-box-arrow-right'></i> Log Out</a>";} ?>
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
                            <button class=" btn btn-success " name="btnCategory" id="btnCategory" value="<?php echo $category['id']; ?>" ><?php  echo $category['categoryName']; ?></button>
                        </form>
                </div>
            <?php

                    }
                }
            ?>
            </div>

            <hr>

        </div>

        <div class="container">

            <div class="row  p-5 text-center text-success" style="background-image: url(img/1.png); ">
                <div class="col display-3 fw-bold text-uppercase">
                    <p id="Category">
                        <?php
                        if(isset($_GET['btnCategory'])) {

                            $categoryID = $_GET['btnCategory'];
                            $query = "SELECT * FROM tblCategory WHERE id ='$categoryID'";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                $categoryName = mysqli_fetch_array($result);
                                echo $categoryName['categoryName'];
                            }                            
                        }
                        else {
                            echo "Welcome";
                        }
                        ?>
                    </p>
                </div>
                <div class="row h3 mt-3">
                    <div class="col">
                        Food <i class="bi bi-egg"></i>ptions
                    </div>
                </div>
            </div>


            <!-- MGA BALIGYA -->

            <div class="container mt-5">
                
                <div class="row">

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
                                        <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="userId" id="userId">
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

                            $query = "SELECT * FROM tblProducts ";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                
                                foreach($result as $product) {
                                    ?>
                        <div class="col text-success text-center">
                            <div class="card" style="width: 300px;">
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
                                        
                                        

                        }
                    }
                        ?>
                </div>    

            </div>

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



