<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    echo "Access denied!";
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'wholesale_wardrobe');

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Fetch the product to pre-fill the form
    $result = $conn->query("SELECT * FROM products WHERE id = $product_id");
    $product = $result->fetch_assoc();
    
    if (!$product) {
        echo "Product not found!";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $currency = $_POST['currency'];
        $stock = $_POST['stock'];
        $category_id = $_POST['category_id'];

        // Update product details in the database
        $sql = "UPDATE products SET name='$name', description='$description', price='$price', currency='$currency', stock='$stock', category_id='$category_id' WHERE id='$product_id'";

        if ($conn->query($sql)) {
            echo "Product updated successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "No product ID provided!";
    exit;
}

$conn->close();
?>
<form action="update_product.php?id=<?php echo $product['id']; ?>" method="POST">
    Name: <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>
    Description: <textarea name="description"><?php echo $product['description']; ?></textarea><br>
    Price: <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required><br>
    Currency:
    <select name="currency">
        <option value="BDT" <?php echo ($product['currency'] == 'BDT') ? 'selected' : ''; ?>>BDT</option>
        <option value="USD" <?php echo ($product['currency'] == 'USD') ? 'selected' : ''; ?>>USD</option>
    </select><br>
    Stock: <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required><br>
    Category: 
    <select name="category_id">
        <?php
        // Fetch categories from the database
        $conn = new mysqli('localhost', 'root', '', 'wholesale_wardrobe');
        $categories = $conn->query("SELECT * FROM categories");
        while ($category = $categories->fetch_assoc()) {
            echo "<option value='{$category['id']}' " . (($product['category_id'] == $category['id']) ? 'selected' : '') . ">{$category['category_name']}</option>";
        }
        $conn->close();
        ?>
    </select><br>
    <input type="submit" value="Update Product">
</form>
