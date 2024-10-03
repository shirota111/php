<?php
header('Content-Type: application/json');

$data = array(
    "message" => "Hello from the PHP backend!",
    "status" => "success"
);

echo json_encode($data);
?>