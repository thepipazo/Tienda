<?php
include("../../menus/admin.php");

?>
<p><br/></p>
	<p><br/></p>
	<p><br/></p>

<div class="container"  class="col-md-12">
        <div class="row">
    
		    <div class="col-md-4">
			    <div class="panel panel-primary" style="height: 600px;" >
                        <div class="panel-heading">Libros Registrados
                        </div>
				    <div class="panel-body">
                        <div class="container"  style="width:100%;">	                   				
                            <div id="libros_ofertar_msg">

                            </div>
                        </div>                   
			        </div>
                </div>
            </div>

                <div class="col-md-8">
                    <div class="panel panel-primary">
                            <div class="panel-heading">Formulario Para Hacer Ofertas
                            </div>
                        <div class="panel-body">
                            <div class="container"  style="width:100%;">	 
                            <div class="row">

                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">PRECIO ACTUAL</label>
                                        <input type="text" class="form-control" id="precio_actual" disabled=true >
                                    </div>

                                    <div class="col-md-2" style="margin-top:20px; width: 60px; font-size: 40px;" >
                                        <span class="glyphicon glyphicon-minus">
                                    </div>                            


                                    <div class="form-group col-md-2">
                                        <label for="inputPassword4">DESCUENTO</label>
                                        <select class="form-control" id="lista_de_descuentos" disabled="true">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>
                                        </select>
                                    </div>
                        

                                    <div class="form-group col-md-2" style="font-size: 50px; margin-top: 8px;width: 66px;" >
                                        <span> <strong>=</strong></span> 
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">PRECIO OFERTA</label>
                                        <input type="text" id="nuevo_precio" class="form-control" id="" disabled="true" >
                                    </div>                                   
                            </div>

                            <div class="row">
                            <button class="btn btn-primary" id="agregar_oferta" value='' disabled="true">Agregar Oferta </button>
                            <button class="btn btn-danger" style="float:right">Cancelar </button>
                            </div>
                            </div>     
                            <div id="msg_poner_en_oferta"></div>              
                        </div>
                    </div>
         
                <div>
            </div>  
    </div>
</div>


<script>
window.addEventListener("load",function(){
    
        document.getElementById("lista_de_descuentos").addEventListener("change",function(){
            if(document.getElementById("lista_de_descuentos").value != 0){

            var descuento = document.getElementById("lista_de_descuentos").value;
            var actual = document.getElementById("precio_actual").value;
            var total_descuento = (actual*descuento)/100;
            var nuevo_precio = (actual-total_descuento);
            //var oferta = actual -
            
            $("#nuevo_precio").val(nuevo_precio);
            document.getElementById("agregar_oferta").disabled=false;

            }else{
                document.getElementById("agregar_oferta").disabled=true;
                $("#nuevo_precio").val("");
            }
        })
})

</script>
