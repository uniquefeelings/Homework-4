<?php
function readFromFile($filename) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return $lines;
}

// read data from text files
$streetTypes = readFromFile('street_types.txt');
$domains = readFromFile('domains.txt');
$firstNames = readFromFile('first_names.txt');
$lastNames = readFromFile('last_names.txt');
$streetNames = readFromFile('street_names.txt');
$states = readFromFile('states.txt');
$cities = readFromFile('cities.txt');
$products = readFromFile('products.txt');

// generate data for addresses
$addressData = '';
foreach ($streetTypes as $streetType) {
    foreach ($streetNames as $streetName) {
        $city = $cities[array_rand($cities)];
        $state = $states[array_rand($states)];
        $zip = rand(10000, 99999);
        $addressData .= "INSERT INTO address (street, city, state, zip) VALUES ('$streetType $streetName', '$city', '$state', '$zip');\n";
    }
}

// generate data for customers
$customerData = '';
foreach ($firstNames as $firstName) {
    foreach ($lastNames as $lastName) {
        $email = strtolower($firstName . '.' . $lastName . '@' . $domains[array_rand($domains)]);
        $phone = '555-' . rand(100, 999) . '-' . rand(1000, 9999);
        $addressId = rand(1, count($streetTypes) * count($streetNames));
        $customerData .= "INSERT INTO customer (first_name, last_name, email, phone, address_id) VALUES ('$firstName', '$lastName', '$email', '$phone', $addressId);\n";
    }
}

// generate data for orders
$orderData = '';
for ($i = 1; $i <= 350; $i++) {
    $customerId = rand(1, count($firstNames) * count($lastNames));
    $addressId = rand(1, count($streetTypes) * count($streetNames));
    $orderData .= "INSERT INTO `order` (customer_id, address_id) VALUES ($customerId, $addressId);\n";
}

// generate data for product 
$productData = '';
foreach ($products as $product) {
    $description = "A $product for you to enjoy";
    $weight = rand(1, 100) . ' lbs';
    $baseCost = rand(10, 100) . '.99';
    $productData .= "INSERT INTO product (product_name, description, weight, base_cost) VALUES ('$product', '$description', '$weight', '$baseCost');\n";
}

// generate data for warehouse 
$warehouseData = '';
foreach ($cities as $city) {
    foreach ($states as $state) {
        $name = $city . ' Warehouse';
        $addressId = rand(1, count($streetTypes) * count($streetNames));
        $warehouseData .= "INSERT INTO warehouse (name, address_id) VALUES ('$name', $addressId);\n";
    }
}

// generate data for order_item 
$orderItemData = '';
for ($i = 1; $i <= 550; $i++) {
    $orderId = rand(1, 350);
    $productId = rand(1, count($products));
    $quantity = rand(1, 10);
    $price = rand(10, 100) . '.99';
    $orderItemData .= "INSERT INTO order_item (order_id, product_id, quantity, price) VALUES ($orderId, $productId, $quantity, '$price');\n";
}

// generate data for product_warehouse 
$productWarehouseData = '';
for ($i = 1; $i <= 1250; $i++) {
    $productId = rand(1, count($products));
    $warehouseId = rand(1, count($cities) * count($states));
    $productWarehouseData .= "INSERT INTO product_warehouse (product_id, warehouse_id) VALUES ($productId, $warehouseId);\n";
}

// write data for data.sql file
$dataSqlContent = $addressData . $customerData . $orderData . $productData . $warehouseData . $orderItemData . $productWarehouseData;
file_put_contents('data.sql', $dataSqlContent);

echo "Data has been generated and written to data.sql file.";
?>
