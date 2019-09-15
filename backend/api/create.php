<?php
require 'database.php';

//get posted data
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)){
    //extract the data
    $request = json_decode($postdata);
    
    //validate
    if(trim($request->number) === '' || (float)$request->amount< 0) {
        return http_response_code(400);
    }
    
    //sanitize
    $number = mysqli_real_escape_string($con, trim($request->number));
    $amount = mysqli_real_escape_string($con, (int)$request->amount);
    
    //create
    $sql = "INSERT INTO `policies`(`id`,`number`,`amount`) VALUES (null, '{$number}','{$amount}')";
    
    if(mysqli_query($con,$sql)){
        http_response_code(201);
        $policy = [
            'number' => $number,
            'amount' => $amount,
            'id' => mysqli_insert_id($con)
        ];
        echo json_encode($policy);
    }
    
    else {
        http_response_code(422);
    }
    
}


?>