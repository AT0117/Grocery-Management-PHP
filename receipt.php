<?php
session_start();

// Redirect if no quantities posted
if (!isset($_POST['quantity'])) {
    header('Location: cart.php');
    exit();
}

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

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt - A to Z Grocery Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="receipt">
        <h1>A to Z Grocery Store</h1>
        <h2>Receipt</h2>
        <div class="receipt-content">
            <?php
            foreach ($_POST['quantity'] as $product_id => $quantity) {
                if ($quantity > 0) {
                    $subtotal = $products[$product_id]['price'] * $quantity;
                    $total += $subtotal;
                    echo "<div class='receipt-item'>";
                    echo "<span>{$products[$product_id]['name']} × $quantity</span>";
                    echo "<span>₹$subtotal</span>";
                    echo "</div>";
                }
            }
            if ($total > 0) {
                echo "<div class='receipt-total'>";
                echo "<strong>Total Amount: ₹$total</strong>";
                echo "</div>";
                $_SESSION['cart'] = [];
            } else {
                echo "<p>No items in order.</p>";
            }
            ?>
            <a href="index.php" class="home-button">Back to Store</a>
        </div>
    </div>
</body>
</html>
