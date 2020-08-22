
<?php session_start(); 
if(!isset($_SESSION["uid"]) or $_SESSION['tipo_user'] == 1 ){
	header("location:../../index.php");
}?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CoronaLibros</title>
        <link href="../../css/mystile.css" rel="stylesheet">

        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
        <script type="text/javascript" src=""></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script type="text/javascript" src="../../js/main.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>    
    </head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Topbar Search -->
                <image type='image' src='../../product_images/logo.png'  style='border-radius:25px; width:50px; float:left; height:50px; margin-left:25px'></image>
        <li class="nav-item dropdown no-arrow"> <a style="color:#d1d3e2; font-size: 26px;" href="../../index.php" class="nav-link">CoronaLibros</a></li>
            
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group"> <input type="text" id="buscador_cliente" class="form-control bg-light border-0 small" placeholder="Buscar Por....">
            <div class="input-group-append"> <button class="btn btn-primary" id="boton_buscar" type="button"> <i class="fa fa-search fa-sm"></i> </button> </div>
             </div>
        </form>
            <ul class="navbar-nav ml-auto">
                
                <li class="nav-item dropdown no-arrow mx-1"><a href="carro.php" class="nav-link"> <i class="fa fa-cart-arrow-down"></i>  Carro </a> </li>
                
                <div class="topbar-divider d-none d-sm-block"></div>
               
                <li class="nav-item dropdown no-arrow"> <a  href="mis_pedidos.php"  class="nav-link"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <?php echo "Mis Pedidos";?></a>
                <li class="nav-item dropdown no-arrow"> <a  class="nav-link dropdown-toggle" role="button"id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i><?php echo " Bienvenido, ".$_SESSION["name"]; ?></a>

               
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown"> 
                <a class="dropdown-item" href="mi_perfil.php"><i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i> My perfil </a>
                <div class="dropdown-divider"></div> 
                <a class="dropdown-item" href="../../controlador/logout.php" > Salir </a>
            </div>
                        
                  
                </div>              
            </ul>

    </nav>
