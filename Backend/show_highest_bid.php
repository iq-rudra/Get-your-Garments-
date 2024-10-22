<?php
$conn = new mysqli('localhost', 'root', '', 'your_database');
$product_id = 1; // Example product ID

$sql = "SELECT MAX(bid_amount) as highest_bid, currency FROM bids WHERE product_id = '$product_id'";
$result = $conn->query($sql);

if ($row = $result->fetch_assoc()) {
    echo "Highest Bid: " . $row['highest_bid'] . " " . $row['currency'];
} else {
    echo "No bids yet.";
}

$conn->close();
?>
