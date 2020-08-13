<?php
include("../../menus/cliente.php");

?>

<p><br/></p>

<div class="col-md-12"> 
    <div class="row"> 
    <div class="col-md-3"></div>
    <div class="col-md-8"  > <h3 id="titulo_msg_pedidos"><strong>Mis Pedidos</strong></h3> </div>
    </div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-2">
            <input type="button"  id="mis_pedidos_boton" style="width:200px;" class="search-domain btn btn-primary px-5" value="Mis Pedidos">
            <br>
            <br>
            <input type="button"  id="misdevoluciones" style="width:200px;" class="search-domain btn btn-primary px-5" value="Mis Devoluciones">

            </div>
            <div class="col-md-7" id="pedidos_msg">

           
            </div>
            </div>

            
     
    </div>
</div>

</body>
</html>
<style>

.btn-check:focus+.btn,
.btn:focus {
    outline: 0;
    box-shadow: none
}</style>
