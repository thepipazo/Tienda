<?php

include "../db.php";

$stock        = $_POST ['stock'];
$nombre       = $_POST ['l_nombre'];
$reseña       = $_POST ['reseña'];
$precio       = $_POST ['l_precio'];
$clave        = $_POST ['l_clave'];
$estado = 1;

//$categoria    = $_POST ['l_categoria'];
//$escritor     = $_POST ['l_escritor'];
$escritor = explode("|", $_POST['l_escritor']);
$autor = explode("|", $_POST['s_autor']);
$editorial = explode("|", $_POST['S_Editorial']);
$cats = explode("|", $_POST['l_categoria']);
$nombre_imagen=$_FILES ['imagen'] ['name'];
$ruta = "../product_images/" . $_FILES ['imagen'] ['name'];

if($con){
$query = OCIParse($con, "begin agregar_libro(:id_cat,:id_escritor,:libro_nombre,:libro_precio,:libro_descr,:libro_imagen,:libro_clave,:libro_stock,:libro_editorial,:libro_autor,:estado ,:mensaje); end;");
oci_bind_by_name($query, ':id_cat', $cats[0]);
oci_bind_by_name($query, ':id_escritor', $escritor[0]);
oci_bind_by_name($query, ':libro_nombre', $nombre);
oci_bind_by_name($query, ':libro_precio', $precio);
oci_bind_by_name($query, ':libro_descr', $reseña);
oci_bind_by_name($query, ":libro_imagen", $nombre_imagen);
oci_bind_by_name($query, ':libro_clave', $clave);
oci_bind_by_name($query, ':libro_stock', $stock);
oci_bind_by_name($query, ':libro_editorial', $editorial[0]);
oci_bind_by_name($query, ':libro_autor', $autor[0]);
oci_bind_by_name($query, ':estado', $estado);
oci_bind_by_name($query, ':mensaje', $mensaje,100);
$sp = @oci_execute($query);
oci_free_statement($query);
		//Se cierra la conexión
oci_close($con);
move_uploaded_file ($_FILES["imagen"]["tmp_name"], $ruta);

?>
<script> alert('<?php echo $mensaje ?>');
window.location='../vista/nuevo_libro.php';
</script> 

   <?php
}else{
    ?>
<script>
alert ('Error alconectar con la base de datos ');
window.location='../vista/nuevo_libro.php';
</script>
<?php
    
}

?>

