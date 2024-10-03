function init(){

}


$(document).ready(function(){

    const url = window.location.href;
    const params = new URLSearchParams(new URL(url).search);
    const tick_id = params.get("ID");
    const decoded_id = decodeURIComponent(tick_id);
    const id = decoded_id.replace(/\s/g, '+');

    
    mostraryvalidar(id);




    $('#tick_descrip').summernote({
        height: 150,
        lang: "es-ES",
        callbacks: {
            onImageUpload: function(image) {
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function (e) {
                console.log("Text detect...");
            }
        },
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $('#tickd_descripusu').summernote({
        height:200,
        lang: "es-ES",
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
        // callbacks: {
        //     onImageUpload: function(image) {
        //         console.log("Image detect...");
        //         myimagetreat(image[0]);
        //     },
        //     onPaste: function(e){
        //         console.log("Text detect...");
        //     }
        // }
    });

    // $('#tickd_descripusu').summernote({
    //     height:400,
    //     lang: "es-ES"
    // });

    $('#tickd_descripusu').summernote('disable');

    tabla=$('#documentos_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
                ],
        "ajax":{
            url: '../../controller/documento.php?op=listar',
            type : "post",
            data : {tick_id: id},
            dataType : "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).DataTable();


    $.post("../../controller/categoria.php?op=combo", function(data, status){
        $('#cat_id').html(data);
    });
});


 var getUrlParameter = function getUrlParameter(sParam) {
     var sPageURL = decodeURIComponent(window.location.search.substring(1)),
         sURLVariables = sPageURL.split('&'),
         sParameterName,
        i;

     for (i = 0; i < sURLVariables.length; i++) {
         sParameterName = sURLVariables[i].split('=');

         if (sParameterName[0] === sParam) {
             return sParameterName[1] === undefined ? true : sParameterName[1];
         }
     }
 };

$(document).on("click", "#btnenviar", function(){
    const url=window.location.href;
    const params = new URLSearchParams(new URL(url).search);
    const decoded_id = decodeURIComponent(tick_id);
    const id = decoded_id.replace(/\s/g, '+');

    var tick_id = params.get('ID');
    var usu_id =  $('#user_idx').val();
    var tickd_descrip =  $('#tickd_descrip').val();

    if($('#tickd_descrip').summernote('isEmpty')){
        swal("Advertencia!", "Falta descripción", "warning");
    }else{
        var formData = new FormData();
        formData.append('tick_id', id );
        formData.append('usu_id', usu_id );
        formData.append('tickd_descrip', tickd_descrip );

        var totalfiles = $('#fileElem').val().length;
        /* TODO:Agregamos los documentos adjuntos en caso hubiera */
        for (var i = 0; i < totalfiles; i++) {
            formData.append("files[]", $('#fileElem')[0].files[i]);
        }

        /* TODO:Insertar detalle */
        $.ajax({
            url: "../../controller/ticket.php?op=insertdetalle",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data);



                /* TODO: Limpiar inputfile */
                $('#fileElem').val('');
                $('#tickd_descrip').summernote('reset');
                swal("Correcto!", "Registrado Correctamente", "success");

                $.unblockUI();

            },beforeSend: function(){
                $.blockUI({
                    overlayCSS:  {
                        background: 'rgba(142, 159, 167, 0.3)',
                        opacity: 1,
                        cursor: 'wait'
                    },
                    css: {
                        width: 'auto',
                        top: '45%',
                        left: '45%'
                    },
                    message: '<div class="blockui-default-message">Espere...</div>',
                    blockMsgClass: 'block-msg-message-loader'
                });
            },
        });

        mostraryvalidar(id);
    }



});


$(document).on("click", "#btncerrarticket", function(){

        swal({
                    title: "HelpDesk",
                    text: "Está seguro de cerrar el ticket?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-warning",
                    confirmButtonText: "Si!",
                    cancelButtonText: "No!",
                    closeOnConfirm: false
                },
                function(isConfirm) {
                    if (isConfirm) {

                        const url = window.location.href;
                        const params = new URLSearchParams(new URL(url).search);
                        const tick_id = params.get("ID");
                        const decoded_id = decodeURIComponent(tick_id);
                        const id = decoded_id.replace(/\s/g, '+');

                        $.ajax({
                            url:"../../controller/ticket.php?op=update",
                            type:"POST",
                            data:{tick_id  : id},
                            success: function(datos){
                                console.log('datos :>> ', datos);
                                mostraryvalidar(id);

                                swal("Correcto!", "Ticked Cerrado", "success");

                                $.unblockUI();



                            },beforeSend: function(){
                                $.blockUI({
                                    overlayCSS:  {
                                        background: 'rgba(142, 159, 167, 0.3)',
                                        opacity: 1,
                                        cursor: 'wait'
                                    },
                                    css: {
                                        width: 'auto',
                                        top: '45%',
                                        left: '45%'
                                    },
                                    message: '<div class="blockui-default-message">Espere...</div>',
                                    blockMsgClass: 'block-msg-message-loader'
                                });
                            },

                        });

                        // $.post("../../controller/ticket.php?op=update", {  }, function (data){
                        //    console.log('data :>> ', data);
                        // });

                        swal({
                            title: "HelpDesk",
                            text: "Ticket Cerrado Correctamente.",
                            type: "success",
                            confirmButtonClass: "btn-success"
                        });



                        $.post("../../controller/email.php?op=ticket_cerrado",{tick_id : id}, function (data){
                            console.log('data :>> ', data);
                        });


                    }
                });
    });

function mostraryvalidar(id){



    $.post("../../controller/ticket.php?op=listardetalle", { tick_id  : id }, function (data){
        $('#lbldetalle').html(data);
    });

    $.post("../../controller/ticket.php?op=mostrar", { tick_id  : id }, function (data){
        data = JSON.parse(data);
        $('#lblestado').html(data.tick_estado);
        $('#lblnomusuario').html(data.usu_nom + ' '+data.usu_ape);
        $('#lblfechcrea').html(data.fech_crea);
        $('#lblnomidticket').html("Detalle ticket - "+data.tick_id);
        $('#cat_nom').val(data.cat_nom);
        $('#cats_nom').val(data.cats_nom);
        $('#tick_titulo').val(data.tick_titulo);
        $('#tickd_descripusu').summernote('code',data.tick_descrip);
        $('#prio_nom').val(data.prio_nom);

        if (data.tick_estado_texto =="Cerrado"){
            $('#pnldetalle').hide();
        }

        $.post("../../controller/notificacion.php?op=update_notificacion_estado_read", { tick_id  : id }, function (data){
            $('#lbldetalle').html(data);
        });



    });

}

init();
