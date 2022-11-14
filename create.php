<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Food Options</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
</head>
<body>

        <div class="container">
            <div class="row  mt-3 text-success">
                <div class="col-2" >
                    <?php if (!isset($_SESSION['email'])) { echo "<a href='login.php' class='text-success' style='text-decoration: none;'><i class='bi bi-box-arrow-in-right'></i> Log In</a>";} else {echo "<a href='myAccount.php' class='text-success' style='text-decoration: none;'><i class='bi bi-person-circle'></i> My Account</a>";}  ?>
                </div>
                <div class="col-2" >
                     <?php if (!isset($_SESSION['email'])) { echo "<a href='create.php' class='text-success' style='text-decoration: none;'><i class='bi bi-person-add'></i> Create Account</a>";} else {echo "<a href='logOut.php' class='text-success' style='text-decoration: none;'> <i class='bi bi-box-arrow-right'></i> Log Out</a>";} ?>
                </div>
                <div class="col-7 text-center">
                    <i class="bi bi-search"></i>
                    Search for a food here
                </div>
                <div class="col-1">
                    <i class="bi bi-cart3"></i>
                    Cart
                </div>
                <hr class="mt-3">
            </div>

            <div class="row">
                <div class="col display-4 text-center justify-content-center text-success">
                <a href="index.php" class="text-success " style="text-decoration: none;">Food <i class="bi bi-egg"></i>ptions</a>

                </div>
            </div>

            <div class="row bg-success mt-3 text-center p-2">
                <div class="col">
                    <div class="dropdown">
                        <button class=" btn btn-success dropdown-toggle"  data-bs-toggle="dropdown" >Eggs</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Small Eggs</a> 
                            <a class="dropdown-item" href="">Medium Eggs</a>
                            <a class="dropdown-item" href="">Big Eggs</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="dropdown">
                        <button class=" btn btn-success dropdown-toggle"  data-bs-toggle="dropdown" >Fruits</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Apple</a>
                            <a class="dropdown-item" href="">Avocado</a>
                            <a class="dropdown-item" href="">Coconut</a>
                            <a class="dropdown-item" href="">Grapes</a>
                            <a class="dropdown-item" href="">Pineapple</a>
                            <a class="dropdown-item" href="">Papaya</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="dropdown">
                        <button class=" btn btn-success dropdown-toggle"  data-bs-toggle="dropdown" >Vegetables</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Small Eggs</a>
                            <a class="dropdown-item" href="">Medium Eggs</a>
                            <a class="dropdown-item" href="">Big Eggs</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="dropdown">
                        <button class=" btn btn-success dropdown-toggle"  data-bs-toggle="dropdown" >Meat</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Small Eggs</a>
                            <a class="dropdown-item" href="">Medium Eggs</a>
                            <a class="dropdown-item" href="">Big Eggs</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="dropdown">
                        <button class=" btn btn-success dropdown-toggle"  data-bs-toggle="dropdown" >Seafood</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Small Eggs</a>
                            <a class="dropdown-item" href="">Medium Eggs</a>
                            <a class="dropdown-item" href="">Big Eggs</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="dropdown">
                        <button class=" btn btn-success dropdown-toggle"  data-bs-toggle="dropdown" >Fast Food</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Small Eggs</a>
                            <a class="dropdown-item" href="">Medium Eggs</a>
                            <a class="dropdown-item" href="">Big Eggs</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="dropdown">
                        <button class=" btn btn-success dropdown-toggle"  data-bs-toggle="dropdown" >Bread</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Small Eggs</a>
                            <a class="dropdown-item" href="">Medium Eggs</a>
                            <a class="dropdown-item" href="">Big Eggs</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="dropdown">
                        <button class=" btn btn-success dropdown-toggle"  data-bs-toggle="dropdown" >Herbs & Spices</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Small Eggs</a>
                            <a class="dropdown-item" href="">Medium Eggs</a>
                            <a class="dropdown-item" href="">Big Eggs</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="dropdown">
                        <button class=" btn btn-success dropdown-toggle"  data-bs-toggle="dropdown" >Drinks</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Small Eggs</a>
                            <a class="dropdown-item" href="">Medium Eggs</a>
                            <a class="dropdown-item" href="">Big Eggs</a>
                        </div>
                    </div>
                </div>

            </div>

            <hr>

        </div>

        <div class="container">

            <form action="functions.php" method="POST" class="text-success">
                <p class="display-6 fw-bold">Create Account</p>
                <p>Welcome to Food Options! If you're new to our online store, please create a new account.</p>
                
                <div class="form-group w-50" >
                    <input type="text" placeholder="First Name" id="firstName" name="firstName"  class="form-control my-3" style="background-color: #f4f4f4";>
                    <input type="text" placeholder="Last Name" id="lastName" name="lastName"  class="form-control my-3" style="background-color: #f4f4f4";>
                    <input type="text" placeholder="Email" id="email" name="email"  class="form-control my-3 " style="background-color: #f4f4f4";>
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control mt-3 " style="background-color: #f4f4f4";><input type="checkbox" onclick="showPass()"> Show password
                    <input type="submit" id="create" name="create"  value="CREATE" class="form-control text-white bg-success mt-3">
                </div>

            </form>

            <hr>

            <div class="footer py-3 text-success">

                <div class="row fw-bold my-4">
                    <div class="col">Account</div>
                    <div class="col">Links</div>
                    <div class="col">Follow Us</div>
                </div>
                <div class="row">
                    <div class="col">Create Account</div>
                    <div class="col">About Us</div>
                    <div class="col"><i class="bi bi-instagram"></i> Instagram</div>
                </div>
                <div class="row">
                    <div class="col">My Account</div>
                    <div class="col">Privacy Policy</div>
                    <div class="col"><i class="bi bi-facebook"></i> Facebook</div>
                </div>
                <div class="row">
                    <div class="col">Log In</div>
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