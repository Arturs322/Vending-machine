<?php

$customer = new stdClass();
$customer->wallet = [
  1 => 10,
  2 => 10,
  5 => 10,
  10 => 10,
  20 => 10,
  50 => 10,
  100 => 10,
  200 => 10
];
echo "Welcome to Arthur's vending machine!" . PHP_EOL;
function createProduct($name, $price): stdClass
{
    $product = new stdClass();
    $product->name = $name;
    $product->price = $price;
    //$product->quantity = $quantity;

    return $product;
}

echo "Your wallet: " . PHP_EOL;
foreach ($customer->wallet as $key => $item)
{
    echo "$key cents = $item coins" . PHP_EOL;
}

echo "--------+++++--------" . PHP_EOL;
//echo intdiv(10, 5);
$products = [
    createProduct("Chips", 55),
    createProduct("Flavored nuts", 67),
    createProduct("Cookies", 20),
    createProduct("Coffee", 32),
    createProduct("Hot chocolate", 47),
    createProduct("Candy", 72),
    createProduct("Chocolate bar", 84),
    createProduct("Cheese bites", 42)
];

echo "Available products and their price: " . PHP_EOL;

foreach ($products as $key => $product)
{
    $price = $product->price / 100;
    echo "Key to choose {$key} {$product->name}- Price: {$price}$ cents" . PHP_EOL;
}

$selection= readline("Enter desired product: ");

$cart = [];

    if (!isset($products[$selection]))
    {
        echo "Product not found!" . PHP_EOL;
        exit;
    }

    $selectedProduct = clone $products[$selection];
    $cart[] = $selectedProduct;
    $total = 0;

foreach ($cart as $product)
{
    $total += $price;
}

    $choice = readline("Are you ready to pay? Enter \"yes\" or \"no\"! ");
if ($choice == "no")
{
    echo "Goodbye!" . PHP_EOL;
    exit;
}

$totalPrice = $selectedProduct->price / 100;
    if ($choice == "yes")
{
    echo "Follow the directions!" . PHP_EOL;
}


    $insertedCoins = 0;
    while ($insertedCoins < $selectedProduct->price)
    {
        echo "Left to pay: " . ($selectedProduct->price - $insertedCoins) / 100 . "$" . PHP_EOL;
        $insert = (int) readline("Insert your coins sir!: ");

if (!in_array($insert, array_keys($customer->wallet)))
{
    echo "Invalid coin!" . PHP_EOL;
    continue;
}

if (isset($customer->wallet[$insert]) && $customer->wallet[$insert] <= 0)
{
    echo "Coin not found!" . PHP_EOL;
    continue;
}
$customer->wallet[$insert] -= 1;
$insertedCoins += $insert;
        $return = $insertedCoins - $selectedProduct->price;

        if ($insert > $selectedProduct->price)
        {
            echo "Money to give back: {$return} cents" . PHP_EOL;
        }

    }
$return = $insertedCoins - $selectedProduct->price;

    foreach (array_reverse(array_keys($customer->wallet)) as $insert)
    {
        $quantity = intdiv($return, $insert);
        $customer->wallet[$insert] += $quantity;
        $return -= $insert * $quantity;
   }
    echo "Thank you for your purchase! Don't forget to take the change!" . PHP_EOL;
