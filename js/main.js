$(document).ready(function() {
product();
product_admin();
product_cli();
libros_deshabilitados();

categorias();
categorias_cliente();
categorias_admin();
categorias_admin();
categorias_deshabilitados();


tipo();
tipo_admin();
tipos_deshabilitados();


autor_admin()
autores_deshabilitados();

editorial_admin();
editoriales_deshabilitados();



mispedidos();



function showModal() {
    $('#exampleModal').modal('show');
  }



//----------------LIBROS -----------------------------------------

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

    function product_cli() {
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { getProduct: 1 },
            success: function(data) {
                $("#get_product_cli").html(data);
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

    function libros_deshabilitados() {
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { libros_deshabilitados: 1 },
            success: function(data) {
                $("#libros_des_msg").html(data);

            }
        })
    }

    $("body").delegate("#habilitar_libros", "click", function(event) {
        event.preventDefault();
        var libro_id = $(this).attr('libro_id'); 
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { habilitar_libros: 1,libro_id:libro_id },
            success: function(data) {
                libros_deshabilitados();
                $("#msg_habilitado").html(data);
               
            }
        })
    })

    $("body").delegate("#editar_product", "click", function(event) {
        event.preventDefault();
        var p_id = $(this).attr('pid');
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { editar_product: 0, proId: p_id },
            success: function(data) {
                
                $("#modal").html(data);
                showModal();
            }
        })
    })

    $("body").delegate("#eliminar_libro", "click", function(event) {
        event.preventDefault();
        var libro_id = $(this).attr("libro_id");
        
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { eliminar_libro: 0, libro_id: libro_id },
            success: function(data) {
               
                $("#msg_actualizado").html(data);
                product_admin();
                
            }
        })
    })

    $("body").delegate("#before_eliminar_libro", "click", function(event) {
        event.preventDefault();
        var id_libro = $(this).attr("libro_id");
        
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { before_eliminar_libro: 0, id_libro: id_libro },
            success: function(data) {
               
                $("#msg_actualizado").html(data);
                
            }
        })
    })

    $("body").delegate("#deshabilitar_libro", "click", function(event) {
        event.preventDefault();
        var libro_id = $(this).attr("libro_id");
        
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { eliminar_libro: 1, libro_id: libro_id },
            success: function(data) {
               
                $("#msg_actualizado").html(data);
                product_admin();
                
            }
        })
    })

    $("body").delegate("#habilitar_libros", "click", function(event) {
        event.preventDefault();
        var libro_id = $(this).attr('libro_id'); 
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { habilitar_libros: 1,libro_id:libro_id },
            success: function(data) {
                libros_deshabilitados();
                $("#msg_habilitado").html(data);
               
            }
        })
    })


//----------------------CATEGORIAS------------------------------------

    function categorias_admin() {
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { categoria_admin: 1 },
            success: function(data) {
                $("#cat_admin_msg").html(data);

            }
        })
    }

    function categorias_cliente() {
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { categorias: 1 },
            success: function(data) {
                $("#get_cat").html(data);
    
            }
        })
    }

    function categorias_deshabilitados() {
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { categorias_deshabilitados: 1 },
            success: function(data) {
                $("#categorias_des_msg").html(data);
            }
        })
    }

    function categorias() {
        $.ajax({
            url: "controlador/accion.php",
            method: "POST",
            data: { categorias: 1 },
            success: function(data) {
                $("#get_categorias").html(data);
                }
            })
        }

        $("body").delegate("#habilitar_categorias", "click", function(event) {
            event.preventDefault();
            var categoria_id = $(this).attr('categoria_id'); 
            $.ajax({
                url: "../controlador/accion.php",
                method: "POST",
                data: { habilitar_categorias: 1,categoria_id:categoria_id },
                success: function(data) {
                    categorias_deshabilitados();
                    $("#msg_habilitado").html(data);
                   
                }
            })
        })

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

    $("body").delegate("#editar_categoria", "click", function(event) {
        event.preventDefault();
        var c_id = $(this).attr('cat_id');
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { editar_categoria: 0, c_id: c_id },
            success: function(data) {
                
                $("#modal").html(data);
                showModal();
            }
        })
    })

    $("body").delegate("#before_eliminar_categoria", "click", function(event) {
        event.preventDefault();
        var cat_id = $(this).attr("cat_id");
        
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { before_eliminar_categoria: 0, cat_id: cat_id },
            success: function(data) {
               
                $("#msg_actualizado").html(data);
                
            }
        })
    })

    $("body").delegate("#eliminar_categoria", "click", function(event) {
        event.preventDefault();
        var categoria_id = $(this).attr("categoria_id");
       
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { eliminar_categoria: 0, categoria_id: categoria_id},
            success: function(data) {
               
                $("#msg_actualizado").html(data);
                categorias_admin();
                
            }
        })
    })

    $("body").delegate("#deshabilitar_categoria", "click", function(event) {
        event.preventDefault();
        var categoria_id = $(this).attr("categoria_id");
        
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { eliminar_categoria: 1, categoria_id: categoria_id },
            success: function(data) {
               
                $("#msg_actualizado").html(data);
                categorias_admin();
                
            }
        })
    })

    
    

//-----------------TIPOS DE LIBROS---------------------------------------------

function tipo_admin() {
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { escritor_Admin: 1 },
        success: function(data) {
            $("#esc_admin_msg").html(data);
        }
    })
}

function tipos_deshabilitados() {
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { tipos_deshabilitados: 1 },
        success: function(data) {
            $("#tipo_des_msg").html(data);
        }
    })
}

function tipo(){
    $.ajax({
        url: "controlador/accion.php",
        method: "POST",
        data: { escritores: 1 },
        success: function(data) {
            $("#get_escritores").html(data);
        }
    })
}

