<?php
session_start();
if(isset($_SESSION["uid"]) and $_SESSION['tipo_user'] == 0){
	header("location:vista/cliente/perfil_usuario.php");
}elseif(isset($_SESSION["uid"]) and $_SESSION['tipo_user'] == 1 ){
	header("location:vista/admin/perfil_admin.php");
}

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CoronaLibros</title>
        <link href="css/mystile.css" rel="stylesheet">

        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
        <script type="text/javascript" src=""></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>    
    </head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Topbar Search -->
                <image type='image' src='product_images/logo.png'  style='border-radius:25px; width:50px; float:left; height:50px; margin-left:25px'></image>
        <li class="nav-item dropdown no-arrow"> <a style="color:#d1d3e2; font-size: 26px;" href="index.php" class="nav-link">CoronaLibros</a></li>
            
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group"> <input type="text" id="buscador_cliente" class="form-control bg-light border-0 small" placeholder="Buscar Por....">
            <div class="input-group-append"> <button class="btn btn-primary" id="boton_buscar" type="button"> <i class="fa fa-search fa-sm"></i> </button> </div>
             </div>
        </form>
            <ul class="navbar-nav ml-auto">               
                
                
               
                <li class="nav-item dropdown no-arrow"> <a href="registro.php" class="nav-link">Registrar</a>
                <li class="nav-item dropdown no-arrow"> <a  class="nav-link dropdown-toggle" role="button"id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">iniciar sesion</a>

               
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown"> 

                        
                <div class="card mx-5 my-5" style="width:550px;" ></i>
                    <div class="card-body py-2 px-2" class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <h2 class="card-heading py-3 px-5">Inicio De Sesion</h2>
                                <div class="row rone mx-3 my-3">
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="email" class="sr-only">Correo</label>
                                            <input type="email" class="form-control" id="email" placeholder="Correo">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group"><label for="password" class="sr-only">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="contraseña">
                                        </div>
                                    </div>
                                </div>
                            <div class="row rtwo mx-3">
                                    <div class="col-md-6">
                                        <div class="form-group"><button type="buton" id="logear" name="logear" class="btn btn-primary mb-2">Iniciar Sesion</button>
                                        </div>
                                    </div>
                            </div>
                   
                    </div>
                </div>              
            </ul>

    </nav>







