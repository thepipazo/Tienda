$(document).ready(function() {
product();
carrusel_usuario();
carrusel_index();
product_admin();
product_cli();
libros_a_ofertar();
libros_deshabilitados();

categorias_admin();
categorias_index();
categorias_cliente();
categorias_deshabilitados();


tipo_index();
tipo_admin();
tipos_deshabilitados();
tipo_cli();

autor_index();
autor_admin();
autor_cli();
autores_deshabilitados();

editorial_admin();
editorial_index();
editorial_cli();
editoriales_deshabilitados();



mispedidos();
clientes_admin()
carro_de_compras();

function showModal() {
    $('#exampleModal').modal('show');
  }

  function showModal2() {
    $('#exampleModal2').modal('show');
  }

  function showModal3() {
    $('#exampleModal3').modal('show');
  }


//----------------LIBROS -----------------------------------------

    function product(){
        var urlp_index = "product_images";
        $.ajax({
            url: "controlador/accion.php",
            method: "POST",
            data: { getProduct: 1 ,urlp_cli:urlp_index},
            success: function(data) {
                $("#get_product").html(data);
            }
        })
    }

    function product_cli() {
        var urlp_cli = "../../product_images";
        $.ajax({
            url: "../../controlador/accion.php",
            method: "POST",
            data: { getProduct: 1, urlp_cli:urlp_cli},
            success: function(data) {
                $("#get_product_cli").html(data);
            }
        })
    }    
 
    function product_admin() {
        $.ajax({
            url: "../../controlador/accion.php",
            method: "POST",
            data: { getProduct_admin: 1 },
            success: function(data) {
                $("#product_admin").html(data);
            }
        })
    }

    function libros_deshabilitados() {
        $.ajax({
            url: "../../controlador/accion.php",
            method: "POST",
            data: { libros_deshabilitados: 1 },
            success: function(data) {
                $("#libros_des_msg").html(data);

            }
        })
    }

    function libros_a_ofertar() {
        $.ajax({
            url: "../../controlador/accion.php",
            method: "POST",
            data: { listar_libros_para_ofertar: 1 },
            success: function(data) {
                $("#libros_ofertar_msg").html(data);

            }
        })
    }
     libros_ofertados()
    function libros_ofertados() {
        $.ajax({
            url: "../../controlador/accion.php",
            method: "POST",
            data: { listar_libros_para_ofertar: 2 },
            success: function(data) {
                $("#libros_ofertado_msg").html(data);

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
            url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
            method: "POST",
            data: { categoria_admin: 1 },
            success: function(data) {
                $("#cat_admin_msg").html(data);

            }
        })
    }

    function categorias_cliente() {       
        $.ajax({
            url: "../../controlador/accion.php",
            method: "POST",
            data: { categorias_cli: 1 },
            success: function(data) {            
               $("#get_categorias_cli").html(data);
            }
        })
    }

    function categorias_index() {   
        $.ajax({
            url: "controlador/accion.php",
            method: "POST",
            data: { categorias_cli: 1 },
            success: function(data) {            
               $("#get_categorias").html(data);
            }
        })
    }

    function categorias_deshabilitados() {
        $.ajax({
            url: "../../controlador/accion.php",
            method: "POST",
            data: { categorias_deshabilitados: 1 },
            success: function(data) {
                $("#categorias_des_msg").html(data);
            }
        })
    }

    

    
        $("body").delegate("#actualizar_cat", "click", function(event) {
            event.preventDefault();
            var descripcion_categoria = $("#cat_reseña").val();
            var nombre_nuevo_categoria = $("#cat_nombre").val();
            var id = $(this).attr("cat_id");
            
            $.ajax({
                url: "../../controlador/accion.php",
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
                url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
            method: "POST",
            data: { eliminar_categoria: 1, categoria_id: categoria_id },
            success: function(data) {
               
                $("#msg_actualizado").html(data);
                categorias_admin();
                
            }
        })
    })

    $("body").delegate("#buscar_categorias", "click", function(event) {
        event.preventDefault();
        var categoria_id = $(this).attr("catid");
        var url2 = "product_images";

        $.ajax({
            url: "controlador/accion.php",
            method: "POST",
            data: { categoria_cli_seleccionada: 1, cat_id: categoria_id,url2:url2 },
            success: function(data) {
               
                $("#get_product").html(data);
             
                
            }
        })
    })

    $("body").delegate("#buscar_categorias", "click", function(event) {
        event.preventDefault();
        var categoria_id = $(this).attr("catid");
        var url2 = "../../product_images";

        $.ajax({
            url: "../../controlador/accion.php",
            method: "POST",
            data: { categoria_cli_seleccionada: 1, cat_id: categoria_id,url2:url2 },
            success: function(data) {
               
                $("#get_product_cli").html(data);
             
                
            }
        })
    })

 

  
    

//-----------------TIPOS DE LIBROS---------------------------------------------

function tipo_cli() {
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { tipo_cli: 1 },
        success: function(data) {
            $("#get_tipos_cli").html(data);
        }
    })
}

function tipo_admin() {
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { escritor_Admin: 1 },
        success: function(data) {
            $("#esc_admin_msg").html(data);
        }
    })
}

