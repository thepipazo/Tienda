$(document).ready(function() {
product();
cat();
escritor();
product_admin();
cat_admin()
autor_admin()
editorial_admin();
escritores_admin();



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


    function product(){
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
                $("#autor_admin_msg").html(data);
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


    function escritores_admin() {
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { escritor_Admin: 1 },
            success: function(data) {
                $("#esc_admin_msg").html(data);
            }
        })
    }


    $("#ingreso_cat").click(function(event) {
        event.preventDefault();
        var nombrecat = $("#catnombre").val();
        var descripcioncat = $("#catdescripcion").val();
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { ingresar_categoria: nombrecat, cat_descripcion: descripcioncat },
            success: function(data) {
                $("#cat_msg").html(data);
            }
        })

    })






$("#ingreso_tipo").click(function(event) {
    event.preventDefault();
    var nombreescritor = $("#nombre_tipo").val();
    var descripcion = $("#descripcion_tipo").val();
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: {ingresotipo:1, escritornombre: nombreescritor,descripcion:descripcion },
        success: function(data) {
            $("#escrit_msg").html(data);
        }
    })

})




$("#ingreso_autor").click(function() {
    var nombre = $("#nombre_autor").val();
    var descripcion = $("#reseña_autor").val();
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { ingreso_autor: 1, nombre: nombre, descripcion:descripcion },
            success: function(data) {
                $("#aut_msg").html(data);
                
            }
        })
})



$("#ingreso_edit").click(function() {
    var nombre = $("#nombre_editorial").val();
    var descripcion = $("#descripcionedit").val();

        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { ingreso_editorial: 1, nombre: nombre, descripcion:descripcion },
            success: function(data) {
                $("#edit_msg").html(data);
                
            }
        })
})


function showModal() {
    $('#exampleModal').modal('show');
  }

$("body").delegate("#editar_autor", "click", function(event) {
    event.preventDefault();
    var autor_id = $(this).attr('autor_id');
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { editar_autor: 0, autor_id: autor_id },
        success: function(data) {
            
            $("#modal").html(data);
            showModal();
        }
    })
})




})