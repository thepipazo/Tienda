<?php 
include('../../menus/cliente.php');
?>

                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
                            <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                            

                            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
                            <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                            
                         
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>

                            <div class="viewed">
   <div class="container">
       <div class="row">
           <div class="col" style="border-bottom:solid #dadada 2px">
               <div class="bbb_viewed_title_container">
                   <h3 class="bbb_viewed_title">Ofertas</h3>
                   <div class="bbb_viewed_nav_container">
                       <div class="bbb_viewed_nav bbb_viewed_prev"><i class="fa fa-arrow-left" aria-hidden="true"></i> <i>Anterior</i></div>
                       <div class="bbb_viewed_nav bbb_viewed_next"> <i>Siguiente</i> <i class="fa fa-arrow-right" aria-hidden="true"></i></div>
                   </div>
               </div>

               <div id="carrusel_de_ofertas1"></div>


                    </div>
              
                           
                   
               
       </div>
   </div>
</div>
    

<div style="width:100%; height:50px; text-align:center; background-color:white; margin-top: -58px; margin-bottom: 15px;">



            <div class="dropdown dropdown2" style="width:150px;">
                     <button class="dropbtn">Categorias</button>
                <div class="dropdown-content" id="get_categorias_cli">                                    
                </div>
            </div>
            <div class="dropdown dropdown2" style="width:150px;">
                     <button class="dropbtn">Autores</button>
                <div class="dropdown-content" id="get_autores_cli">
                     <a href="javascript:void(0)">Link 1</a>
                    
                </div>
            </div>
            <div class="dropdown dropdown2" style="width:150px;">
                     <button class="dropbtn">Editoriales</button>
                <div class="dropdown-content" id="get_editoriales_cli">
                     <a>Link 1</a>
                
                </div>
            </div>
            <div class="dropdown dropdown2" style="width:150px;">
                     <button class="dropbtn">Tipos De Libros</button>
                <div class="dropdown-content" id="get_tipos_cli">
                     <a href="javascript:void(0)">Link 1</a>
                     
                </div>
            </div>



</div>

<div id="carrusel_de_ofertas1"></div>


<div id="msg_agregar_al_carro"></div>
                     

                                 <div class="container" style="width:fit-content;" >
                                    <div class="row col-md-12" id="get_product_cli" style="width: 900px; margin-left: 100px;">
                                    
                                    </div>
                                </div>
                         
                               
                  
                   

                           <!-- aqui van los productos-->  
                    
                   <div class="foter">

                   </div>
         
          
                <div id="modal2">
                asdjas
                </div>
    </body>
</html>


<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {
    const cartButtons = document.querySelectorAll('.cart-button');
    cartButtons.forEach(button => {
    button.addEventListener('click',cartClick);
    });
    function cartClick(){
    let button =this;
    button.classList.add('clicked');
    }});</script>

<script type="text/javascript">$(document).ready(function()
{

if($('.bbb_viewed_slider').length)
{
var viewedSlider = $('.bbb_viewed_slider');

viewedSlider.owlCarousel(
{
loop:true,
margin:30,
autoplay:true,
autoplayTimeout:6000,
nav:false,
dots:false,
responsive:
{
0:{items:1},
575:{items:2},
768:{items:3},
991:{items:4},
1199:{items:6}
}
});

if($('.bbb_viewed_prev').length)
{
var prev = $('.bbb_viewed_prev');
prev.on('click', function()
{
viewedSlider.trigger('prev.owl.carousel');
});
}

if($('.bbb_viewed_next').length)
{
var next = $('.bbb_viewed_next');
next.on('click', function()
{
viewedSlider.trigger('next.owl.carousel');
});
}
}


});</script>

