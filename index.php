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

        <?php include "header.php"; ?>

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
                            <img class="card-img-top m-5" src="img/<?php echo $product['imageName'] ?>" alt="Card image cap" style="width: 250px; height: 250px" >
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

                            $query = "SELECT * FROM tblProducts ";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                
                                foreach($result as $product) {
                                    ?>
                        <div class="col text-success text-center">
                            <div class="card" style="width: 300px;">
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
                                        
                                        

                        }
                    }
                        ?>
                </div>    

            </div>

            <hr>

                  <?php include "footer.php"; ?>  

        </div>
    
</body>
</html>