function tipos_deshabilitados() {
    $.ajax({
        url: "../../controlador/accion.php",
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
        data: { tipo_cli: 1 },
        success: function(data) {
            $("#get_tipos").html(data);
        }
    })
}

$("body").delegate("#actualizar_tipo", "click", function(event) {
    event.preventDefault();
    var descripcion_nuevo_tipo = $("#tipo_desc").val();
    var nombre_nuevo_tipo = $("#tipo_nombre").val();
    var id = $(this).attr("tipo_id");
    
    $.ajax({
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
        method: "POST",
        data: { eliminar_tipo: 0, tipo_id: tipo_id },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            tipo_admin();
            
        }
    })
})

$("body").delegate("#deshabilitar_tipo", "click", function(event) {
    event.preventDefault();
    var tipo_id = $(this).attr("tipo_id");
    
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { eliminar_tipo: 1, tipo_id: tipo_id },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            tipo_admin();
            
        }
    })
})


$("body").delegate(".tipo_cliente", "click", function(event) {
    $("#get_product_cli").html("<h3>Cargando...</h3>");
    event.preventDefault();
    var tipo_id = $(this).attr('tipo_id');

    $.ajax({
        url: "../../controlador/accion.php",
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


$("body").delegate("#buscar_tipo", "click", function(event) {
    event.preventDefault();
    var tipoid = $(this).attr("tipoid");
    var url2 = "product_images";

    $.ajax({
        url: "controlador/accion.php",
        method: "POST",
        data: { tipo_cli_seleccionada: 1, tipoid: tipoid,url2:url2 },
        success: function(data) {
           
            $("#get_product").html(data);
         
            
        }
    })
})

$("body").delegate("#buscar_tipo", "click", function(event) {
    event.preventDefault();
    var tipoid = $(this).attr("tipoid");
    var url2 = "../../product_images";

    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { tipo_cli_seleccionada: 1, tipoid: tipoid,url2:url2 },
        success: function(data) {
           
            $("#get_product_cli").html(data);
         
            
        }
    })
})





//-------------AUTORES---------------------------------------------
function autor_cli() {
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { autor_cli: 1 },
        success: function(data) {
            $("#get_autores_cli").html(data);
        }
    })
}

function autor_index() {
    $.ajax({
        url: "controlador/accion.php",
        method: "POST",
        data: { autor_cli: 1 },
        success: function(data) {
            $("#get_autores").html(data);
        }
    })
}

function autor_admin() {
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { autor_admin: 1 },
        success: function(data) {
            $("#autor_admin_msg").html(data);
        }
    })
}

function autores_deshabilitados() {
    $.ajax({
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
        method: "POST",
        data: { eliminar_autor: 1, autor_id: autor_id },
        success: function(data) {
           
            $("#msg_actualizado").html(data);
            autor_admin();
            
        }
    })
})



$("body").delegate("#buscar_autor", "click", function(event) {
    event.preventDefault();
    var autor_id = $(this).attr("autorid");
    var url2 = "product_images";

    $.ajax({
        url: "controlador/accion.php",
        method: "POST",
        data: { autor_cli_seleccionada: 1, autor_id: autor_id,url2:url2 },
        success: function(data) {
           
            $("#get_product").html(data);
         
            
        }
    })
})

$("body").delegate("#buscar_autor", "click", function(event) {
    event.preventDefault();
    var autor_id = $(this).attr("autorid");
    var url2 = "../../product_images";

    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { autor_cli_seleccionada: 1, autor_id: autor_id,url2:url2 },
        success: function(data) {
           
            $("#get_product_cli").html(data);
         
            
        }
    })
})
//------------------------EDITORIALES--------------------------
function editorial_cli() {
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { editorial_cli: 1 },
        success: function(data) {
            $("#get_editoriales_cli").html(data);
        }
    })
}

