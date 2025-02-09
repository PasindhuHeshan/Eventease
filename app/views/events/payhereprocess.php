<?php

$amount = 500;
$currency = 'LKR';
$merchant_id = '1229505';
$order_id = "Event Registration.";
$merchant_secret = 'MjE2MDUzOTc0NDI4NzE0MzQxNDgzNzc5MzMzNDk4MzE5Mzg0MjgzOA==';

$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

$array = [];

$array["amount"] = $amount;
$array["currency"] = $currency;
$array["merchant_id"] = $merchant_id;
$array["order_id"] = $order_id;
$array["hash"] = $hash;
$jsonObj = json_encode($array);
echo $jsonObj;
?>