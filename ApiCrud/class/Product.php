<?php
    class Product{
        // Connection
        private $conn;
        // Table
        private $db_table = "productos";
        // Columns
        public $id;
        public $nombre_producto;
        public $referencia;
        public $precio;
        public $peso;
        public $categoria;
        public $stock;
        public $fecha_creacion;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getProducts(){
            $sqlQuery = "SELECT id, nombre_producto, referencia, precio, peso, categoria, stock, fecha_creacion FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createProduct(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        nombre_producto = :nombre_producto, 
                        referencia = :referencia, 
                        precio = :precio, 
                        peso = :peso,
                        categoria = :categoria,
                        stock = :stock,
                        fecha_creacion = :fecha_creacion";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->nombre_producto=htmlspecialchars(strip_tags($this->nombre_producto));
            $this->referencia=htmlspecialchars(strip_tags($this->referencia));
            $this->precio=htmlspecialchars(strip_tags($this->precio));
            $this->peso=htmlspecialchars(strip_tags($this->peso));
            $this->categoria=htmlspecialchars(strip_tags($this->categoria));
            $this->stock=htmlspecialchars(strip_tags($this->stock));
            $this->fecha_creacion=htmlspecialchars(strip_tags($this->fecha_creacion));
        
            // bind data
            $stmt->bindParam(":nombre_producto", $this->nombre_producto);
            $stmt->bindParam(":referencia", $this->referencia);
            $stmt->bindParam(":precio", $this->precio);
            $stmt->bindParam(":peso", $this->peso);
            $stmt->bindParam(":categoria", $this->categoria);
            $stmt->bindParam(":stock", $this->stock);
            $stmt->bindParam(":fecha_creacion", $this->fecha_creacion);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleProduct(){
            $sqlQuery = "SELECT
                        id, 
                        nombre_producto, 
                        referencia, 
                        precio, 
                        peso, 
                        categoria,
                        stock,
                        fecha_creacion
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
            $this->nombre_producto = $dataRow['nombre_producto'];
            $this->referencia = $dataRow['referencia'];
            $this->precio = $dataRow['precio'];
            $this->peso = $dataRow['peso'];
            $this->categoria = $dataRow['categoria'];
            $this->stock = $dataRow['stock'];
            $this->fecha_creacion = $dataRow['fecha_creacion'];
        }        
        // UPDATE
        public function updateProduct(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        id = :id, 
                        nombre_producto = :nombre_producto, 
                        referencia = :referencia, 
                        precio= :precio, 
                        peso= :peso, 
                        categoria= :categoria, 
                        stock= :stock, 
                        fecha_creacion= :fecha_creacion
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->nombre_producto=htmlspecialchars(strip_tags($this->nombre_producto));
            $this->referencia=htmlspecialchars(strip_tags($this->referencia));
            $this->precio=htmlspecialchars(strip_tags($this->precio));
            $this->peso=htmlspecialchars(strip_tags($this->peso));
            $this->categoria=htmlspecialchars(strip_tags($this->categoria));
            $this->stock=htmlspecialchars(strip_tags($this->stock));
            $this->fecha_creacion=htmlspecialchars(strip_tags($this->fecha_creacion));
           
        
            // bind data
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":nombre_producto", $this->nombre_producto);
            $stmt->bindParam(":referencia", $this->referencia);
            $stmt->bindParam(":precio", $this->precio);
            $stmt->bindParam(":peso", $this->peso);
            $stmt->bindParam(":categoria", $this->categoria);
            $stmt->bindParam(":stock", $this->stock);
            $stmt->bindParam(":fecha_creacion", $this->fecha_creacion);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteProduct(){
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