<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $payment_method = $_POST['payment_method'];

    $conn = new mysqli('localhost', 'root', '', 'wholesale_wardrobe');
    $sql = "INSERT INTO payments (order_id, payment_method, payment_status) VALUES ('$order_id', '$payment_method', 'completed')";

    if ($conn->query($sql)) {
        echo "Payment completed successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
<form action="payment.php" method="POST">
    Order ID: <input type="number" name="order_id" required><br>
    Payment Method:
    <select name="payment_method">
        <option value="Card">Card</option>
        <option value="PayPal">PayPal</option>
        <option value="Bank Transfer">Bank Transfer</option>
    </select><br>
    <input type="submit" value="Make Payment">
</form>
