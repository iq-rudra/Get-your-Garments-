<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    echo "Access denied!";
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'wholesale_wardrobe');

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Fetch the product to confirm deletion
    $result = $conn->query("SELECT * FROM products WHERE id = $product_id");
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "Product not found!";
        exit;
    }

    // Check if the form is submitted to confirm deletion
    if (isset($_POST['confirm_delete'])) {
        $sql = "DELETE FROM products WHERE id='$product_id'";

        if ($conn->query($sql)) {
            echo "Product deleted successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
        exit;
    }
} else {
    echo "No product ID provided!";
    exit;
}
?>
<h2>Are you sure you want to delete this product?</h2>
<p>Product Name: <?php echo $product['name']; ?></p>
<p>Description: <?php echo $product['description']; ?></p>

<form action="delete_product.php?id=<?php echo $product['id']; ?>" method="POST">
    <input type="submit" name="confirm_delete" value="Yes, Delete">
</form>
<a href="admin_dashboard.php">Cancel</a>
