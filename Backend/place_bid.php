<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $bid_amount = $_POST['bid_amount'];
    $currency = $_POST['currency'];
    $user_id = $_SESSION['user_id'];

    $conn = new mysqli('localhost', 'root', '', 'your_database');
    $sql = "INSERT INTO bids (product_id, user_id, bid_amount, currency) VALUES ('$product_id', '$user_id', '$bid_amount', '$currency')";

    if ($conn->query($sql)) {
        echo "Bid placed successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
<form action="place_bid.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    Bid Amount: <input type="number" step="0.01" name="bid_amount" required><br>
    Currency:
    <select name="currency">
        <option value="BDT">BDT</option>
        <option value="USD">USD</option>
    </select><br>
    <input type="submit" value="Place Bid">
</form>
