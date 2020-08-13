<?php
session_start();
include "../db.php";


if(isset($_POST["librosid"])){
    $respuesta = $_POST["radios"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $nventa = $_POST["nventa"];
    $nlibro = $_POST["librosid"];
    $user = $_SESSION["uid"];
    $pedido = $_POST["npedido"];

    
if ($respuesta==1){
    $respuesta= "no cumplio mis espectativas";
    
}
if ($respuesta==2){
    $respuesta= "no me gusto";
 
}
if ($respuesta==3){
    $respuesta= "cambie de opinion";
    
}
if ($respuesta==4){
    $respuesta= "presenta fallas de calidad";
    
}
if ($respuesta==5){
    $respuesta= $_POST["otro"];
    
}

$query = OCIParse($con, "begin DEVOLUCION(:ID_USUARIO2,:ID_LIBRO2,:MOTIVO2,:BOUCHER2,:ID_DETALLE2); end;");
oci_bind_by_name($query, ':ID_USUARIO2', $user);
oci_bind_by_name($query, ':ID_LIBRO2', $nlibro);
oci_bind_by_name($query, ':MOTIVO2', $respuesta);
oci_bind_by_name($query, ':BOUCHER2', $pedido);
oci_bind_by_name($query, ':ID_DETALLE2', $nventa);
$sp = @oci_execute($query);
if($sp){
    
    $query = OCIParse($con, "begin eliminar_venta(:IDVENTA2); end;");
oci_bind_by_name($query, ':IDVENTA2', $pedido);
$sp = @oci_execute($query);

if($sp){
    $sql = "select*from venta where iddetalle=$nventa";
$run_query = oci_parse($con,$sql);
$ok = oci_execute($run_query);

$row = oci_fetch_all($run_query,$result);
$num = oci_num_rows($run_query);

    if ($num == 0 ){
        $query = OCIParse($con, "begin eliminar_detalleventa(:IDDETALLE2); end;");
        oci_bind_by_name($query, ':IDDETALLE2', $nventa);
        $sp = @oci_execute($query);
    }


        if($ok == true){
            echo "<div class='alert alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <b>Libro devuelto con exito.!</b>
        </div>

        ";exit();

        }

}

}



}
?>