function editorial_index() {
    $.ajax({
        url: "controlador/accion.php",
        method: "POST",
        data: { editorial_cli: 1 },
        success: function(data) {
            $("#get_editoriales").html(data);
        }
    })
}

function editorial_admin() {
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { editorial_admin: 1 },
        success: function(data) {
            $("#edit_admin_msg").html(data);
        }
    })
}

function editoriales_deshabilitados() {
    $.ajax({
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
            url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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
        url: "../../controlador/accion.php",
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


$("body").delegate("#buscar_editorial", "click", function(event) {
    event.preventDefault();
    var editid = $(this).attr("editid");
    var url2 = "product_images";
    $.ajax({
        url: "controlador/accion.php",
        method: "POST",
        data: { editorial_cli_seleccionada: 1, editid: editid,url2:url2 },
        success: function(data) {
           
            $("#get_product").html(data);
         
            
        }
    })
})
$("body").delegate("#buscar_editorial", "click", function(event) {
    event.preventDefault();
    var editid = $(this).attr("editid");
    var url2 = "../../product_images";
    
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { editorial_cli_seleccionada: 1, editid: editid, url2:url2 },
        success: function(data) {
           
            $("#get_product_cli").html(data);
         
            
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

                location.href = "Vista/cliente/perfil_usuario.php";
               

            }
            if (data == 1) {
              
                location.href = "Vista/admin/perfil_admin.php";
            }
            if (data == 2) {
                $("#e_msg").html('<div class="alert alert-danger">	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b> El usuario o contraseña no es !correcta¡..!</b>	</div>');
            }
        }
    })
})

