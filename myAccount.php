<?php
    session_start();
    require "conn.php";

    if(!isset($_SESSION['email'])) {

        header("Location: login.php");

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Account - Food Options</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
</head>

<body>

    <div class="container">
        <div class="row mt-3 text-success">
            <div class="col-2 text-start">
                <?php if (!isset($_SESSION['email'])) { echo "<a href='login.php' class='text-success' style='text-decoration: none;'><i class='bi bi-box-arrow-in-right'></i> Log In</a>";} else {echo "<a href='myAccount.php' class='text-success' style='text-decoration: none;'><i class='bi bi-person-circle'></i> My Account</a>";}  ?>
            </div>
            <div class="col-2 text-start">
                <?php if (!isset($_SESSION['email'])) { echo "<a href='create.php' class='text-success' style='text-decoration: none;'><i class='bi bi-person-add'></i> Create Account</a>";} else {echo "<a href='logOut.php' class='text-success' style='text-decoration: none;'><i class='bi bi-box-arrow-right'></i> Log Out</a>";} ?>
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
                <a href="index.php" class="text-success " style="text-decoration: none;">Food <i
                        class="bi bi-egg"></i>ptions</a>

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
                    <a href="functions.php"><button class=" btn btn-success " name="btnCategory" id="btnCategory"
                            value="<?php echo $category['id']; ?>"><?php  echo $category['categoryName']; ?></button></a>
                </form>
            </div>
            <?php

                    }
                }

                ?>
        </div>

        <hr>

    </div>

    <div class="container text-success">

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
                        <button class="btn btn-success" value="<?php echo $product['id'] ?>" id="addToCart"
                            name="addToCart">Add to Cart</button>
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
                    echo "<hr class='mt-3'>";                       
                    }
                    else {
                        ?>

        <p class="display-6 fw-bold">My Account <?php if($_SESSION['userType'] == "admin") { echo "<span class='text-danger'>(admin)</span>"; } ?></p>

        <?php 

            if($_SESSION['userType'] == "admin") {

                ?>
        <p class="h4 fw-bold">Actions</p>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Category Settings
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Category Settings</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="functions.php">
                    <div class="container ml-5">
                        <h1 class="modal-title fs-5 ml-5" id="exampleModalLabel">Edit Category</h1>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="newCategory" name="newCategory" placeholder="Category Name"
                                class="form-control  " style="background-color: #f4f4f4" ;>
                                <div class="col d-flex justify-content-end">
                                <input type="submit" name="createCategory" id="createCategory" value="Create Category"
                                class="btn btn-success mt-2 "> </div>
                        </div>
                       
                        <div class="container ml-5">
                        <h1 class="modal-title fs-5 ml-5" id="exampleModalLabel">Edit Category</h1>

                        </div>
                        
                        <div class="modal-body">
                            <div class="dropdown">
                                <select class="form-select">

                                <?php
                                $query = "SELECT * FROM tblCategory";
                                $result = mysqli_query($conn, $query);

                                if(mysqli_num_rows($result) > 0) {

                                    foreach($result as $category) {

                                ?>
                                    <li><option value="<?php echo $category['id']; ?>"><?php echo $category['categoryName']; ?></option></li>
                                <?php
                                    }
                                }
                                ?>
                                </select>
                                <input type="text" id="newCategory" name="newCategory" placeholder="New Category Name"
                                class="form-control mt-2 " style="background-color: #f4f4f4 " ;>
                                <div class="col d-flex justify-content-end">
                                <input type="submit" name="editCategory" id="editCategory" value="Save Changes"
                                class="btn btn-success  mt-2  "></div>
                               
                            </div>
                        </div>
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Category</h1>
                        </div>
                        <div class="modal-body">
                                <select class="form-select">

                                <?php
                                $query = "SELECT * FROM tblCategory";
                                $result = mysqli_query($conn, $query);

                                if(mysqli_num_rows($result) > 0) {

                                    foreach($result as $category) {

                                ?>
                                    <li><option value="<?php echo $category['id']; ?>"><?php echo $category['categoryName']; ?></option></li>
                                <?php
                                    }
                                }
                                ?>
                                </select>
                                <div class="col d-flex justify-content-end">
                                <input type="submit" name="deleteCategory" id="deleteCategory" value="Delete Category"
                                class="btn btn-danger  mt-2 "> </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
            }
       

            ?>

        <p class="h4 fw-bold">Order History</p>

       
            <?php
                $userID = $_SESSION['id'];
                $orderHistory = mysqli_query($conn, "SELECT * FROM tblOrderHistory WHERE userId = '$userID'");
                if(mysqli_num_rows($orderHistory)> 0) {

                    ?>

                    <table class="table w-75  table-light table-bordered  text-center">
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    foreach($orderHistory as $order) {

                        ?>

                        
                            <tr>
                                <td><?php echo $order['id'] ?></td>
                                <td><?php echo $order['productName'] ?></td>
                                <td><?php echo $order['total'] ?></td>
                                <td><?php echo $order['date'] ?></td>
                                <td> <form action="functions.php"><button class="text-danger" style="border: 0" value="<?php echo $order['id']; ?>" name="deleteHistory" id="deleteHistory" ><i class="bi bi-trash"></i></button> </form></td>
                            </tr>
                        

                        <?php

                    }
                    ?>
                    </table>

                    <?php

                }
                else {

                    echo "<div class='container h6 fw-normal'>You haven't placed any orders yet.</div>";

                }

            ?>

        <br>

        <p class="h4 fw-bold">Account Details</p>
        <?php

            require "conn.php";

            $email = $_SESSION['email'];
            $query = "SELECT * FROM tblAccounts WHERE email = '$email'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {

                $account = mysqli_fetch_array($result);
            ?>

        <div class="container">

            <form action="functions.php" method="POST">

                <span class='h5'>Name:
                    <?php $fullName = $account['firstName']." ".$account['lastName']; echo "<span class='fw-normal'>$fullName</span>" ?>
                </span>
                <br>
                <span class='h5'>Email:
                    <?php  $email = $account['email']; echo"<span class='fw-normal'>$email</span>" ?></span>
                <br>
                <span class='h5'>Password:
                    <?php $pass = $account['password'];  echo "<input type='password' class='text-success' id='password' style='border: 0;' value='$pass'>"; ?>
                </span> <br> <input type="checkbox" onclick="showPass()"> Show password
                <br>
                <!-- EDIT MODAL -->
                <input type="button" value="EDIT" class="btn btn-success w-25 mt-3" data-bs-toggle="modal"
                    data-bs-target="#editAccount">
                <!-- Modal -->
                <div class="modal fade" id="editAccount" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog text-dark">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Account</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group ">
                                    <input type="text" placeholder="First Name" id="firstNameEdit" name="firstNameEdit"
                                        class="form-control my-3" style="background-color: #f4f4f4" ;>
                                    <input type="text" placeholder="Last Name" id="lastNameEdit" name="lastNameEdit"
                                        class="form-control my-3" style="background-color: #f4f4f4" ;>
                                    <input type="text" placeholder="Email" id="emailEdit" name="emailEdit"
                                        class="form-control my-3 " style="background-color: #f4f4f4" ;>
                                    <input type="password" id="password2" name="password2" placeholder="Password"
                                        class="form-control  " style="background-color: #f4f4f4" ;><input
                                        type="checkbox" onclick="showPass2()"> Show password
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="editAcc" id="editAcc" value="Save Changes"
                                    class="btn btn-success w-25 ">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DELETE MODAL -->
                <input type="button" value="DELETE" class="btn btn-danger w-25 mt-3" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark" id="exampleModalLabel">Delete Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-dark">
                                Are you sure you want to delete your account?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                <input type="submit" name="deleteAcc" id="deleteAcc" value="YES"
                                    class="btn btn-success w-25 ">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <hr>
        <?php
            }
                ?>
        <?php
                    }
                }

        ?>


        <div class="footer py-3 text-success">

            <div class="row fw-bold my-4">
                <div class="col">Account</div>
                <div class="col">Links</div>
                <div class="col">Follow Us</div>
            </div>
            <div class="row">
                <div class="col"><a href='create.php' class='text-success' style='text-decoration: none;'>Create
                        Account</a></div>
                <div class="col"><a href='aboutUs.php' class='text-success' style='text-decoration: none;'>About Us</a>
                </div>
                <div class="col"><i class="bi bi-instagram"></i> Instagram</div>
            </div>
            <div class="row">
                <div class="col"><a href='myAccount.php' class='text-success' style='text-decoration: none;'>My
                        Account</a></div>
                <div class="col">Privacy Policy</div>
                <div class="col"><i class="bi bi-facebook"></i> Facebook</div>
            </div>
            <div class="row">
                <div class="col"><a href='logIn.php' class='text-success' style='text-decoration: none;'>Log In</a>
                </div>
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
    function showPass() {
        var pass = document.getElementById("password");
        if (pass.type === "password") {
            pass.type = "text";
        } else {
            pass.type = "password";
        }

    }

    function showPass2() {
        var pass = document.getElementById("password2");
        if (pass.type === "password") {
            pass.type = "text";
        } else {
            pass.type = "password";
        }

    }
</script>