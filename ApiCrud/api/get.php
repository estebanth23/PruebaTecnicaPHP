<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/Database.php';
    include_once '../class/Product.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Product($db);
    $stmt = $items->getProducts();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $productArr = array();
        $productArr["body"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "nombre_producto" => $nombre_producto,
                "referencia" => $referencia,
                "precio" => $precio,
                "peso" => $peso,
                "categoria" => $categoria,
                "stock" => $stock,
                "fecha_creacion" => $fecha_creacion
            );
            array_push($productArr["body"], $e);
        }
        echo json_encode($productArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>