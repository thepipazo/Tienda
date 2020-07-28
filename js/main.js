$(document).ready(function() {
product();
cat();
escritor();
product_admin();


})

 //misdevoluciones();
 function cat() {
    $.ajax({
        url: "controlador/accion.php",
        method: "POST",
        data: { categorias: 1 },
        success: function(data) {
            $("#get_category").html(data);
            }
        })
    }


    function product() {
        $.ajax({
            url: "controlador/accion.php",
            method: "POST",
            data: { getProduct: 1 },
            success: function(data) {
                $("#get_product").html(data);
            }
        })
    }



    function escritor()            {
        $.ajax({
            url: "controlador/accion.php",
            method: "POST",
            data: { escritores: 1 },
            success: function(data) {
                $("#get_escritores").html(data);
            }
        })
    }


    function product_admin() {
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { getProduct_admin: 1 },
            success: function(data) {
                $("#product_admin").html(data);
            }
        })
    }

