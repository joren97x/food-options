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