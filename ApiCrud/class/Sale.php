<?php
    class Sale{
        // Connection
        private $conn;
        // Table
        private $db_table = "venta";
        // Columns
        public $id;
        public $id_producto;
        public $total;
        public $fecha_venta;
        public $cantidad;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getSales(){
            $sqlQuery = "SELECT id, id_producto, total, fecha_venta, cantidad FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createSale(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_producto = :id_producto, 
                        total = :total, 
                        fecha_venta = :fecha_venta,
                        cantidad = :cantidad";
            
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id_producto=htmlspecialchars(strip_tags($this->id_producto));
            $this->total=htmlspecialchars(strip_tags($this->total));
            $this->fecha_venta=htmlspecialchars(strip_tags($this->fecha_venta));
            $this->cantidad=htmlspecialchars(strip_tags($this->cantidad));

            // bind data
            $stmt->bindParam(":id_producto", $this->id_producto);
            $stmt->bindParam(":total", $this->total);
            $stmt->bindParam(":fecha_venta", $this->fecha_venta);
            $stmt->bindParam(":cantidad", $this->cantidad);
          
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleSale(){
            $sqlQuery = "SELECT
                        id, 
                        id_producto, 
                        total, 
                        fecha_venta,
                        cantidad
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $dataRow['id'];
            $this->id_producto = $dataRow['id_producto'];
            $this->total = $dataRow['total'];
            $this->fecha_venta = $dataRow['fecha_venta'];
            $this->cantidad = $dataRow['cantidad'];
        }        
        // UPDATE
        public function updateSale(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        id_producto = :id_producto, 
                        total = :total, 
                        precio= :precio, 
                        fecha_venta= :fecha_venta,
                        cantidad = :cantidad
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->id_producto=htmlspecialchars(strip_tags($this->id_producto));
            $this->total=htmlspecialchars(strip_tags($this->total));
            $this->fecha_venta=htmlspecialchars(strip_tags($this->fecha_venta));
            $this->cantidad=htmlspecialchars(strip_tags($this->cantidad));
        
            // bind data
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":id_producto", $this->id_producto);
            $stmt->bindParam(":total", $this->total);
            $stmt->bindParam(":fecha_venta", $this->fecha_venta);
            $stmt->bindParam(":cantidad", $this->cantidad);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteSale(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>