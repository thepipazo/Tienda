<?php
include("../../menus/admin.php");
?>
<p><br/></p>
	<p><br/></p>
	<p><br/></p>
<div class="container">
<div id="msg_ban_desban"></div>
        <div class="panel panel-primary" style="height: 500px;">
            <div class="panel-heading"> 
                <div class="row">
                            <div class=col-md-2><span>Clientes</span></div>
                        <label>Rut</label>
                        <input class="form-controls" onkeyup="filtro_cliente()" id="filtro_rut" style="color:black;" type="text" placeholder="19473669k">
               
                </div>
            </DIV>
       
                <div class="panel-body">
                    <div id="clientes_registrados_msg"></div>                  				
                        

                </div>
        </div>
</div>

<script>
function filtro_cliente(){
        var rut = document.getElementById("filtro_rut").value;
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { mostrar_clientes:0 ,rut:rut},
        success: function(data) {
            $("#clientes_registrados_msg").html(data);
        }
    })
}
</script>