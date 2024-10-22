<?php
session_start();

// API Key for ExchangeRate-API
$apiKey = "f1732cf820c5714c9412aaa4";

// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wholesale_wardrobe"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the product ID dynamically (e.g., via GET parameter)
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 1; // Default to product 1 if no ID is provided

// Fetch product price in BDT from the database
$sql = "SELECT price FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$productPriceBDT = $product['price'] ?? 0; // Default to 0 if price not found

// Function to fetch exchange rates using the API
function getExchangeRate($baseCurrency, $targetCurrency, $apiKey) {
    $apiUrl = "https://v6.exchangerate-api.com/v6/$apiKey/pair/$baseCurrency/$targetCurrency";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);
    return $data['conversion_rate'] ?? null;
}

// Fetch the exchange rates
$bdtToUsdRate = getExchangeRate("BDT", "USD", $apiKey);
$usdToBdtRate = getExchangeRate("USD", "BDT", $apiKey);

// Convert product price to USD
$productPriceUSD = $productPriceBDT * $bdtToUsdRate;

// Display the prices
if ($bdtToUsdRate && $usdToBdtRate) {
    echo "Product Price in BDT: $productPriceBDT<br>";
    echo "Product Price in USD: " . round($productPriceUSD, 2) . "<br>";
    echo "Conversion Rate (BDT to USD): $bdtToUsdRate<br>";
    echo "Conversion Rate (USD to BDT): $usdToBdtRate<br>";
} else {
    echo "Error: Unable to fetch currency conversion rates.";
}

$conn->close();
?>
