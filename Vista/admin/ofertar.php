<?php
include("../../menus/admin.php");

?>
<p><br/></p>
	<p><br/></p>
	<p><br/></p>

<div class=""  class="col-md-12">
        <div class="row">
    
		    <div class="col-md-3">
			    <div class="panel panel-primary" style="height: 600px;" >
                        <div class="panel-heading">Libros Sin Oferta
                        </div>
				    <div class="panel-body">
                        <div class="container"  style="width:100%;">	                   				
                            <div id="libros_ofertar_msg">

                            </div>
                        </div>                   
			        </div>
                </div>
            </div>

                <div class="col-md-6">
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
                            <button class="btn btn-danger" onclick="cancelar()" style="float:right" id="cancelar" disabled="true">Cancelar </button>
                            </div>
                            </div>    
                        </div>
                        <div style="width: 400px;margin-left: 24%;" id="msg_poner_en_oferta"></div>              

                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">Quitar De Oferta</div>
                        <div class="panel-body">
                            <div class="container"  style="width:100%;">	 
                                <div class="row">

                                     <div class="form-group col-md-3">
                                        <label for="inputEmail4">Precio  Oferta</label>
                                        <input type="text" class="form-control" id="precio_sin_oferta" disabled=true >
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button value=""  id="quitar_oferta" disabled="true" style="margin-left: 98px;width: 91px;margin-top: 25px;" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span></button>

                                    </div>

                                    <div class="form-group col-md-3" style="float:right">
                                        <label for="inputEmail4">Precio Normal</label>
                                        <input type="text"  class="form-control" id="oferta_precio" disabled=true >
                                    </div>
                                </div>
                                <div id="libros_ofertad_msg"></div>

                            </div>

                        </div>
                    </div>




                </div>
             

                        <div class="col-md-3">
                            <div class="panel panel-primary" style="height: 600px;" >
                                            <div class="panel-heading">Libros Con Oferta
                                            </div>
                                <div class="panel-body">
                                    <div class="container"  style="width:100%;">	                   				
                                        <div id="libros_ofertado_msg">

                                        </div>
                                    </div>                   
                                </div>
                            </div>
                        </div>
                
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


function cancelar() {
    document.getElementById("nuevo_precio").value="";
    document.getElementById("lista_de_descuentos").value="";
    document.getElementById("precio_actual").value="";
    document.getElementById("nuevo_precio").disabled=true;
    document.getElementById("lista_de_descuentos").disabled=true;
    document.getElementById("precio_actual").disabled=true;

    
}

</script>
