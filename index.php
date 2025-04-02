<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
<head>
    <title>A to Z Grocery Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
</head>
<body>
    <header>
        <h1>A to Z Grocery Store</h1>
        <div class="cart-icon">
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i>
                <?php
                $cart_count = 0;
                if (isset($_SESSION['cart'])) {
                    $cart_items = array_count_values($_SESSION['cart']);
                    foreach ($cart_items as $quantity) {
                        $cart_count += $quantity;
                    }
                }
                echo "<span class='cart-count'>$cart_count</span>";
                ?>
            </a>
        </div>
    </header>

    <div class="product-container">
        <?php
        $products = [
            ['id' => 1, 'name' => 'Rice', 'price' => 60, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRPmI7XK1v5_zaTH2jGglapGQs9Ka0dp-mroA&s'],
            ['id' => 2, 'name' => 'Dal', 'price' => 120, 'image' => 'https://m.media-amazon.com/images/I/71zaBySy78L._AC_UF1000,1000_QL80_.jpg'],
            ['id' => 3, 'name' => 'Sugar', 'price' => 45, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRt_drAo7E4y_JBNVAMpEKB5UKoqiGmVt1OXw&s'],
            ['id' => 4, 'name' => 'Tea', 'price' => 180, 'image' => 'https://m.media-amazon.com/images/I/61lDzEQlACL._AC_UF1000,1000_QL80_.jpg'],
            ['id' => 5, 'name' => 'Oil', 'price' => 200, 'image' => 'https://m.media-amazon.com/images/I/61Sc6K5dhhL.jpg'],
            ['id' => 6, 'name' => 'Wheat Flour', 'price' => 55, 'image' => 'https://pngimg.com/d/flour_PNG3.png'],
            ['id' => 7, 'name' => 'Salt', 'price' => 20, 'image' => 'https://pngimg.com/d/salt_PNG14.png'],
            ['id' => 8, 'name' => 'Milk Powder', 'price' => 400, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSz8yk8KvBTz8SdIwWgSKrSEEXAEy7ZDnnuNw&s'],
            ['id' => 9, 'name' => 'Coffee', 'price' => 150, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQODjEFQjIQas7LcnGSsfKQrmdg83Y68HVWaw&s'],
            ['id' => 10, 'name' => 'Turmeric Powder', 'price' => 80, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT72aTvZGOofk1NW73X_eiNEJbqreeHX1ZIcQ&s'],
            ['id' => 11, 'name' => 'Red Chilli', 'price' => 90, 'image' => 'https://m.media-amazon.com/images/I/71hUE2YFqLL._AC_UF1000,1000_QL80_.jpg'],
            ['id' => 12, 'name' => 'Cashews', 'price' => 900, 'image' => 'https://pngimg.com/d/cashew_PNG49.png'],
            ['id' => 13, 'name' => 'Almonds', 'price' => 850, 'image' => 'https://pngimg.com/d/almond_PNG45.png'],
            ['id' => 14, 'name' => 'Biscuits', 'price' => 30, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkQBIPfO4_Gu5zDn6Izee4d3KqxpuFMFcmZw&s'],
            ['id' => 15, 'name' => 'Pasta', 'price' => 75, 'image' => 'https://pngimg.com/d/pasta_PNG51.png']
        ];

        foreach ($products as $product) {
            echo "<div class='product-card'>";
            echo "<img src='{$product['image']}' alt='{$product['name']}'>";
            echo "<h3>{$product['name']}</h3>";
            echo "<p>₹{$product['price']}</p>";
            echo "<form action='cart.php' method='post'>";
            echo "<input type='hidden' name='product_id' value='{$product['id']}'>";
            echo "<input type='submit' value='Add to Cart' class='add-to-cart'>";
            echo "</form>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
