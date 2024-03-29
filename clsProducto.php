<?
include_once('clsConexion.php');
class Producto extends Conexion
{
	//atributos
	private $id_producto;
	private $descripcion;
	private $precio;
	private $id_categoria;
	
	//construtor
	public function Producto()
	{   parent::Conexion();
		$this->id_producto=0;
		$this->descripcion="";
		$this->id_categoria=0;		
	}

	//propiedades de acceso
	public function setIdProducto($valor)
	{
		$this->id_producto=$valor;
	}
	public function getIdProducto()
	{
		return $this->id_producto;
	}
	public function setDescripcion($valor)
	{
		$this->descripcion=$valor;
	}
	public function getDescripcion()
	{
		return $this->descripcion;
	}

	public function setPrecio($valor)
	{
		$this->precio=$valor;
	}
	public function getPrecio()
	{
		return $this->precio;
	}

	public function setIdCategoria($valor)
	{
		$this->id_categoria=$valor;
	}
	public function getIdCategoria()
	{
		return $this->id_categoria;
	}
	
	public function guardar()
	{
        $sql="insert into producto(descripcion,precio,id_categoria) values('$this->descripcion','$this->precio','$this->id_categoria')";
		
		if(parent::ejecutar($sql))
			return true;
		else
			return false;	
	}
	
	public function modificar()	{
	$sql="update producto set descripcion='$this->descripcion', precio='$this->precio',id_categoria='$this->id_categoria'
	where id_producto=$this->id_producto";		
		if(parent::ejecutar($sql))
			return true;
		else
			return false;	
	}
	
	public function eliminar()
	{
		$sql="delete from producto where id_producto=$this->id_producto";
		
		if(parent::ejecutar($sql))
			return true;
		else
			return false;	
	}
	
	public function buscar()
	{
		$sql="select id_producto,descripcion,precio,nombre from producto,categoria where categoria.id_categoria=producto.id_categoria";
		return parent::ejecutar($sql);
	}										
   //metodos utilizados para el comboBox
	public function buscarPorCodigo($criterio)
	{
		$sql="select id_producto,descripcion,precio,nombre from producto,categoria where categoria.id_categoria=producto.id_categoria and id_producto like '$criterio%'";
		return parent::ejecutar($sql);
	}								
	
	public function buscarPorDescripcion($criterio)
	{
		$sql="select id_producto,descripcion,precio,nombre from producto,categoria where categoria.id_categoria=producto.id_categoria and descripcion like '$criterio%'";
		return parent::ejecutar($sql);
	}
}    
?>