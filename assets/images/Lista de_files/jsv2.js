
$(function(){

	$(".contenido_tab").hide(); //Ocultar capas           
    $("ul.tabs li:first").addClass("activa").show(); //Activar primera pestaña
    $(".contenido_tab:first").show(); //Mostrar contenido primera pestaña
    
    //MOSTRAR VENTANA DIALOG PARA EDITAR REGISTROS
    $('#form-edit').dialog({
    	autoOpen:false,
    	modal:true,
		draggable : true,
    	title:'Editar Registro',
    	width:900,
    	height:600,
        beforeClose: function ( event, ui ) { 
            var aprobacion = confirm("¿Desea cancelar la edicion?"); 
            return aprobacion;
         },
        buttons: [
                    {
                    text: "Cancelar",
                    click: function(){
                        $("#form-edit form").each(function(){
                            this.reset();
                        });
                    	$( "#form-edit" ).dialog( "close" );
                    	}
                    }
        ]

    });
	
	//CARGA LAS TABS DE LA VENTANA EDITAR
	$( ".tabs" ).tabs();

    //HABILITA Y DESHABILITA CAMPOS CONFORME AL TIPO DE PROPIEDAD 
    $('#tipoPropiedad').change(function (){ 
	 var tipoPropiedad = parseInt($("#tipoPropiedad").val());
	 switch(tipoPropiedad){
		 case 0:
		 alert('Este tipo de propiedad no es valido favor de seleccionar uno correcto');
		 break;
		 case 4://terrenos
             $('#recamaras').attr("disabled","disabled");
             $('#banos').attr("disabled","disabled");
             $('#mediosBanos').attr("disabled","disabled");
             $('#interior').attr("disabled","disabled");
             $('#exterior').attr("disabled","disabled");
             $('#amoblado').attr("disabled","disabled");
             $('#estacionamiento').attr("disabled","disabled");
             $('#asignado').attr("disabled","disabled");
             $('#alberca').attr("disabled","disabled");
             $('#jacuzzi').attr("disabled","disabled");
             $('#piso').attr("disabled","disabled");
             $('#niveles').attr("disabled","disabled");
             $('#puestos').attr("disabled","disabled");
		 break;
		 case 5://comercial
             $('#recamaras').attr("disabled","disabled");
             $('#banos').attr("disabled","disabled");
             $('#mediosBanos').attr("disabled","disabled");
             $('#interior').attr("disabled","disabled");
             $('#exterior').attr("disabled","disabled");
             $('#amoblado').attr("disabled","disabled");
             $('#estacionamiento').attr("disabled", false);
             $('#asignado').attr("disabled", false);
             $('#alberca').attr("disabled","disabled");
             $('#jacuzzi').attr("disabled","disabled");
             $('#piso').attr("disabled",false);
             $('#niveles').attr("disabled",false);
             $('#puestos').attr("disabled",false);
		 break;
		 default://casas y condominio
             $('#recamaras').attr("disabled",false);
             $('#banos').attr("disabled",false);
             $('#mediosBanos').attr("disabled",false);
             $('#interior').attr("disabled",false);
             $('#exterior').attr("disabled",false);
             $('#amoblado').attr("disabled",false);
             $('#estacionamiento').attr("disabled", false);
             $('#asignado').attr("disabled", false);
             $('#alberca').attr("disabled",false);
             $('#jacuzzi').attr("disabled",false);
             $('#piso').attr("disabled",false);
             $('#niveles').attr("disabled",false);
             $('#puestos').attr("disabled",false);
		 break;
		 }

 	});


    // Sucesos al hacer click en una pestaña
    $("ul.tabs li").click(function (){
        $("ul.tabs li").removeClass("activa"); //Borrar todas las clases "activa"
        $(this).addClass("activa"); //Añadir clase "activa" a la pestaña seleccionada
        $(".contenido_tab").hide(); //Ocultar todo el contenido de la pestaña
        var activatab = $(this).find("a").attr("href"); //Leer el valor de href para identificar la pestaña activa
    	$(activatab).fadeIn(); //Visibilidad con efecto fade del contenido activo
        return false;
        });


	//ACTIVA EL DIALOG EDITAR REGISTRO PROPIEDAD
    $('.editarRegistro').click(function(){
		var fila = $(this).parent().parent();//recorro mi dom para llegar hasta mi tag tr
		$("#headPropertyEdit").text(fila.children("td:nth(1)").text());								
    	var property = fila.children("td:first").text();//ingreso al primer valor del td dentro de mi tag tr
		$("#headidProperty").text(property);
        $("#btnDeleteListing").attr("onClick","deleteListing("+property+", true)");
		obtenerBasicos( property );
		obtenerPerfil( property );
		obtenerGaleria( property );
		obtenerRegistro( property );
		$('#form-edit').removeClass("hide").dialog('open'); //Se abre la ventana de dialogo para editar la propiedad seleccionada
    });
	

	//ACTIVA EL DIALOG EDITAR DESARROLLO
    $('.editarDev').click(function(){
        var dev = $(this).attr('id');
        $.post("modulos/consultas.inc.php",{id:dev, accion:"editarDev"}, function( data ){
            
            $('#headPropertyEdit').text(data.contenido[0].name);
            $('#fragment-1 #nombre').val(data.contenido[0].name);
            $('#fragment-1 #precioMin').val(data.contenido[0].minp);
            $('#fragment-1 #precioMax').val(data.contenido[0].maxp);
            $('#fragment-1 #densidad').val(data.contenido[0].units);
            //checkboxes
            $('#fragment-1 #casas').attr("checked", checkingBoxes(data.contenido[0].casa));
            $('#fragment-1 #condos').attr("checked", checkingBoxes(data.contenido[0].condo));
            $('#fragment-1 #comercial').attr("checked", checkingBoxes(data.contenido[0].comercial));
            $('#fragment-1 #lotes').attr("checked", checkingBoxes(data.contenido[0].lote));

            $('#fragment-1 #electricidad').attr("checked", checkingBoxes(data.contenido[0].elec));
            $('#fragment-1 #drenaje').attr("checked", checkingBoxes(data.contenido[0].dre));
            $('#fragment-1 #agua').attr("checked", checkingBoxes(data.contenido[0].agua));
            $('#fragment-1 #vialidades').attr("checked", checkingBoxes(data.contenido[0].vial));
            $('#fragment-1 #seguridad').attr("checked", checkingBoxes(data.contenido[0].seg));
            //Selects
            $('#fragment-1 #estado option').each(function(){
                if ( $(this).attr("value") == data.contenido[0].estado){
                    $(this).attr("selected",true);
                };
            });
            $('#fragment-1 #ciudad').append("<option value=\""+data.contenido[0].ncit+"\">"+data.contenido[0].cName+"</option>");
            $('#fragment-1 #listaLocalidades').append("<option value=\""+data.contenido[0].nloc+"\">"+data.contenido[0].lName+"</option>");
            $('#fragment-1 #moneda option').each(function(){
                if ( $(this).attr("value") == data.contenido[0].moneda){
                    $(this).attr("selected",true);
                };
            });
            $('#fragment-1 #statusDev option').each(function(){
                if ( $(this).attr("value") == data.contenido[0].status){
                    $(this).attr("selected",true);
                };
            });
            $('#fragment-2 #titulo-esp').val(data.contenido[0].titulo);
            $('#fragment-2 #descripcion').val(data.contenido[0].descripcion);
            $('#fragment-2 #amenidades').val(data.contenido[0].amenidades);

            //Campos a asociar
            $('#fragment-3 #title-en').val(data.contenido[0].title);
            $('#fragment-3 #description').val(data.contenido[0].description);
            $('#fragment-3 #amenities').val(data.contenido[0].amenities);
            $('#fragment-3 #code, #fragment-4 #idDev').val(data.contenido[0].code);
            if(data.contenido[0].portada != "" || data.contenido[0].portada!= undefined){
                $("#areaPortadaDev").html("<img class=\"img-responsive\" src=\"../images/"+data.contenido[0].portada+"\" >");
            }else{
                $("#areaPortadaDev").html("<h1>Este desarrollo no tiene foto de portada<h1>");
            }
            

        },"json");

        $('#form-edit').removeClass("hide").dialog('open'); 
    });
    
    $('.actualizarDev').click(function(){
        $.ajax({
            type:"POST",
            url: $('#frmActualizarDev').attr("action"),
            data: $('#frmActualizarDev').serialize()+"&send=true",
            success: function(response){
                alert(response.respuesta);
            },
            dataType: "JSON"

        });
    });
    
	 //CAMIA EL ESTADO VISIBLE DEL LISTING
	$("button.btn-switch").click(function(event){
		var estadoListing = $(this).text();
		var fila = $(this).parent().parent();//recorro mi dom para llegar hasta mi tag tr
    	var idListing = fila.children("td:first").text();//ingreso al primer valor del td dentro de mi tag tr
		$.post( "modulos/actualizar-visibilidad.inc.php",{estatus: estadoListing, id:idListing},function( data ){
			$(event.target).text(data.texto);//actua sobre el elemento que lo ejecuto
			$(event.target).removeClass(data.suprimir).addClass(data.anadir);
		},"json");
	});
    
    //CAMIA EL ESTADO VISIBLE DEL DESARROLLO
	$("button.switch-it").click(function(event){
		var estadoListing = $(this).attr("data-status");
    	var idListing = $(this).attr("data-dev");//ingreso al primer valor del td dentro de mi tag tr
        $.post( "modulos/switch-dev.inc.php",{estatus: estadoListing, id:idListing},function( data ){
			$(event.target).text(data.texto);//actua sobre el elemento que lo ejecuto
			$(event.target).removeClass(data.suprimir).addClass(data.anadir).attr("data-status", data.st);
		},"json");
	});
	
	//FUNCION PARA OBTENER MI LISTA DE CIUDADES
    $('#estado').change(function(){
    	var estado = $('#estado').val();
    	$.post("modulos/consultas.inc.php",{id:estado, accion:"obtenerCiudades"}, function( data ){
    		$('#ciudad').html(data.contenido);//ingreso mi objeto que contiene mi respuesta ajax al select
    		$('#ciudad').removeAttr('disabled');//Activo mi select
    	},"json");

    });
    
    //EDICION DEL REGISTRO EN TAB INFORMACION
	$("#formEdicion").submit(function(event){
        event.preventDefault();
		var url = $(this).attr("action");
        $.ajax({
			type: "POST",
			url	: url,
			data : $('#formEdicion').serialize()+"&send=true",
			beforeSend: function(){
			    //Hacer validaciones con js o algo asi, o quiza una animacion de envio o bloqueo de boton para no enviar duplicado
				},
			success: function( data ){
                   //Mostrar anuncio que los datos se actualizaron correctamente
                   //console.log(data.response);
                   //console.log(data.exito)
				},
			error: function(jqXHR, error){
				alert(error);
				},
			dataType: "json"				
		});

    });
    
    //PROCESA LOS FORMULARIOS QUE SE NECESITE ENVIAR IMAGENES POR AJAX
    $(".ajaxImages").submit(function(event){
        event.preventDefault();
        btnEnvioImages.attr("disabled", true);
        //console.log($(this));
        var url = $(this).attr("action");
        $.ajax({
                type: 'POST',
                url: url,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(){
                    //Hacer variable el areaPrtada
                    $(cajadatos).append("<div class='loading-label text-center'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i><span class='sr-only'>Cargando...</span></div>");  
                    //Bloquear boton de envio
                },
                success: function (response, textStatus, jqXHR) {
                    $("div").remove(".loading-label");
                    //Resetear formulario
                    event.target.reset();
                    //Desbloquear boton de envio
                    btnEnvioImages.attr("disabled", false);
                    $(cajadatos).append("<div class='msg-ajaxImages text-center'><p>La imagen ha sido cargado con éxito<p></div>"); 
                    $(".msg-ajaxImages").fadeOut(0).fadeIn(2000).fadeOut(8000);

                }
            });
        });
    
    $(".prevImg").change(function(event){
        //Desbloquear boton de envio que está bloqueado por defecto
        var btnEnvio = $(this).parents("form");
        btnEnvioImages = btnEnvio.find("input[type='submit']").attr("disabled", false);
        cajadatos = "#"+$(this).data("mostrar");
        var archivos = event.target.files;
        $(cajadatos).html('');
        var archivo = archivos[0];
        if(!archivo.type.match(/image.*/i) ){
            alert("Seleccione un archivo tipo imagen jpg");
        }else{
            var lector = new FileReader();
            lector.onloadstart=comenzar;
            lector.onprogress=estado;
            lector.onloadend = mostrar;
            lector.readAsDataURL(archivo);

        }
    });
});



	//FUNCIONES PERSONALIZADAS
	function obtenerRegistro( property ){
			$.post( "modulos/consultas.inc.php", { id: property, accion:"obtenerRegistro" }, function( data ) {
                
                //Evaluar el tipo de propiedad para bloquear campos segun sea el caso
                switch(parseInt(data.contenido[0].tprop)){
                 case 0:
                 alert('Este tipo de propiedad no es valido favor de seleccionar uno correcto');
                 break;
                 case 4://terrenos
                     $('#recamaras').attr("disabled","disabled");
                     $('#banos').attr("disabled","disabled");
                     $('#mediosBanos').attr("disabled","disabled");
                     $('#interior').attr("disabled","disabled");
                     $('#exterior').attr("disabled","disabled");
                     $('#amoblado').attr("disabled","disabled");
                     $('#estacionamiento').attr("disabled","disabled");
                     $('#asignado').attr("disabled","disabled");
                     $('#alberca').attr("disabled","disabled");
                     $('#jacuzzi').attr("disabled","disabled");
                     $('#piso').attr("disabled","disabled");
                     $('#niveles').attr("disabled","disabled");
                     $('#puestos').attr("disabled","disabled");
                 break;
                 case 5://comercial
                     $('#recamaras').attr("disabled","disabled");
                     $('#banos').attr("disabled","disabled");
                     $('#mediosBanos').attr("disabled","disabled");
                     $('#interior').attr("disabled","disabled");
                     $('#exterior').attr("disabled","disabled");
                     $('#amoblado').attr("disabled","disabled");
                     $('#estacionamiento').attr("disabled", false);
                     $('#asignado').attr("disabled", false);
                     $('#alberca').attr("disabled","disabled");
                     $('#jacuzzi').attr("disabled","disabled");
                     $('#piso').attr("disabled",false);
                     $('#niveles').attr("disabled",false);
                     $('#puestos').attr("disabled",false);
                 break;
                 default://casas y condominio
                     $('#recamaras').attr("disabled",false);
                     $('#banos').attr("disabled",false);
                     $('#mediosBanos').attr("disabled",false);
                     $('#interior').attr("disabled",false);
                     $('#exterior').attr("disabled",false);
                     $('#amoblado').attr("disabled",false);
                     $('#estacionamiento').attr("disabled", false);
                     $('#asignado').attr("disabled", false);
                     $('#alberca').attr("disabled",false);
                     $('#jacuzzi').attr("disabled",false);
                     $('#piso').attr("disabled",false);
                     $('#niveles').attr("disabled",false);
                     $('#puestos').attr("disabled",false);
                 break;
                 }
                if(data.contenido[0].active==1){var txtStatus="Activo"}else{ var txtStatus="Inactivo"};
                $("#headStatusListing").text(txtStatus);
                //Tab Detalles
                $('#fragment-1A #lat').val(data.contenido[0].lat);
                $('#fragment-1A #lng').val(data.contenido[0].lng);
                $('#fragment-1A #piso').val(data.contenido[0].fnum);
                $('#fragment-1A #niveles').val(data.contenido[0].niv);
                $('#fragment-1A #ctotal').val(data.contenido[0].cTotal);
                $('#fragment-1A #lote').val(data.contenido[0].lot);
                $('#fragment-1A #interior').val(data.contenido[0].aInt);
                $('#fragment-1A #exterior').val(data.contenido[0].aExt);
                $('#fragment-1A #puestos').val(data.contenido[0].nPuestos);
                $('#fragment-1A #code, #fragment-2 #idListingPerfil').val(data.contenido[0].code);
                $('#fragment-1A #c_mantenimiento').val(data.contenido[0].hoaf);
                $('#fragment-1A #ciudad').append("<option value=\""+data.contenido[0].ncit+"\">"+data.contenido[0].cName+"</option>");
                $('#fragment-1A #listaLocalidades').append("<option value=\""+data.contenido[0].nloc+"\">"+data.contenido[0].lName+"</option>");
                    //Selects
                $('#fragment-1A #estado option').each(function(){
                    if ( $(this).attr("value") == data.contenido[0].nEst){
                       $(this).attr("selected",true);
                    };
                });
                $('#fragment-1A #desarrollo option').each(function(){
                    if ( $(this).attr("value") == data.contenido[0].nDev){
                       $(this).attr("selected",true);
                    };
                });
        
                $('#fragment-1A #recamaras option').each(function(){
                    if ( $(this).attr("value") == data.contenido[0].rec){
                       $(this).attr("selected",true);
                    };
                });
                $('#fragment-1A #banos option').each(function(){
                    if ( $(this).attr("value") == data.contenido[0].ba){
                       $(this).attr("selected",true);
                    };
                });
                $('#fragment-1A #mediosBanos option').each(function(){
                    if ( $(this).attr("value") == data.contenido[0].hba){
                       $(this).attr("selected",true);
                    };
                });
                $('#fragment-1A #amoblado option').each(function(){
                    if ( $(this).attr("value") == data.contenido[0].tAmobl){
                       $(this).attr("selected",true);
                    };
                });
                $('#fragment-1A #estacionamiento option').each(function(){
                    if ( $(this).attr("value") == data.contenido[0].parking){
                       $(this).attr("selected",true);
                    };
                });
                $('#fragment-1A #tipoPropiedad option').each(function(){
                    if ( $(this).attr("value") == data.contenido[0].tprop){
                       $(this).attr("selected",true);
                    };
                });
                    //Checkboxes
                $('#fragment-1A #alberca').attr("checked", checkingBoxes(data.contenido[0].hPool));
                $('#fragment-1A #jacuzzi').attr("checked", checkingBoxes(data.contenido[0].hJac));
                $('#fragment-1A #financiamiento').attr("checked", checkingBoxes(data.contenido[0].hfin));
                $('#fragment-1A #renta').attr("checked", checkingBoxes(data.contenido[0].hrent));
                $('#fragment-1A #asignado').attr("checked", checkingBoxes(data.contenido[0].pDeed));
                
                //Tab espanol
                $('#fragment-2A #nombre').val(data.contenido[0].nombre);
                $('#fragment-2A #titulo-esp').val(data.contenido[0].titulo);
                $('#fragment-2A #descripcion').val(data.contenido[0].dEs);
                $('#fragment-2A #a_privativas').val(data.contenido[0].detalles);
                $('#fragment-2A #a_comunes').val(data.contenido[0].aComun);
                $('#fragment-2A #resumen').val(data.contenido[0].res);
                $('#fragment-2A #pclaves').val(data.contenido[0].pClaves);
                
                
                //Tab Ingles
                //console.log(data.contenido);
                $('#fragment-3A #name').val(data.contenido[0].name);
                $('#fragment-3A #title-en').val(data.contenido[0].title);
                $('#fragment-3A #description').val(data.contenido[0].dEn);
                $('#fragment-3A #p_areas').val(data.contenido[0].details);
                $('#fragment-3A #c_areas').val(data.contenido[0].cAreas);
                $('#fragment-3A #summary').val(data.contenido[0].summ);
                $('#fragment-3A #kwords').val(data.contenido[0].kWords);
			}, "json");
		};
    
    function checkingBoxes(valor){
        if(valor == 0 || valor == null || valor == undefined){
            return false;
        }else{
            return true;
        }
    }

	function obtenerBasicos( property ){
			$.post( "modulos/consultas.inc.php", { id: property, accion:"obtenerBasicos" }, function( data ) {
				$('#fragment-1').html(data.contenido);
                $(".listing-review #headAgenteEdit").text(data.respuesta);//Imprime el nombre del agente en la tabla detalles
			}, "json");
		};
	
	function obtenerPerfil( property ){
			$.post( "modulos/consultas.inc.php", { id: property, accion:"obtenerPerfil" }, function( data ) {
                //Validar si ya tiene perfil ingresado
                if(data.respuesta){
                    //Reemplazar contenido con bloque con datos y formulario para edicion de titulos
                    $("#fragment-2 #dinamicAreaPerfil").html("<div class=\"row\"><div class=\"col-md-11\"><img class=\"img-responsive\" src=\"../images/perfiles/"+data.contenido[0].perfil+"\"><div class=\"horizontal-bar-btns\"><button class=\"btn btn-default btn-sm\" onclick=\"elimiarPerfil("+data.contenido[0].code+")\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> </button></div><p>"+data.contenido[0].desEs+"</p><p><i>"+data.contenido[0].desEn+"</i></p></div></div>");
                }else{
                    $("#fragment-2 #dinamicAreaPerfil").html("<h1>No hay perfil</h1>"); 
                }
			}, "json");
		};
	
	function obtenerGaleria( property ){
			$.post( "modulos/consultas.inc.php", { id: property, accion:"obtenerGaleria" }, function( data ) {
				
                //Validar si hay foto de portada
                $("#thumbListingDetalle").attr("src","../images/"+data.contenido[0].portada);
                var drawform;
                if(data.respuesta && data.contenido[0].portada != '')
                {
                    drawform = "<img class='img-responsive' src='../images/"+data.contenido[0].portada+"' /><div class=\"text-right\"><button class=\"btn btn-link btn-sm\" onclick=\"eliminarPortada("+data.contenido[0].code+")\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button></div><br>";
                }
                else
                {
                    drawform = "<i class='fa fa-picture-o fa-5x' aria-hidden='true'></i><h5>(No hay foto de portada)</h5>";
                }
                $("#id-property").val(data.contenido[0].code);
				$('#fragment-3 #dinamicAreaPortada').html(drawform);	
			}, "json");
		};

	//Se activa con el boton de actualizar en formulario basico de edicion
	function actualizarStatus(){
		var actualStatus = $( "#frm_bs_estatus" ).val();
		var actualPrecio = $( "#frm_bs_precio" ).val();
		var actualAgente = $( "#frm_bs_agente" ).val();
        var inicio = $( "#bs_inicio" ).val();
        var fin = $( "#bs_fin" ).val();
        var flex = $( "#bs_flex" ).val();
        var mls = $( "#bs_mlv" ).val();
        var moneda = $( "#moneda" ).val();
		var actualOferta = $( "#frm_bs_oportunidad" ).prop("checked");
		var property = $( "#headidProperty" ).text();
		$.post("modulos/consultas.inc.php",{id:property, accion:"actualizarBasicos", newStatus:actualStatus, moneda:moneda, newPrecio:actualPrecio, newAgente:actualAgente, newOferta:actualOferta, inicio:inicio, fin:fin, mls:mls, flex:flex},function( data ){
				   //console.log(data.contenido);
                   },"json")							
	};

    //FUNCION PARA OBTENER MI LISTA DE LOCALIDADES
    function cambioCiudad(){
    	var ciudad = $('#ciudad').val();
    	$.post("modulos/consultas.inc.php",{id:ciudad, accion:"obtenerLocalidades"}, function( data ){
    		$('#listaLocalidades').html(data.contenido); //ingreso mi objeto que contiene mi respuesta ajax al select
    		$('#listaLocalidades').removeAttr('disabled'); //Activo mi select
    		//console.log(data.mensaje);
    	},"json");

    };
 	
 	//FUNCION PARA OBTENER MI LISTA DE CIUDADES
    function cambioEstado(){
    	var estado = $('#estado').val();
    	$.post("modulos/consultas.inc.php",{id:estado, accion:"obtenerCiudades"}, function( data ){
    		$('#ciudad').html(data.contenido);//ingreso mi objeto que contiene mi respuesta ajax al select
    		$('#ciudad').removeAttr('disabled');//Activo mi select
    		//console.log(data.mensaje);
    	},"json");

    };

	function elimiarPerfil( perfil ){
	 	$.post("modulos/consultas.inc.php",{id:perfil, accion:"eliminarPerfil"}, function( data ){
	    		//console.log(data.mensaje);
	    	},"json");

	 };

    function eliminarPortada( perfil ){
	 	$.post("modulos/consultas-listing.inc.php",{id:perfil, autho:true, accion:"01DP"}, function( data ){
	    		alert(data.msj);
	    	},"json");

	 };
    
    function deleteListing(id,autho){
        
        $.ajax({
            url: "modulos/consultas-listing.inc.php",
            type: "POST",
            data:{id:id, autho:autho, accion: '001D'},
            beforeSend: function(){
                var confirma  = confirm("Esta seguro que quire eliminar este listing, la información no podrá ser recuperada");
                return confirma;
            },
            success: function(data){
                //Comparamos nuestra respuesta para ejecutar accion
                if(data.exito){
                    //Recargamos la página
                    location.reload();
                }
                //console.log(data.msj);
            },
            dataType: "json",
        });
        
    }


    function mostrar(e){
        var resultado = e.target.result;
        $(cajadatos).html("<p><i>Vista previa</i></p><img class='img-responsive' src='"+resultado+"' alt='Imagen vista previa'>").fadeOut(0).fadeIn(1000);
    }

    function comenzar(e){
        $(cajadatos).html("<div class='progress'><div class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%;'> 0% </div></div>");

    }

    function estado(e){
        var por = parseInt(e.loaded/e.total*100);
        $(cajadatos).html("<div class='center-element'><div class='progress'><div class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='"+por+"' aria-valuemax='100' style='width: "+por+"%;'> "+por+"% </div></div></div>");

    }