<?php
include('menus/index.php');
?>


              <div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
          
            
                <h2><strong>Registre su cuenta de usuario</strong></h2>
                <p>Rellene todos los campos del formulario para ir al siguiente paso</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar" style="padding-right: 35px;">
                                <li class="active" id="account"><strong>Cuenta</strong></li>
                                <li id="personal"><strong>Datos Personales</strong></li>
                                <li id="payment"><strong>Modo De Pago</strong></li>
                                <li id="confirm"><strong>Finalizar</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset>
                           
                                <div class="form-card">
                                    <h2 class="fs-title">Informacion De La Cuenta</h2> 
                                    <input type="email" id="email2" name="email2" placeholder="Correo" >
                                      <input type="password" id="password2"name="password2" placeholder="Password">
                                       <input type="password" id="reg_repassword" name="reg_repassword" placeholder="Confirmar Password">
                                </div>
                                 <input type="button" id="cuenta" name="cuenta"  class="next action-button" value="Siguente Paso">
                          
                            </fieldset>
                           <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Informacion Personal</h2> 
                                    <input type="text" id="reg_rut" name="reg_rut" placeholder="Rut">
                                    <input type="text" id="reg_nombre" name="reg_nombre" placeholder="Nombres">
                                     <input type="text" id="reg_apellido" name="reg_apellido" placeholder="Apellidos">
                                      <input type="text" id="reg_telefono" name="reg_telefono" placeholder="Telefono">
                                       <input type="text" id="reg_direccion" name="reg_direccion" placeholder="Direccion">
                                </div> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Paso Anterior"> 
                                <input type="button" name="next" class="next action-button" value="Siguiete paso">
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Informacion Del Modo De Pago</h2>
                                    <div class="radio-group">
                                        <div class="radio" data-value="credit"><img src="https://i.imgur.com/XzOzVHZ.jpg" width="200px" height="100px"></div>
                                        <div class="radio" data-value="paypal"><img src="https://i.imgur.com/jXjwZlj.jpg" width="200px" height="100px"></div> <br>
                                    </div> <label class="pay">Nombre del titular de la tarjeta*</label>
                                     <input type="text" name="holdername" placeholder="">
                                    <div class="row">
                                        <div class="col-4"> <label class="pay">Numero de targeta*</label>
                                         <input type="text" name="cardno" placeholder=""> </div>

                                        <div class="col-3"> <label class="pay">CVV*</label>
                                         <input type="password" name="cvcpwd" placeholder="***"> </div>
                                
                                  
                                        <div class="col-3"> <label class="pay" style="width:300px">Fecha de expiracion*</label> 
                                        <input type="text"  style="width:40px"><label for="">/</label>
                                        <input type="text"   style="width:40px">
                                        </div>
                                            
                                    </div>
                                </div> <input type="button" name="previous" class="previous action-button-previous" value="Atras"> 
                                <input type="button" id="autoregistro_cli" name="autoregistro_cli" class="next action-button" value="Confirmar">
                            </fieldset>
                            <fieldset>
                            <div id="autoregistro_msgz"> 

                            </div>

                            <input type='button'  id="jajas" name='jajas' class='previous action-button-previous' value='Atras'></button>
                            <input type="button" id="logear_de_registro" name="logear_de_registro" class="next action-button" value="Iniciar Sesion">

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
                                <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                                <script type="text/javascript">$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 600
});
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 600
});
});

$('.radio-group .radio').click(function(){
$(this).parent().find('.radio').removeClass('selected');
$(this).addClass('selected');
});

$(".submit").click(function(){
return false;
})

});</script>

