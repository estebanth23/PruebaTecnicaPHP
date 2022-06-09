<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/Database.php';
    include_once '../class/Product.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Product($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->nombre_producto = $data->nombre_producto;
    $item->referencia = $data->referencia;
    $item->precio = $data->precio;
    $item->peso = $data->peso;
    $item->categoria = $data->categoria;
    $item->stock = $data->stock;
    $item->fecha_creacion = date('Y-m-d H:i:s');
    
    if($item->createProduct()){
        echo 'Product created successfully.';
    } else{
        echo 'Product could not be created.';
    }
?>