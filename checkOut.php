<?php
    session_start();
    require "conn.php";
    if(!isset($_SESSION['email'])) {

        header("Location: index.php");

    }
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

        <div class="container-fluid">
            <div class="container">
                <div class="row m-5 ">

                    <?php
                        $email = $_SESSION['email'];
                        $query = "SELECT * FROM tblaccounts WHERE email='$email'";
                        $querylakaw = mysqli_query($conn, $query);

                        if(mysqli_num_rows($querylakaw)>0) {

                            $accountInfo = mysqli_fetch_array($querylakaw); 
                    ?>
                        <div class="col-6 ">
                            <div class="row">
                                <div class="row">
                                    <div class="col display-6 mb-5 justify-content-center text-success">
                                        <a href="index.php" class="text-success " style="text-decoration: none;">Food <i class="bi bi-egg"></i>ptions</a>
                                    </div>
                                </div>
                                <div class="row mb-3 h4">
                                    Contact Information
                                </div>
                                    <div class="col-1 m-1">
                                        <i class="bi bi-person-square h1 " ></i> 
                                    </div>
                                    <div class="col">
                                        <?php echo $accountInfo['firstName']." ".$accountInfo['lastName']; echo "(".$accountInfo['email'].")"; ?>
                                        <br> <a href='logOut.php' class='text-success' style='text-decoration: none;'>  Log Out</a>    
                                    </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <input type="checkbox" checked> Email me with news and offers
                                </div>
                            </div>
                            <div class="row">
                                    <div class="row mt-3 h4">
                                        Shipping Address
                                    </div>
                                    
                                            <div class="row form-group">
                                                <div class="row">
                                                        <div class="col">
                                                            <select class="form-control">
                                                                <option selected="selected" placeholder="COUNTRY">Philippines</option>
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="row mt-2">
                                                    
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" value="<?php echo $accountInfo['firstName']; ?>">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" value="<?php echo $accountInfo['lastName']; ?>">
                                                    </div>
                                                </div> 
                                                <div class="row mt-2">
                                                    <div class="col ">
                                                        <input type="text" class="form-control" placeholder="Address" required>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col ">
                                                        <input type="text" class="form-control" placeholder="Barangay" required>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" placeholder="Zip/Postal Code" required>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" required class="form-control" placeholder="City" required>
                                                    </div>
                                                </div> 
                                                <div class="row mt-2">
                                                    <div class="col ">
                                                        <input type="text" class="form-control" placeholder="Mobile Phone Number" required>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-6">
                                                    <i class="bi bi-chevron-compact-left"></i> <a href='cart.php' class='text-success' style='text-decoration: none;'>  Return to cart</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <form action="functions.php" method="POST"><button class="btn btn-success" id="btnShipping" name="btnShipping">Continue to shipping</button></form>
                                                    </div>
                                                </div> 
                                            </div>
                            </div>
                        </div>
                        <div class="col-6 mt-5">
                        <?php
                            }
                                $qty = $_GET['btnCheckOut'];
                                $foodFromCart = mysqli_query($conn, "SELECT * FROM tblcart");
                                if(mysqli_num_rows($foodFromCart) > 0) {
                                    foreach($foodFromCart as $food) {
                        ?>
                        
                        

                            <div class="row">
                                <div class="col">
                                    <?php echo $food['productName']; ?>
                                </div>
                                <div class="col">
                                    ₱<?php echo $food['price']*$qty.".00"; ?>
                                </div>
                            </div>
                            <?php
                                    }
                        ?>
                            <hr>
                            <div class="row my-4">
                                <div class="col-9 form-group">
                                    <input type="text" class="form-control" placeholder="Discount code (not working)">
                                </div>
                                <div class="col ">
                                    <button class="btn btn-success">Apply</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    Total
                                </div>
                                <div class="col">
                                    
                                    <?php
                                            $qty = $_GET['btnCheckOut'];
                                            $foodFromCart = mysqli_query($conn, "SELECT * FROM tblcart");
                                            if(mysqli_num_rows($foodFromCart) > 0) {
                                                $total = 0;
                                                foreach($foodFromCart as $food) {
                                    
                                                    $total += $food['price']*$qty;
                                    
                                                }
                                                echo "₱".$total.".00";
                                            }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                            }
                        ?>
                </div>
                
                    
                    
            </div>
        </div>
    
</body>
</html>



