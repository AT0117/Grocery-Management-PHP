<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'])) {
        $_SESSION['cart'][] = $_POST['product_id'];
    }
    if (isset($_POST['remove_id'])) {
        $key = array_search($_POST['remove_id'], $_SESSION['cart']);
        if ($key !== false) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }
    if (isset($_POST['empty_cart'])) {
        $_SESSION['cart'] = [];
    }
}

$cart_count = 0;
if (isset($_SESSION['cart'])) {
    $cart_items = array_count_values($_SESSION['cart']);
    foreach ($cart_items as $quantity) {
        $cart_count += $quantity;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart - A to Z Grocery Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <h1>Shopping Cart</h1>
        <div class="cart-icon">
            <a href="index.php">
                <i class="fas fa-home"></i>
                <span class='cart-count'><?php echo $cart_count; ?></span>
            </a>
        </div>
    </header>

    <div class="cart-container">
        <?php if (!empty($_SESSION['cart'])): ?>
            <form action="cart.php" method="post" class="empty-cart-form">
                <input type="hidden" name="empty_cart" value="1">
                <input type="submit" value="Empty Cart" class="empty-cart-button">
            </form>
        <?php endif; ?>
        
        <form action="receipt.php" method="post">
            <?php
            $products = [
                1 => ['name' => 'Rice', 'price' => 60],
                2 => ['name' => 'Dal', 'price' => 120],
                3 => ['name' => 'Sugar', 'price' => 45],
                4 => ['name' => 'Tea', 'price' => 180],
                5 => ['name' => 'Oil', 'price' => 200],
                6 => ['name' => 'Wheat Flour', 'price' => 55],
                7 => ['name' => 'Salt', 'price' => 20],
                8 => ['name' => 'Milk Powder', 'price' => 400],
                9 => ['name' => 'Coffee', 'price' => 150],
                10 => ['name' => 'Turmeric Powder', 'price' => 80],
                11 => ['name' => 'Red Chilli', 'price' => 90],
                12 => ['name' => 'Cashews', 'price' => 900],
                13 => ['name' => 'Almonds', 'price' => 850],
                14 => ['name' => 'Biscuits', 'price' => 30],
                15 => ['name' => 'Pasta', 'price' => 75]
            ];

            $cart_items = array_count_values($_SESSION['cart']);
            
            if (empty($cart_items)) {
                echo "<p class='empty-cart'>Your cart is empty!</p>";
            } else {
                foreach ($cart_items as $product_id => $quantity) {
                    echo "<div class='cart-item'>";
                    echo "<h3>{$products[$product_id]['name']}</h3>";
                    echo "<p>₹{$products[$product_id]['price']}</p>";
                    echo "<div class='cart-item-controls'>";
                    echo "<input type='number' name='quantity[$product_id]' value='$quantity' min='1' max='10'>";
                    echo "<button type='button' onclick='removeItem($product_id)' class='remove-item'><i class='fas fa-trash'></i></button>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "<input type='submit' value='Place Order' class='order-button'>";
            }
            ?>
        </form>

        <script>
            function removeItem(productId) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'cart.php';
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'remove_id';
                input.value = productId;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        </script>
    </div>
</body>
</html>
