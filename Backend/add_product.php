<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    echo "Access denied!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $currency = $_POST['currency'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];

    $conn = new mysqli('localhost', 'root', '', 'wholesale_wardrobe');
    $sql = "INSERT INTO products (name, description, price, currency, stock, category_id) VALUES ('$name', '$description', '$price', '$currency', '$stock', '$category_id')";

    if ($conn->query($sql)) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
<form action="add_product.php" method="POST">
    Name: <input type="text" name="name" required><br>
    Description: <textarea name="description"></textarea><br>
    Price: <input type="number" step="0.01" name="price" required><br>
    Currency:
    <select name="currency">
        <option value="BDT">BDT</option>
        <option value="USD">USD</option>
    </select><br>
    Stock: <input type="number" name="stock" required><br>
    Category: 
    <select name="category_id">
        <?php
        // Fetch categories from the database
        $conn = new mysqli('localhost', 'root', '', 'wholesale_wardrobe');
        $categories = $conn->query("SELECT * FROM categories");
        while ($category = $categories->fetch_assoc()) {
            echo "<option value='{$category['id']}'>{$category['category_name']}</option>";
        }
        $conn->close();
        ?>
    </select><br>
    <input type="submit" value="Add Product">
</form>
