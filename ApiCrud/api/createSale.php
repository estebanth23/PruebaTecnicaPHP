<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/Database.php';
    include_once '../class/Sale.php';
    include_once '../class/Product.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Product($db);
    $itemSale = new Sale($db);
    $data = json_decode(file_get_contents("php://input"));
    $itemSale->fecha_venta = date('Y-m-d H:i:s');
    $item->id = $data->id_producto;
    $cantidad = $data->cantidad;
  
    $item->getSingleProduct();
    if($item->nombre_producto != null){
        // create array
        $emp_arr = array(
            "id" =>  $item->id,
            "nombre_producto" => $item->nombre_producto,
            "referencia" => $item->referencia,
            "precio" => $item->precio,
            "peso" => $item->peso,
            "categoria" => $item->categoria,
            "stock" => $item->stock,
            "fecha_creacion" => $item->fecha_creacion
        );
        
        if($item->stock - $cantidad > 0){
            $itemSale->total = $item->precio * $cantidad;
            $itemSale->id_producto = $item->id;
            $itemSale->cantidad = $cantidad;
            if($itemSale->createSale()){
                $item->stock = $item->stock - $cantidad;
                if($item->updateProduct()){
                    echo json_encode("Product data updated.");
                } else{
                    echo json_encode("Data could not be updated");
                }
                echo 'Sale created successfully.';
            } else{
                echo 'Sale could not be created.';
            }
           
        }else{
            http_response_code(400);
            echo json_encode("Insuficient stock.");
        }
    }
      
    else{
        http_response_code(404);
        echo json_encode("Product not found.");
    }
    
    

?>