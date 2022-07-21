// TABLA INDEX
$(document).ready(function() {
    let opcion;
    opcion = 8;

    dataTable = $('#dataTable').DataTable({  
            "ajax":{            
                "url": "../bd/crud.php", 
                "method": 'POST', //usamos el metodo POST
                "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
            },
            "columns":[
                {"data": "id_ficha"},
                {"data": "tipo_programa"},
                {"data": "pro_nombre"},
                {"data": "lider"}
    
            ],"language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" 
            }
    
        });  
    });  


// TABLA USUARIOS
$(document).ready(function() {

    var id_usuario, opcion;
    opcion = 4;

    if(rol=='administrador'){
        tablaUsuarios = $('#tablaUsuarios').DataTable({  
       
            "ajax":{            
                "url": "../bd/crud.php", 
                "method": 'POST', //usamos el metodo POST
                "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
    
            }, 
                "columns":[
                    {"data": "id_usuario"},
                    {"data": "nombre"},
                    {"data": "apellido"},
                    {"data": "usuario"},
                    {"data": "pw"},
                    {"data": "rol"},
                    {"data": "correo"},
                    {"data": "telefono"},
                    {"defaultContent": `<div class='text-center'>
                            <div class='btn-group'>
                                <button class='btn btn-success btnEditar'><i class='fas fa-edit'></i></button> 
                                <button class='btn btn-danger btnBorrar'><i class='fas fa-trash'></i></button>
    
                            </div>
                        </div>`}
                        
            ],"language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" 
            }
    
        });  

    }else{
        tablaUsuarios = $('#tablaUsuarios').DataTable({  
       
            "ajax":{            
                "url": "../bd/crud.php", 
                "method": 'POST', //usamos el metodo POST
                "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
    
            }, 
                "columns":[
                    {"data": "id_usuario"},
                    {"data": "nombre"},
                    {"data": "apellido"},
                    {"data": "correo"},
                    {"data": "telefono"}
                        
            ],"language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" 
            }
    
        });  
    };
   
       
    
    var fila; //captura la fila, para editar o eliminar
    //submit para el Alta y Actualización
    $('#formUsuarios').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        nombre = $.trim($('#nombre').val());    
        apellido = $.trim($('#apellido').val());
        usuario = $.trim($('#usuario').val());    
        pw = $.trim($('#pw').val());    
        rol = $.trim($('#rol').val());
        correo = $.trim($('#correo').val());                            
        telefono = $.trim($('#telefono').val());                            
            $.ajax({
              url: "../bd/crud.php",
              type: "POST",
              datatype:"json",    
              data:  {id_usuario:id_usuario, nombre:nombre, apellido:apellido, usuario:usuario, pw:pw, rol:rol, correo:correo ,telefono:telefono ,opcion:opcion},    
              success: function(data) {
                tablaUsuarios.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');	
        										     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta una Persona
    $("#btnNuevo").click(function(){
        opcion = 1; //alta           
        id_usuario=null;
        $("#formUsuarios").trigger("reset");
        $(".modal-header").css( "background-color", "#28a745");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Nuevo Usuario");
        $('#modalCRUD').modal('show');

        
    });
    
    //Editar        
    $(document).on("click", ".btnEditar", function(){		        
        opcion = 2;//editar
        fila = $(this).closest("tr");	        
        id_usuario = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
        nombre = fila.find('td:eq(1)').text();
        apellido = fila.find('td:eq(2)').text();
        usuario = fila.find('td:eq(3)').text();
        pw = fila.find('td:eq(4)').text();
        rol = fila.find('td:eq(5)').text();
        correo = fila.find('td:eq(6)').text();
        telefono = fila.find('td:eq(7)').text();
        $("#nombre").val(nombre);
        $("#apellido").val(apellido);
        $("#usuario").val(usuario);
        $("#pw").val(pw);
        $("#rol").val(rol);
        $("#correo").val(correo);
        $("#telefono").val(telefono);
        $(".modal-header").css("background-color", "#343a40");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Usuario");		
        $('#modalCRUD').modal('show');	


        
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        id_usuario = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
        opcion = 3; //eliminar       
        var respuesta = confirm("¿Está seguro de borrar el registro "+id_usuario+"?"); 
        

        if (respuesta) {            
            $.ajax({
              url: "../bd/crud.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, id_usuario:id_usuario},    
              success: function() {
                  tablaUsuarios.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
         
    });



// TABLA FICHAS

$(document).ready(function() {
    
    var id_ficha, opcion, total;
    opcion = 8;

    if(rol=='administrador'){
        tablaFichas = $('#tablaFichas').DataTable({  
            "ajax":{            
                "url": "../bd/crud.php", 
                "method": 'POST', //usamos el metodo POST
                "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
            },
            "columns":[
                {"data": "id_ficha"},
                {"data": "tipo_programa"},
                {"data": "pro_nombre"},
                {"data": "lider"},
                {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btnAdministrar'>Administrar</button></div></div>"},
                {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btnEditarFicha'><i class='fas fa-edit'></i></button> <button class='btn btn-danger btnBorrarFicha'><i class='fas fa-trash'></i></button></div></div>"},
                {data: null,
                render: function (data, type, row, ){

                    return type === 'display'

                    ?`<progress value="`+ data.evaluados + `" max="`+ data.totalestados +`"></progress>`
                    :data;
                }},
            ],"language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" 
            }
    
        });  

    }else{
        tablaFichas = $('#tablaFichas').DataTable({  
            "ajax":{            
                "url": "../bd/crud.php", 
                "method": 'POST', //usamos el metodo POST
                "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
            },
            "columns":[
                {"data": "id_ficha"},
                {"data": "tipo_programa"},
                {"data": "pro_nombre"},
                {"data": "lider"},
                {"defaultContent": `<div class='text-center'>
                    <div class='btn-group'>
                        <button class='btn btn-success btnAdministrar'>Administrar</button>
                        </div>
                    </div>`},
                    {data: null,
                        render: function (data, type, row, ){
        
                            return type === 'display'
        
                            ?`<progress value="`+ data.evaluados + `" max="`+ data.totalestados +`"></progress>`
                            :data;
                        }},
            ],"language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" 
            }
    
        });  
        
    
    };  
       
    
    var fila; //captura la fila, para editar o eliminar
    //submit para el Alta y Actualización
    $('#formFichas').submit(function(e){         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        id_ficha = $.trim($('#id_ficha').val());    
        tipo_programa = $.trim($('#tipo_programa').val());                         
        pro_nombre = $.trim($('#nombre_programa').val());                         
        lider_ficha = $.trim($('#lider_ficha').val());   

    
            $.ajax({
              url: "../bd/crud.php",
              type: "POST",
              datatype:"json",    
              data:  {id_ficha:id_ficha, tipo_programa:tipo_programa, pro_nombre:pro_nombre, lider_ficha:lider_ficha, opcion:opcion},    
              success: function(data) {
                tablaFichas.ajax.reload(null, false);
               }
            });			        
        $('#modalCrudFicha').modal('hide');	
        
										     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta una Persona
    $("#btnNuevaFicha").click(function(){
   
        opcion = 5; //alta ficha           
        // id_usuario=null;
        $("#formFichas").trigger("reset");
        $(".modal-header").css( "background-color", "#28a745");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Nueva Ficha");
        $('#modalCrudFicha').modal('show');	    
        document.getElementById("id_ficha").disabled = false;
        document.getElementById("tipo_programa").disabled = false;
        document.getElementById("nombre_programa").disabled = false;

        
    });
    
    //Editar        
    $(document).on("click", ".btnEditarFicha", function(){		  

        opcion = 6;//editar
        fila = $(this).closest("tr");	        
        id_ficha = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
        lider_ficha = fila.find('td:eq(3)').text();
        // lider = document.getElementById("lider_ficha").value;
        // lider_ficha = parseInt($.trim($('#lider_ficha').val()));       
        
        // let lider_ficha = parseInt($('#lider_ficha').val());
        
        $("#id_ficha").val(id_ficha);
        $("#lider_ficha").val(lider_ficha);

        $(".modal-header").css("background-color", "#343a40");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Ficha: "+id_ficha);		
        $('#modalCrudFicha').modal('show');	
        document.getElementById("id_ficha").disabled = true;
        document.getElementById("tipo_programa").disabled = true;
        document.getElementById("nombre_programa").disabled = true;
        

    
    });

    
    //Borrar
    $(document).on("click", ".btnBorrarFicha", function(){
        fila = $(this);           
        id_ficha = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
        opcion = 7; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+id_ficha+"?");
                        
        if (respuesta) {            
            $.ajax({
              url: "../bd/crud.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, id_ficha:id_ficha},    
              success: function() {
                tablaFichas.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
    


     
    $(document).on("click", ".btnAdministrar", function(){

        fila = $(this).closest("tr");	        
        ficha_consulta = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		
        programa_consulta = fila.find('td:eq(2)').text();
        



        // $('#botonAdministrar').attr('disabled',false);


            // $.ajax({
            //     url: "../bd/crud.php",
            //     type: "POST",
            //     datatype:"json",    
            //     data: {ficha_consulta:ficha_consulta, programa_consulta:programa_consulta},
            //     success: function(data){
            //         location.href = "seguimiento.php";
            //         alert(programa_consulta);
                    
            //     }
            // })


        //     $.ajax({
        //         url: "seguimiento.php",
        //         type: "POST",
        //         datatype:"json",    
        //         data: {ficha_consulta:$('#ficha_consulta').val(), programa_consulta:$('#programa_consulta').val()}
        //     }).done(
        //         function(data){
        //             location.href = "seguimiento.php";
        //         }
        //     )
        // });
    
         
        // var ficha_cons = programa_consulta;
        // var programa_cons = programa_consulta;
        // $.post('seguimiento.php', {ficha_cons:ficha_cons, programa_cons:programa_cons},function (data) {
        //         if (data!=null) {
        //             alert(programa_cons);
        //             alert('Datos enviados correctamente');
        //             location.href = "seguimiento.php";

        //         }else{
        //             alert('Error al enviar los datos');
        //         }
        //     });
 
            var ficha_cons = ficha_consulta;
            var programa_cons = programa_consulta;
            // window.location = "../bd/crud.php?ficha=" + ficha_cons + "&programa=" + programa_cons;
            window.location = "seguimiento.php?ficha=" + ficha_cons + "&programa=" + programa_cons;
        
        
    //    $.ajax({
    //             url: '../bd/crud.php',
    //             type: 'POST',
    //             datatype: "json",
    //             data: ficha_consulta, programa_consulta,
    //             })
    //             .done(function(data){
                    
    //                 alert(ficha_consulta);
    //                 alert(programa_consulta);
    //                 location.href = "seguimiento.php";
    //             })
    //             .fail(function(){
    //                 console.log("error");
    //             })
    //             .always(function(){
    //                 console.log("complete");
    //             });
    //         });         
    });
});



    // TABLA SEGUIMIENTO 
    

$(document).ready(function() {

    let opcion;
    opcion = 12;
    
    tablaSeguimiento = $('#tablaSeguimiento').DataTable({  

 
        "ajax":{            
            "url": "../bd/crud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion, ficha:fichaConsulta, programa:programaConsulta }, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
            
        },
        

        "columns":[
            {"data": "rap_id"},        
            {"data": "competencia"},
            {"data": "resultado"},
            {"data": "tipo_resultado"},
            {"data": "fecha_inicio"},
            {"data": "fecha_fin"},
            {data: "estado"
            ,
            render:function(data, type, row){
           
                if (type === 'display'){
                    let color = 'green';
                    if (data == "Pendiente"){
                        
                        color = 'red';
                    }else if (data == "En ejecución"){
                        background = 'black',
                        color = 'orange';
                    }
                    return '<span style="color:' + color+';">' + data + '</span>';
                }
                return data;
            },
            },
            {"data": "observacion"},
            {"defaultContent": `<div class='text-center'>
                <div class='btn-group'>
                    <button class='btn btn-success btnEditarFichaSeguimiento'><i class='fas fa-edit'></i></button> 
                    <button class='btn btn-danger btnBorrarFichaSeguimiento'><i class='fas fa-trash'></i></button>
                    </div>
                </div>`},
        
        ],       
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" 
        },
        responsive: "true",
        dom: '<"top"Bf>rt<"bottom"lpi><"clear">',
        buttons: [
            // {
            //     extend: 'excelHtml5',
            //     text: '<i class="fas fa-file-excel"></i>',
            //     titleAttr: 'Exportar a excel',
            //     className: 'btn btn-success'
            // }
            'csv', 'excel', 'pdf', 'print'
        ]
        // ,


        // "createdRow":function(row,data,index){
        //     if (data[6] == "Evaluado"){
        //         // $(row).addClass( 'important');
        //         $('td', row).eq(6).css({
        //             'background-color':'#008000', //verde
        //             'color':'white',
        //         })
                
        //     }
            
        //     if (data[6] == "Pendiente"){
        //         // $(row).addClass( 'important');
        //         $('td', row).eq(6).css({
        //             'background-color':'#FF3333',  //rojo
        //             'color':'white',
        //         })
        //     }
        //     if (data[6] == "En ejecución"){
        //         // $(row).addClass( 'important');
        //         $('td', row).eq(6).css({
        //             'background-color':'#FFAC33', //amarillo
        //             'color':'white',
        //         })
        //         }
        //     }
        });

        var fila; //captura la fila, para editar o eliminar
    //submit para el Alta y Actualización
    $('#actualizar').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        ficha = $.trim($('#ficha').val());    
        rap_id = $.trim($('#rap_id').val());
        competencia = $.trim($('#competencia').val());    
        resultado = $.trim($('#resultado').val());    
        tipo_resultado = $.trim($('#tipo_resultado').val());
        fecha_inicio = $.trim($('#fecha_inicio').val());                            
        fecha_fin = $.trim($('#fecha_fin').val());                            
        estado_resultado = $.trim($('#estado_resultado').val()); 
        observacion = $.trim($('#observacion').val()); 
                              
            $.ajax({
              url: "../bd/crud.php",
              type: "POST",
              datatype:"json",    
              data:  {ficha:ficha, rap_id:rap_id, competencia:competencia, resultado:resultado, tipo_resultado:tipo_resultado, fecha_inicio:fecha_inicio, fecha_fin:fecha_fin, estado_resultado:estado_resultado, observacion:observacion, opcion:opcion},    
              success: function(data) {
                tablaSeguimiento.ajax.reload(null, false);
               }
            });			        
        $('#modalCrudSeguimiento').modal('hide');	
        										     			
    });


    //Editar        
    $(document).on("click", ".btnEditarFichaSeguimiento", function(){		        
        opcion = 10;//editar
        fila = $(this).closest("tr");	        
        rap_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
        competencia = fila.find('td:eq(1)').text();
        resultado = fila.find('td:eq(2)').text();
        tipo_resultado = fila.find('td:eq(3)').text();
        fecha_inicio = fila.find('td:eq(4)').text();
        fecha_fin = fila.find('td:eq(5)').text();
        estado_resultado = fila.find('td:eq(6)').text();
        observacion = fila.find('td:eq(7)').text();
        $("#rap_id").val(rap_id);
        $("#competencia").val(competencia);
        $("#resultado").val(resultado);
        $("#tipo_resultado").val(tipo_resultado);
        $("#fecha_inicio").val(fecha_inicio);
        $("#fecha_fin").val(fecha_fin);
        $("#estado_resultado").val(estado_resultado);
        $("#observacion").val(observacion);
        $(".modal-header").css("background-color", "#343a40");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar resultado");		
        $('#modalCrudSeguimiento').modal('show');	
        
    });

    //Borrar
    $(document).on("click", ".btnBorrarFichaSeguimiento", function(){
        alert("No es posible eliminar un resultado");
        // fila = $(this);           
        // rap_id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
        // opcion = 11; //eliminar       
        // var respuesta = confirm("¿Está seguro de borrar el registro "+rap_id+"?"); 
        

        // if (respuesta) {            
        //     $.ajax({
        //       url: "../bd/crud.php",
        //       type: "POST",
        //       datatype:"json",    
        //       data:  {opcion:opcion, rap_id:rap_id},    
        //       success: function() {
        //           tablaUsuarios.row(fila.parents('tr')).remove().draw();                  
        //        }
        //     });	
        // }
     });


    });


