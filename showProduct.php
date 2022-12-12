<div class="col-3 mt-3 text-success text-center d-flex justify-content-center">
    <div class="card shadow" style="width: 200px;">
        <img class="card-img-top rounded " src="img/<?php echo $product['imageName'] ?>" alt="Card image cap" style="width: 150px; height: 150px; margin-left: 25px; margin-top: 20px;">
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