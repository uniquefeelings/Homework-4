<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function generateRandomFullName() {
    $firstName = generateRandomString(rand(5, 10));
    $lastName = generateRandomString(rand(5, 10));
    return $firstName . ' ' . $lastName;
}


function generateRandomEmail($firstName, $lastName) {
    $domains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'example.com'];
    $randomDomain = $domains[array_rand($domains)];
    return strtolower($firstName . '.' . $lastName . '@' . $randomDomain);
}


function generateRandomPhoneNumber() {
    return '555-' . rand(100, 999) . '-' . rand(1000, 9999);
}


function generateRandomAddress() {
    $streetNumber = rand(1, 1000);
    $streetName = generateRandomString(rand(5, 10)) . ' St';
    $city = generateRandomString(rand(5, 10));
    $states = ['NY', 'CA', 'TX', 'FL', 'IL'];
    $state = $states[array_rand($states)];
    $zip = rand(10000, 99999);
    return [$streetNumber, $streetName, $city, $state, $zip];
}


function generateProductDescription() {
    $adjectives = ['wonderful', 'amazing', 'fantastic', 'awesome', 'excellent'];
    $nouns = ['hammer', 'screwdriver', 'chisel', 'pliers', 'axe'];
    $adjective = $adjectives[array_rand($adjectives)];
    $noun = $nouns[array_rand($nouns)];
    $colors = ['red', 'blue', 'green', 'yellow', 'black'];
    $color = $colors[array_rand($colors)];
    $materials = ['wood', 'metal', 'plastic', 'steel', 'aluminum'];
    $material = $materials[array_rand($materials)];
    $verbs = ['hammering', 'screwing', 'fixing', 'building', 'repairing'];
    $verb = $verbs[array_rand($verbs)];
    return "A $adjective $noun in an $color made of $material useful for $verb.";
}


function generateRandomWeight() {
    return rand(1, 100) . ' lbs';
}


function generateRandomBaseCost() {
    return rand(10, 100) . '.99';
}


$dumpSuperstoreSqlContent = file_get_contents('dump-superstore.sql');


$addressData = '';
for ($i = 1; $i <= 150; $i++) {
    $address = generateRandomAddress();
    $addressData .= "INSERT INTO address (street, city, state, zip) VALUES ('{$address[0]} {$address[1]}', '{$address[2]}', '{$address[3]}', '{$address[4]}');\n";
}


$customerData = '';
for ($i = 1; $i <= 100; $i++) {
    $fullName = generateRandomFullName();
    $email = generateRandomEmail(explode(' ', $fullName)[0], explode(' ', $fullName)[1]);
    $phone = generateRandomPhoneNumber();
    $addressId = rand(1, 150);
    $customerData .= "INSERT INTO customer (first_name, last_name, email, phone, address_id) VALUES ('$fullName', '$fullName', '$email', '$phone', $addressId);\n";
}

$orderData = '';
for ($i = 1; $i <= 350; $i++) {
    $customerId = rand(1, 100);
    $addressId = rand(1, 150);
    $orderData .= "INSERT INTO `order` (customer_id, address_id) VALUES ($customerId, $addressId);\n";
}


$productData = '';
for ($i = 1; $i <= 750; $i++) {
    $productName = generateRandomString(rand(5, 10));
    $description = generateProductDescription();
    $weight = generateRandomWeight();
    $baseCost = generateRandomBaseCost();
    $productData .= "INSERT INTO product (product_name, description, weight, base_cost) VALUES ('$productName', '$description', '$weight', '$baseCost');\n";
}


$warehouseData = '';
for ($i = 1; $i <= 25; $i++) {
    $name = generateRandomString(rand(5, 10)) . ' Warehouse';
    $addressId = rand(1, 150);
    $warehouseData .= "INSERT INTO warehouse (name, address_id) VALUES ('$name', $addressId);\n";
}


$orderItemData = '';
for ($i = 1; $i <= 550; $i++) {
    $orderId = rand(1, 350);
    $productId = rand(1, 750);
    $quantity = rand(1, 10);
    $price = generateRandomBaseCost();
    $orderItemData .= "INSERT INTO order_item (order_id, product_id, quantity, price) VALUES ($orderId, $productId, $quantity, '$price');\n";
}


$productWarehouseData = '';
for ($i = 1; $i <= 1250; $i++) {
    $productId = rand(1, 750);
    $warehouseId = rand(1, 25);
    $productWarehouseData .= "INSERT INTO product_warehouse (product_id, warehouse_id) VALUES ($productId, $warehouseId);\n";
}


$dataSqlContent = $dumpSuperstoreSqlContent . $addressData . $customerData . $orderData . $productData . $warehouseData . $orderItemData . $productWarehouseData;
file_put_contents('data.sql', $dataSqlContent);

echo "Data has been generated and written to data.sql file.";

