<?php

require './dbconn.php';
require './Item.php';
require './../vendor/autoload.php';

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $stmt = "select * from products;";
    $result = $conn->query($stmt);
    if($result->num_rows){
        $array = array();
        while($row = $result->fetch_assoc()){
            array_push($array, new Item($row['id'], $row['title'], $row['price'], $row['image']));
        }
        echo json_encode($array);
    }
    else echo "Something went wrong. Try again later!!!"; 
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$itemList = json_decode(trim(file_get_contents('php://input')));
$total = 0;
foreach($itemList as $item){
    $id = $conn->real_escape_string(($item->id));
    $quantity = $conn->real_escape_string(($item->quantity));

    $result = $conn->query('select price from products where id ='. $id.';');
    if ($result->num_rows){
        $row = $result->fetch_assoc();
        $total += $row['price'] * intval($quantity);
    }
    else {echo json_encode(['status'=>'no such product found']); exit();}
}

    $stripe = new \Stripe\StripeClient('INSERT_YOUR_OWN_STRIPE_SECRET_KEY_HERE');
    $session = $stripe->checkout->sessions->create([
        'success_url'=> 'http://localhost:8080/frontend/index.html?status=success',
        'cancel_url' => 'http://localhost:8080/frontend/index.html?status=failure',
        'payment_method_types' => ['card'],
        'mode' => 'payment',
        'line_items'=>[
            [
                'quantity' => 1,
                'price_data'=>[
                    'currency' => 'gbp',
                    'unit_amount' => $total,
                    'product_data' =>[
                        'name' => 'Grocery Store',
                        'description'=> 'Your Invoice for Gracery today.'
                    ]
                ]
            ]
        ]
    ]);


    echo json_encode(['id'=>$session->id]);



}
?>