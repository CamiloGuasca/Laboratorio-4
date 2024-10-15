<?php
class ProductoDAO{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precioCompra;
    private $precioVenta;
    private $idMarca;
    private $idCategoria;
    private $idAdministrador;
    public function __construct($idProducto=0, $nombre="", $cantidad=0, $precioCompra=0, $precioVenta=0, $idMarca = null, $idCategoria = null, $idAdministrador = null){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precioCompra = $precioCompra;
        $this -> precioVenta = $precioVenta;
        $this -> idMarca = $idMarca;
        $this -> idCategoria = $idCategoria;
        $this -> idAdministrador = $idAdministrador;
    }
    
    public function consultarTodos(){
        return "select idProducto, nombre, cantidad, precioCompra, precioVenta, Marca_idMarca 
                from Producto";
    }

    public function registrar(){
        return "insert into producto (idProducto, nombre, cantidad, precioCompra, precioVenta, Marca_idMarca, Categoria_idCategoria, Administrador_idAdministrador)
                values (".$this->idProducto.",'".$this->nombre."',".$this->cantidad.",".$this->precioCompra.",".$this->precioVenta.",".$this->idMarca.",".$this->idCategoria.",".$this->idAdministrador.")";
    }
    
    
}

?>