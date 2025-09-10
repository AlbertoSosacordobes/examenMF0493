<?php
 class Productos {
     private $id;
     private $nombre_producto;
     private $descripcion;
     private $precio;
     private $stock;
     private $imagen_url;
     private $categoria_id;
     private $bd;

     /*constructor*/
     public function __construct($nombre_producto, $descripcion, $precio, $stock, $imagen_url, $categoria_id, $bd, $id = null) {
         $this->id = $id;
         $this->nombre_producto = $nombre_producto;
         $this->descripcion = $descripcion;
         $this->precio = $precio;
         $this->stock = $stock;
         $this->imagen_url = $imagen_url;
         $this->categoria_id = $categoria_id;
         $this->bd = $bd;
     }

     // Método para guardar un nuevo producto en la base de datos
     public function guardar() {
        if (isset($this->id)) {
            // Actualizar producto existente
            $stmt = $this->bd->prepare("UPDATE productos SET nombre_producto = ?, descripcion = ?, precio = ?, stock = ?, imagen_url=?, categoria_id = ? WHERE id = ?");
            return $stmt->execute([$this->nombre_producto,$this->descripcion, $this->precio, $this->stock, $this->imagen_url,  $this->categoria_id, $this->id]);
        } else {
            // Insertar nuevo producto
            $stmt = $this->bd->prepare("INSERT INTO productos (nombre_producto, descripcion, precio, stock, imagen_url, categoria_id) VALUES (?, ?, ?, ?, ?, ?)");
             return $stmt->execute([$this->nombre_producto,$this->descripcion, $this->precio, $this->stock, $this->imagen_url,  $this->categoria_id, $this->id]);
        }
     }

     // Método estático para obtener todos los productos
     
     public static function getListaProductos($bd) {
         $stmt = $bd->query("SELECT * FROM productos");
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }

     //Metodo estatico para obtener el producto por su nombre
        public static function getProductoPorNombre($bd, $nombre_producto) {
            $stmt = $bd->prepare("SELECT * FROM productos WHERE nombre_producto = ?");
            $stmt->execute([$nombre_producto]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

     public function getId() {
         return $this->id;
     }

     public function getNombreProducto() {
         return $this->nombre_producto;
     }

     public function getPrecio() {
         return $this->precio;
     }
     public function getDescripcion() {
         return $this->descripcion;
     }
     public function getStock() {
         return $this->stock;
     }

     public function getCategoriaId() {
         return $this->categoria_id;
     }

     public function setNombreProducto($nombre_producto) {
         $this->nombre_producto = $nombre_producto;
     }

     public function setPrecio($precio) {
         $this->precio = $precio;
     }
     public function setDescripcion($descripcion) {
         $this->descripcion = $descripcion;
     }
     public function setStock($stock) {
         $this->stock = $stock;
     }  

     public function setCategoriaId($categoria_id) {
         $this->categoria_id = $categoria_id;
     }

     public function setId($id) {
         $this->id = $id;
     }
    }
  
?>