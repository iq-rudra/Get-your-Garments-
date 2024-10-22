<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];
    $total_price = $_POST['total_price']; // Calculate from bids

    $conn = new mysqli('localhost', 'root', '', 'your_database');
    $sql = "INSERT INTO orders (user_id, product_id, total_price) VALUES ('$user_id', '$product_id', '$total_price')";

    if ($conn->query($sql)) {
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
<form action="checkout.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    Total Price: <input type="number" step="0.01" name="total_price" required><br>
    <input type="submit" value="Checkout">
</form>
