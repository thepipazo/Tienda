$(document).ready(function() {
product();
cat();
escritor();
product_admin();
cat_admin()
autor_admin()
editorial_admin();

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



    function escritor(){
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




    function cat_admin() {
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { categoria_admin: 1 },
            success: function(data) {
                $("#cat_admin_msg").html(data);

            }
        })
    }


    function autor_admin() {
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { autor_admin: 1 },
            success: function(data) {
                $("#esc_admin_msg").html(data);
            }
        })
    }


    function editorial_admin() {
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { editorial_admin: 1 },
            success: function(data) {
                $("#edit_admin_msg").html(data);
            }
        })
    }


   

