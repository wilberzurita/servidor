<?
ob_start();
session_start();
?>
<?
include_once('clsCategoria.php');
include_once('clsProducto.php');
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script> 
var miPopup 
function abreBuscarCategoria(){ 
    miPopup = window.open("frmBuscarCategoria.php","miwin","width=410,height=350,scrollbars=yes")
     miPopup.focus() 
} 
</script> 
</head>

<body>

<?php
include_once('clsProducto.php');
include_once('clsCategoria.php');
?>

<center>
<b> REGISTRO DE PRODUCTOS  </b>
<form id="form1" name="form1" method="post" action="frmProducto.php">
  <table width="400" border="1">
    <tr>
      <td width="80"> </td>
      <td width="225">	 	  
        <input name="txtIdProducto" type="hidden"  value="<? echo $_GET['pid_producto']; ?>" id="txtIdProducto" />
      </td>
    </tr>
    <tr>
      <td width="80">Descripcion</td>
      <td width="225">	 	  
        <input name="txtDescripcion" type="text"  value="<? echo $_GET['pdescripcion']; ?>" id="txtDescripcion" />
      </td>
    </tr>
    
	<tr>
      <td width="80">Precio</td>
      <td width="225">	  	  
        <input name="txtPrecio" type="text" value="<? echo $_GET['pprecio']; ?>" id="txtPrecio" />
      </td>
    </tr>
	
	<tr>
      <td width="80">Categoria</td>
      <td width="225">	  	          
     <input name="txtNombreCat" type="text" value="<? //if ($_GET['pcategoria']) echo $_GET['pcategoria']; else  
	 echo $_SESSION["nombre_cat"]; ?>" id="txtNombreCat" />
	 <a href="#" onClick="abreBuscarCategoria()">Buscar</a>	
	<input name="txtIdCategoria" type="hidden" readonly="true" size="3" value="<? echo $_SESSION["id_categoria"]; ?>" id="txtIdCategoria" />
     </td>
	</tr>
		 
	<tr>
      <td colspan="2">
      <input type="submit" name="botones"  value="Nuevo" />
      <input type="submit" name="botones"  value="Guardar" />
      <input type="submit" name="botones"  value="Modificar" />
      <input type="submit" name="botones"  value="Eliminar" />
      <input type="submit" name="botones"  id="botones" value="Buscar"/>
     </td>
    </tr>
  
   <tr>
	<!-- busqueda por codigo y nombre -->
	<td colspan="2">
        Buscar por       
        <input name="grupo" type="radio"  value="1" checked="checked" <? if ($_POST[grupo]=="1") echo "checked"; ?> />
        Codigo
          <input type="radio" name="grupo" value="2" <? if ($_POST[grupo]=="2") echo "checked"; ?> />
        Nombre
          <input name="txtBuscar" type="text" id="txtBuscar" value="<? echo $valor; ?>" size="33"/>   
        </td>
    </tr>
  </table>
</form>
</center>
<?php

function guardar()
{
	if($_POST['txtDescripcion'] )
	{
		$obj= new Producto();
		$obj->setDescripcion($_POST['txtDescripcion']);
		$obj->setPrecio($_POST['txtPrecio']);
		$obj->setIdCategoria($_POST['txtIdCategoria']);		
		if ($obj->guardar())
			echo "Producto Guardado..!!!";
		else
			echo "Error al guardar el Producto";
	}
	else
		echo "La descripcion del producto es obligatoria..!!!";
}	

function modificar()
{
	if($_POST['txtIdProducto'])
	{
		$obj= new Producto();
		$obj->setIdProducto($_POST['txtIdProducto']);
		$obj->setDescripcion($_POST['txtDescripcion']);
		$obj->setPrecio($_POST['txtPrecio']);
		$obj->setIdCategoria($_POST['txtIdCategoria']);		
		if ($obj->modificar())
			echo "Producto modificado..!!!";
		else
			echo "Error al modificar el Producto..!!!";		
	}
	else
		echo "El Codigo del producto es obligatorio...!!!";
}

function eliminar()
{
	if($_POST['txtIdProducto'])
	{
		$obj= new Producto();
		$obj->setIdProducto($_POST['txtIdProducto']);		
		if ($obj->eliminar())
			echo "Producto eliminado...!!!";
		else
			echo "Error al eliminar el Producto";		
	}
	else	
		echo "para eliminar el producto, debe tener el id del producto..!!!";	
}

function buscar()
{  
   $obj= new Producto();	
   switch ($_POST[grupo]) {
   case 1:{
           $resultado=$obj->buscarPorCodigo($_POST['txtBuscar']);
           mostrarRegistros($resultado);	
	 		
   	  }; break;
   case 2: 
          {
	   $resultado=$obj->buscarPorDescripcion($_POST['txtBuscar']);
     	   mostrarRegistros($resultado);	
 	  }; break;
   }	
}

 function mostrarRegistros($registros)
 {
	echo "<table border='1' align='center'>";
	echo "<tr><td>IdProducto</td>";
	echo "<td>Descripcion</td>";
    echo "<td>Precio</td>";		 
    //echo "<td>Categoria</td>"; Si quiero mostrar el nombre de la categoria		 	
	echo "<td><center>*</center></td></tr>";
	while($fila=mysqli_fetch_object($registros))
	{
		echo "<tr>";
		echo "<td>$fila->id_producto</td>";
		echo "<td>$fila->descripcion</td>";
		echo "<td>$fila->precio</td>";
		//echo "<td>$fila->nombre</td>";
		echo "<td><a href='frmProducto.php? pid_producto=$fila->id_producto&pdescripcion=$fila->descripcion&pprecio=$fila->precio&pcategoria=$fila->nombre'> [Editar] </a> </td>";
		echo "</tr>";
	}
	echo "</table>";
 }   

//programa principal
  switch($_POST['botones'])
  {
	case "Nuevo":{
	}break;

	case "Guardar":{
    guardar();
	}break;

	case "Modificar":{
    modificar();
	}break;

	case "Eliminar":{
     eliminar();
	}break;

	case "Buscar":{
     buscar();
	}break;
  }
?>  

</body>
</html>