$("#logear_de_registro").click(function(event) {
    event.preventDefault();
    var email = $("#email2").val();
    var pass = $("#password2").val();
    $.ajax({
        url: "controlador/login.php",
        method: "POST",
        data: { userLogin: 1, userEmail: email, userPassword: pass },
        success: function(data) {
            if (data == 0) {

                location.href = "Vista/cliente/perfil_usuario.php";
               

            }
            if (data == 1) {
              
                location.href = "Vista/admin/perfil_admin.php";
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
    var url2 = "../../product_images";

    if (buscador_cliente != "") {
        $.ajax({
            url: "../../controlador/accion.php",
            method: "POST",
            data: { buscador_cli: 1, buscador_cliente: buscador_cliente,url2:url2 },
            success: function(data) {
                $("#get_product_cli").html(data);
                if ($("body").width() < 480) {
                    $("body").scrollTop(683);
                }
            }
        })
    }
})



$("#boton_buscar").click(function() {
    //$("#get_product_cli").html("<h3>Cargando...</h3>");
    var buscador_cliente = $("#buscador_cliente").val();
    var url2 = "product_images";
    if (buscador_cliente != "") {
        $.ajax({
            url: "controlador/accion.php",
            method: "POST",
            data: { buscador_cli: 1, buscador_cliente: buscador_cliente,url2:url2 },
            success: function(data) {
                $("#get_product").html(data);
                if ($("body").width() < 480) {
                    $("body").scrollTop(683);
                }
            }
        })
    }
})


$("#actualizar_cliente").click(function(event) {
  
  var id_user = $(this).attr("user_id");
    // var id_user = $("#user_id").val();
    var rut = $("#cli_rut").val();
    var nombres = $("#cli_nombre").val();
     var apellidos = $("#cli_apellido").val();
     var password = $("#cli_password").val();
     var telefono = $("#cli_telefono").val();
     var correo = $("#cli_correo").val();
     var direccion = $("#cli_direccion").val();
 
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { actualizar_cliente: 1, id_user:id_user,rut:rut, nombres:nombres,  apellidos:apellidos, password:password,telefono:telefono, correo:correo, direccion:direccion },
        success: function(data) {
            $("#perfil_cli_msg").html(data);            
        }        
    })
})



$("#autoregistro_cli").click(function(event) {
    event.preventDefault();
     var rut = $("#reg_rut").val();
     var nombres = $("#reg_nombre").val();
     var apellidos = $("#reg_apellido").val();
     var password = $("#password2").val();
     var repassword = $("#reg_repassword").val();
     var telefono = $("#reg_telefono").val();
     var direccion = $("#reg_direccion").val();
     var correo = $("#email2").val();

     var titular = $("#titular_targeta").val();
     var numero_targeta = $("#num_targeta").val();
     var cvv = $("#cvv").val();
     var fecha1 = $("#fecha_1").val();
     var fecha2 = $("#fecha_2").val();
     
    
    $.ajax({
        url: "controlador/accion.php",
        method: "POST",
        data: { registrar: 1, rut:rut, nombres:nombres,  apellidos:apellidos, password:password,telefono:telefono, correo:correo
                , direccion:direccion,repassword:repassword,titular:titular,numero_targeta:numero_targeta,cvv:cvv,fecha1:fecha1,fecha2:fecha2},
        success: function(data) {
            $("#autoregistro_msgz").html(data);

             
          var msg_vacio = ` <div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>Por favor llena todos los espacios..!</b></div>`;

            var msg_correo_no_val = `<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>el Correo no es válido..!</b></div>`;

            var passwor_debil = `<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>La contraseña es débil</b></div>`;

            var password_no_iguales = `<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>las contraseñas no son iguales</b></div>`;

            var numero_no_val = `<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>El número $mobile solo debe contener numeros</b></div>`;

            var numero_corto = `<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>El número de móvil debe ser de 9 dígitost</b></div>`;

            var correo_en_uso = `<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>La dirección de correo electrónico ya está en uso, Pruebe otra dirección de correo electrónico</b></div>`;

            var targeta = `<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>!Registre la targeta de credito u Omitala</b></div>`;

            var ingreso_con_exito = `<div class='form-card'>
            <h2 class='fs-title text-center'> Exito!</h2>
             <br><br>
            <div class='row justify-content-center'>
                <div class='col-3'> <img src='https://img.icons8.com/color/96/000000/ok--v2.png' class='fit-image'> </div>
            </div> <br><br>
            <div class='row justify-content-center'>
                <div class='col-7 text-center'>
                    <h5>Registrado Con Exito!!</h5>
                </div>
            </div>
            </div> `;

            var error_ingreso_usuario = `<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>!Error al registrarse¡</b></div>`

            var error_ingreso_targeta = `<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>!Error al Registrar Su Medio De Pago</b></div>`


            if (data == 1){
                $("#autoregistro_msgz").html(msg_vacio);
                $("#logear_de_registro").hide();      
            }else if(data == 2){
                $("#autoregistro_msgz").html(msg_correo_no_val);
                $("#logear_de_registro").hide();      
            }else if (data == 3){
                $("#autoregistro_msgz").html(passwor_debil);
                $("#logear_de_registro").hide();      
            }else if (data == 4){
                $("#autoregistro_msgz").html(password_no_iguales);
                $("#logear_de_registro").hide();      
            }else if (data == 5){
                $("#autoregistro_msgz").html(numero_no_val);
                $("#logear_de_registro").hide();      
            }else if (data == 6){
                $("#autoregistro_msgz").html(numero_corto);
                $("#logear_de_registro").hide();      
            }else if (data == 7){
                $("#autoregistro_msgz").html(correo_en_uso);
                $("#logear_de_registro").hide();      
            }else if (data == 8){
                $("#autoregistro_msgz").html(targeta);
                $("#logear_de_registro").hide();              
                 // $("#logear_de_registro").remove();
            }else if (data == 9){
                $("#autoregistro_msgz").html(ingreso_con_exito);
                $("#jajas").remove();
                $("#logear_de_registro").show(); 
               
                
                
            }else if (data == 10){
                $("#autoregistro_msgz").html(error_ingreso_usuario);
                $("#logear_de_registro").remove();
            }
            else if (data == 11){
                $("#autoregistro_msgz").html(error_ingreso_targeta);
                $("#jajas").remove();
            }
        }
    })

})



$("body").delegate("#agregar_producto", "click", function(event) {
    event.preventDefault();
    var proId = $(this).attr("proId");
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { agregar_producto: 1, proId:proId },
        success: function(data) {
           
            $("#msg_agregar_al_carro").html(data);
         
            
        }
    })
})

$("body").delegate("#agregar_producto_directo", "click", function(event) {
    event.preventDefault();
    var proId = $(this).attr("proId");
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { agregar_producto: 1, proId:proId },
        success: function(data) {
           
            $("#agregar_product_solo").html(data);
         
            
        }
    })
})

