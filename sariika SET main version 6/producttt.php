<?php
    session_start();
    require_once "DBconnect.php"; 
    // Fetch products from the database
    $sql = "SELECT * FROM products";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $products = $statement->fetchAll();

    require "template/header.php"; 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>
        <link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
        <center><h1>Our Products</h1></center>
        <div class="content-wrapper">
            <!-- Products Grid -->
            <div class="product-row">
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>">
                        <h3><?= htmlspecialchars($product['title']) ?></h3>
                        <p><strong>€<?= number_format($product['price'], 2) ?></strong></p>

                        <!-- Add to Cart Form -->
                        <form method="post" action="add-to-cart.php">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="product_name" value="<?= $product['title'] ?>">
                            <input type="hidden" name="price" value="<?= $product['price'] ?>">
                            <input type="number" name="quantity" value="0" min="1" style="width: 50px;">
                            <input type="submit" name="submit" value="Add to Cart" class="btn">
                        </form>

                    </div>
                <?php endforeach; ?>
            </div>

            <form method = "post" action = "cartt.php">
                <input type = "submit" name = "submit" value = "Continue To Cart" class="btn">
                         
            </form>
        </div>
    </body>
</html>