$("body").delegate("#habilitar_tipos", "click", function(event) {
    event.preventDefault();
    var tipo_id = $(this).attr('tipo_id'); 
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { habilitar_tipos: 1,tipo_id:tipo_id },
        success: function(data) {
            tipos_deshabilitados();
            $("#msg_habilitado").html(data);
           
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

$("body").delegate("#editar_tipo", "click", function(event) {
    event.preventDefault();
    var tipo_id = $(this).attr('tipo_id');
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { editar_tipo: 0, tipo_id: tipo_id },
        success: function(data) {
            
            $("#modal").html(data);
            showModal();
        }
    })
})

$("body").delegate("#before_eliminar_tipo", "click", function(event) {
    event.preventDefault();
    var tipo_id = $(this).attr("tipo_id");
    
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { before_eliminar_tipo: 0, tipo_id: tipo_id },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            
        }
    })
})

$("body").delegate("#eliminar_tipo", "click", function(event) {
    event.preventDefault();
    var tipo_id = $(this).attr("tipo_id");
    
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { eliminar_tipo: 0, tipo_id: tipo_id },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            escritores_admin();
            
        }
    })
})

$("body").delegate("#deshabilitar_tipo", "click", function(event) {
    event.preventDefault();
    var tipo_id = $(this).attr("tipo_id");
    
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { eliminar_tipo: 1, tipo_id: tipo_id },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            escritores_admin();
            
        }
    })
})


//-------------AUTORES---------------------------------------------

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

function autores_deshabilitados() {
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { autor_deshabilitadoss: 1 },
        success: function(data) {
            $("#autor_des_msg").html(data);
        }
    })
}

$("body").delegate("#habilitar_autores", "click", function(event) {
    event.preventDefault();
    var autor_id = $(this).attr('autor_id'); 
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { habilitar_autores: 1,autor_id:autor_id },
        success: function(data) {
            autores_deshabilitados();
            $("#msg_habilitado").html(data);
           
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

$("body").delegate("#before_eliminar_autor", "click", function(event) {
    event.preventDefault();
    var autor_id = $(this).attr("autor_id");    
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { before_eliminar_autor: 0, autor_id: autor_id },
        success: function(data) {           
            $("#msg_actualizado").html(data);
            
        }
    })
})

$("body").delegate("#eliminar_autor", "click", function(event) {
    event.preventDefault();
    var autor_id = $(this).attr("autor_id");
    
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { eliminar_autor: 0, autor_id: autor_id },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            autor_admin();
            
        }
    })
})



$("body").delegate("#deshabilitar_autor", "click", function(event) {
    event.preventDefault();
    var autor_id = $(this).attr("autor_id");
    
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { eliminar_autor: 1, autor_id: autor_id },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            autor_admin();
            
        }
    })
})

//------------------------EDITORIALES--------------------------

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

function editoriales_deshabilitados() {
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { editoriales_deshabilitados: 1 },
        success: function(data) {
            $("#editoriales_des_msg").html(data);
        }
    })
}

$("body").delegate("#habilitar_editoriales", "click", function(event) {
    event.preventDefault();
    var editorial_id = $(this).attr('editorial_id'); 
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { habilitar_editoriales: 1,editorial_id:editorial_id },
        success: function(data) {
           editoriales_deshabilitados();
            $("#msg_habilitado").html(data);
           
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

$("body").delegate("#editar_editorial", "click", function(event) {
    event.preventDefault();
    var editorial_id = $(this).attr('edit_id');
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { editar_editorial: 0, editorial_id: editorial_id },
        success: function(data) {
            
            $("#modal").html(data);
            showModal();
        }
    })
})

$("body").delegate("#before_eliminar_editorial", "click", function(event) {
    event.preventDefault();
    var editorial_id = $(this).attr("edit_id");
    
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { before_eliminar_editorial: 0, editorial_id: editorial_id },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            
        }
    })
})

$("body").delegate("#eliminar_editorial", "click", function(event) {
    event.preventDefault();
    var editorial_id = $(this).attr("editorial_id");
    
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { eliminar_editorial: 0, editorial_id: editorial_id },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            editorial_admin();
            
        }
    })
})

$("body").delegate("#deshabilitar_editorial", "click", function(event) {
    event.preventDefault();
    var editorial_id = $(this).attr("editorial_id");
    
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { eliminar_editorial: 1, editorial_id: editorial_id },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            editorial_admin();
            
        }
    })
})

//-----------------LOGEAR-------------------------------------------------------

$("#logear").click(function(event) {
    event.preventDefault();
    var email = $("#email").val();
    var pass = $("#password").val();
    $.ajax({
        url: "controlador/login.php",
        method: "POST",
        data: { userLogin: 1, userEmail: email, userPassword: pass },
        success: function(data) {
            if (data == 0) {

                location.href = "Vista/perfil_usuario.php";
                //header("location:perfil_usuario.php");

            }
            if (data == 1) {
                location.href = "Vista/perfil_admin.php";
            }
            if (data == 2) {
                $("#e_msg").html('<div class="alert alert-danger">	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b> El usuario o contraseña no es !correcta¡..!</b>	</div>');
            }
        }
    })
})
//-------------------------------------------------------------------------

function mispedidos() {
    $.ajax({
        url: "../Vista/mis_pedidos.php",
        method: "POST",
        data: { pedido: 1 },
        success: function(data) {
            $("#pedidos_msg").html(data);
        }
    })
}


$("#misdevoluciones").click(function(event) {
    event.preventDefault();
    var codigo = $("#code").val();
    $.ajax({
        url: "../controlador/mis_devoluciones_php.php",
        method: "POST",
        data: { devolucion: 1 },
        success: function(data) {
            $("#pedidos_msg").html(data);
            
        }
    })

})


})