$("body").delegate("#agregar_producto_sin_registrar", "click", function(event) {
    event.preventDefault();
    $.ajax({
        url: "controlador/accion.php",
        method: "POST",
        data: { agregar_producto: 1 },
        success: function(data) {
           
            $("#msg_agregar_al_carro1").html(data);
         
            
        }
    })
})


function carro_de_compras() {
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { carro_de_compras: 1 },
        success: function(data) {
            if(data != 1){
            $("#carro_productos").html(data);
            modo_pago(1);
        }else{
            modo_pago(0);        }
    }
    })
}



function modo_pago(value) {
var value = value;
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { modo_pago: 1, value:value},
        success: function(data) {
            $("#msg_modo_de_pago").html(data);
        }
    })
}

$("body").delegate("#eliminar_carro_id", "click", function(event) {
    event.preventDefault();
    var proId = $(this).attr("proId");
    var cantidad = $(this).attr("cantidad");

    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { eliminar_de_carro: 1,proId:proId,cantidad:cantidad},
        success: function(data) {           
            $("#carro_productos").html(data);
            carro_de_compras();
            modo_pago();
            
        }
    })
})




     $("body").delegate("#mas_cant", "click", function(event) {
        event.preventDefault();
         var libro = $(this).attr("libro");
         var precio = $(this).attr("precio");
         $.ajax({
             url: "../../controlador/accion.php",
             method: "POST",
             data: { stock_mas_carro: 1,libro:libro},
             success: function(data) {  

                 if(data == 1){
                    sumar_qty(libro,precio);
                 }
                      
             }
         })

})
         function sumar_qty(libro,precio){

            $.ajax({
                url: "../../controlador/accion.php",
                method: "POST",
                data: { sumar_cant_carro: 1,libro:libro,precio:precio},
                success: function(data) {
                  carro_de_compras();
                 
                       
                }
            })

         }  
            




         $("body").delegate("#menos_cant", "click", function(event) {
            event.preventDefault();
             var libro = $(this).attr("libro");
             var precio = $(this).attr("precio");

             $.ajax({
                 url: "../../controlador/accion.php",
                 method: "POST",
                 data: { stock_menos_carro: 1,libro:libro,precio:precio},
                 success: function(data) {  
    
                     if(data == 1){
                        restar_qty(libro,precio);
                     }
                          
                 }
             })
    
    })


    function restar_qty(libro,precio){

        $.ajax({
            url: "../../controlador/accion.php",
            method: "POST",
            data: { restar_cant_carro: 1,libro:libro,precio:precio},
            success: function(data) {     
                carro_de_compras();
            }
        })

     } 



$("body").delegate("#pagar_pedido", "click", function(event) {
    event.preventDefault();
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { pagar_pedido: 1},
        success: function(data) {           
            $("#carro_productos").html(data);
            $("#pagar_pedido").remove();
        }
    })
})

$("body").delegate("#mis_pedidos_boton", "click", function(event) {

    mispedidos();

})


mispedidos();

function mispedidos() {
    var titulo = `<h3 id="titulo_msg_pedidos"><strong>Mis Pedidos</strong></h3>`

    $.ajax({
        url: "../../controlador/pedidos.php",
        method: "POST",
        data: { pedido: 1 },
        success: function(data) {
            $("#pedidos_msg").html(data);
            $("#titulo_msg_pedidos").html(titulo);

        }
    })
}



$("#devolver").click(function(event) {
    event.preventDefault();
    //var radios = $("#radios-0").val();
    var radios = $("input:radio[name=radios]:checked").val();
    var libro = $("#nlibro").val();
    var nventa = $("#nventa").val();
    var nombre = $("#f_name").val();
    var email = $("#email").val();
    var otro = $("#otro").val();
    var nventas = $("#nventa2").val();
    $.ajax({
        url: "../../controlador/devolver.php",
        method: "POST",
        data: { librosid: libro, nventa: nventa, radios: radios, nombre: nombre, email: email, otro: otro, npedido: nventas },
        success: function(data) {
            $("#devolver_msg").html(data);
            $("#devolver").remove();
        }
    })

})




$("body").delegate("#misdevoluciones", "click", function(event) {
    event.preventDefault();
    var titulo = `<h3 id="titulo_msg_pedidos"><strong>Mis Devoluciones</strong></h3>`
    $.ajax({
        url: "../../controlador/mis_devoluciones.php",
        method: "POST",
        data: { devolucion: 1 },
        success: function(data) {

            $("#pedidos_msg").html(data);
            $("#titulo_msg_pedidos").html(titulo);
            
        }
    })

})


