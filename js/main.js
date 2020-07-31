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


tipo_index();
tipo_admin();
tipos_deshabilitados();
tipo_cli();


autor_admin();
autor_cli();
autores_deshabilitados();

editorial_admin();
editorial_cli();
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

    $("body").delegate("#actualizar_libro", "click", function(event) {
        event.preventDefault();
        
        var nombre_libro = $("#l_nombre").val();
        var reseña_libro = $("#reseña").val();
        var escritor_libro = $("#l_escritor").val();
        var categoria_libro = $("#l_categoria").val();
        var editorial_libro = $("#S_Editorial").val();
        var autor_libro = $("#s_autor").val();
        var precio_libro = $("#l_precio").val();
        var stock_libro = $("#stock").val();
        var palabra_clave = $("#l_clave").val();
        var id_libro = $(this).attr("libro_id");
        
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { actualizar_libros: 0,nombre: nombre_libro, reseña: reseña_libro, escritor: escritor_libro,
            categoria: categoria_libro, editorial: editorial_libro, autor: autor_libro, precio: precio_libro, stok: stock_libro,
            palabra: palabra_clave, id: id_libro},
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
            data: { categorias_cli: 1 },
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

        $("body").delegate("#actualizar_cat", "click", function(event) {
            event.preventDefault();
            var descripcion_categoria = $("#cat_reseña").val();
            var nombre_nuevo_categoria = $("#cat_nombre").val();
            var id = $(this).attr("cat_id");
            
            $.ajax({
                url: "../controlador/accion.php",
                method: "POST",
                data: { actualizar_categoria: 0, id_cat: id, nombre_nuevo_categoria : nombre_nuevo_categoria, descripcion_categoria : descripcion_categoria  },
                success: function(data) {
                   
                    $("#msg_actualizado").html(data);
                    categorias_admin();
                }
            })
        })

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

    $("body").delegate(".categorias_cli", "click", function(event) {
        $("#get_product_cli").html("<h3>Cargando...</h3>");
        event.preventDefault();
        var cid = $(this).attr('cid');

        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { categoria_cli_seleccionada: 1, cat_id: cid },
            success: function(data) {
                $("#get_product_cli").html(data);
                if ($("body").width() < 480) {
                    $("body").scrollTop(683);
                }
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

function tipo_index(){
    $.ajax({
        url: "controlador/accion.php",
        method: "POST",
        data: { escritores: 1 },
        success: function(data) {
            $("#get_escritores").html(data);
        }
    })
}

$("body").delegate("#actualizar_tipo", "click", function(event) {
    event.preventDefault();
    var descripcion_nuevo_tipo = $("#tipo_desc").val();
    var nombre_nuevo_tipo = $("#tipo_nombre").val();
    var id = $(this).attr("tipo_id");
    
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { actualizar_tipo: 0, id: id, nombre_nuevo_tipo:nombre_nuevo_tipo,descripcion_nuevo_tipo:descripcion_nuevo_tipo  },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            escritores_admin();
        }
    })
})

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

function tipo_cli() {
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { tipo_cli: 1 },
        success: function(data) {
            $("#get_brand").html(data);
        }
    })
}

$("body").delegate(".tipo_cliente", "click", function(event) {
    $("#get_product_cli").html("<h3>Cargando...</h3>");
    event.preventDefault();
    var tipo_id = $(this).attr('tipo_id');

    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { tipo_cli_seleccionada: 1, tipo_id: tipo_id },
        success: function(data) {
            $("#get_product_cli").html(data);
            if ($("body").width() < 480) {
                $("body").scrollTop(683);
            }
        }
    })

})   

//-------------AUTORES---------------------------------------------
function autor_cli() {
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { autor_cli: 1 },
        success: function(data) {
            $("#autor_cli_msg").html(data);
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

$("body").delegate("#actualizar_autor", "click", function(event) {
    event.preventDefault();
    var descripcion_autor = $("#reseña_autor").val();
    var nombre_nuevo_autor = $("#autor_nombre").val();
    var id_autor = $(this).attr("autor_id");
    
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { actualizar_autor: 0, id_autor: id_autor, nombre_nuevo_autor : nombre_nuevo_autor, descripcion_autor : descripcion_autor  },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            autor_admin();
        }
    })
})


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

$("body").delegate(".autor_cliente", "click", function(event) {
    $("#get_product_cli").html("<h3>Cargando...</h3>");
    event.preventDefault();
    var autor_id = $(this).attr('autor_id');

    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { autor_cli_seleccionada: 1, autor_id: autor_id },
        success: function(data) {
            $("#get_product_cli").html(data);
            if ($("body").width() < 480) {
                $("body").scrollTop(683);
            }
        }
    })

}) 
//------------------------EDITORIALES--------------------------
function editorial_cli() {
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { editorial_cli: 1 },
        success: function(data) {
            $("#edit_cli_msg").html(data);
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

$("body").delegate("#actualizar_edit", "click", function(event) {
    event.preventDefault();
    var descripcion_editorial = $("#reseña_edit").val();
    var nombre_nuevo_editorial = $("#edit_nombre").val();
    var id_edit = $(this).attr("edit_id");
    
    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { actualizar_editorial: 0, id_edit: id_edit, nombre_nuevo_editorial : nombre_nuevo_editorial, descripcion_editorial : descripcion_editorial  },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            editorial_admin();
        }
    })
})

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

$("body").delegate(".editorial_cliente", "click", function(event) {
    $("#get_product_cli").html("<h3>Cargando...</h3>");
    event.preventDefault();
    var editorial_id = $(this).attr('editorial_id');

    $.ajax({
        url: "../controlador/accion.php",
        method: "POST",
        data: { editorial_cli_seleccionada: 1, editorial_id: editorial_id },
        success: function(data) {
            $("#get_product_cli").html(data);
            if ($("body").width() < 480) {
                $("body").scrollTop(683);
            }
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

$("#boton_buscar").click(function() {
    $("#get_product_cli").html("<h3>Cargando...</h3>");
    var buscador_cliente = $("#buscador_cliente").val();
    if (buscador_cliente != "") {
        $.ajax({
            url: "../controlador/accion.php",
            method: "POST",
            data: { buscador_cli: 1, buscador_cliente: buscador_cliente },
            success: function(data) {
                $("#get_product_cli").html(data);
                if ($("body").width() < 480) {
                    $("body").scrollTop(683);
                }
            }
        })
    }
})

})