$("body").delegate("#mandar_libros_a_oferta", "click", function(event) {
    event.preventDefault();
    var precio = $(this).attr('precio'); 
    var libro = $(this).attr('libro_id')
    $("#precio_actual").val(precio);
    $("#agregar_oferta").val(libro);

    document.getElementById("lista_de_descuentos").disabled=false;
    document.getElementById("cancelar").disabled=false;

    
})

$("body").delegate("#quitar_libro_ofertado", "click", function(event) {
    event.preventDefault();
    var precio = $(this).attr('precio'); 
    var libro = $(this).attr('libro_id');
    var descuento = $(this).attr('descuento_libro');
    var precio_sin_oferta = $(this).attr('precio_nuevo');



    $("#oferta_precio").val(precio);
    $("#precio_sin_oferta").val(precio_sin_oferta);

    $("#quitar_oferta").val(libro);
    $("#desc").val(descuento);

    document.getElementById("quitar_oferta").disabled=false;

    
})



function carrusel_usuario(){
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { carruse_ofertas: 1},
        success: function(data) {     
            $("#carrusel_de_ofertas1").html(data);
            
        }
    })

 }
 function carrusel_index(){
    $.ajax({
        url: "controlador/accion.php",
        method: "POST",
        data: { carruse_ofertas: 1},
        success: function(data) {     
            $("#carrusel_de_ofertas_index").html(data);
            
        }
    })

 }



 $("body").delegate("#agregar_oferta", "click", function(event) {
    event.preventDefault();
    var descuento = document.getElementById("lista_de_descuentos").value;
    var libro = $(this).val();
   
    
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { poner_en_oferta: 1,descuento:descuento,libro:libro },
        success: function(data) {
            libros_a_ofertar();
            libros_ofertados();
            document.getElementById("nuevo_precio").value="";
            document.getElementById("lista_de_descuentos").value="";
            document.getElementById("precio_actual").value="";
            document.getElementById("nuevo_precio").disabled=true;
            document.getElementById("lista_de_descuentos").disabled=true;
            document.getElementById("precio_actual").disabled=true;
        
            $("#msg_poner_en_oferta").html(data);
            
            
        }
    })

})

$("body").delegate("#quitar_oferta", "click", function(event) {
    event.preventDefault();
    var libro = $(this).val();

    
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { poner_en_oferta: 1,libro:libro,descuento : 0 },
        success: function(data) {
            libros_a_ofertar();
            libros_ofertados();
            $("#libros_ofertad_msg").html(data);
            
            
        }
    })

})

$("body").delegate("#producto_mostrar", "click", function(event) {
    event.preventDefault();
    var libro = $(this).attr('libro');
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { producto_solo: 1 , libro:libro},
        success: function(data) {  

        //$("#modal2").html(data);

            $("#modal2").html(data);
            showModal2();
        }
    })
})

function clientes_admin(){
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { mostrar_clientes:0, rut:0},
        success: function(data) {
            $("#clientes_registrados_msg").html(data);
        }
    })
}
    $("filtro_rut").change(function(){
        var rut = $(this).value();

    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { mostrar_clientes:0 ,rut:rut},
        success: function(data) {
            $("#clientes_registrados_msg").html(data);
        }
    })
})



$("body").delegate("#banear_usuario", "click", function(event) {
    event.preventDefault();
    var user = $(this).attr('user_id');
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { ban_desban: 1 , user:user},
        success: function(data) {  

            $("#msg_ban_desban").html(data);
            clientes_admin();
          
        }
    })
})

$("body").delegate("#habilitar_usuario", "click", function(event) {
    event.preventDefault();
    var user = $(this).attr('user_id_baned');
    $.ajax({
        url: "../../controlador/accion.php",
        method: "POST",
        data: { ban_desban: 0 , user:user},
        success: function(data) {  

            $("#msg_ban_desban").html(data);
            clientes_admin();
          
        }
    })
})

$("#verificar").click(function(event) {
    event.preventDefault();
    var codigo = $("#code").val();
    $.ajax({
        url: "action.php",
        method: "POST",
        data: { code: codigo },
        success: function(data) {
            $("#codigo_msg").html(data);
        }
    })

})




})



