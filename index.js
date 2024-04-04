function init(){
}


$(document).ready(function() {
    $('#tick_descrip').summernote({
        height:150
    });

    $.post("../../controller/categoria.php?op=combo", function(data, status){
        $('#cat_id').html(data);
    });
});

$(document).on("click", "#btnsoporte", function(){

    if( $('#rol_id').val()==1){
        $('#lbltitulo').html("Acceso Soporte");
        $('#btnsoporte').html("Acceso Usuario");
        $('#rol_id').val(2);
        $('#imgtipo').attr("src","public/2.jpg");
    }else{
        $('#lbltitulo').html("Acceso Usuario");
        $('#btnsoporte').html("Acceso Soporte");
        $('#rol_id').val(1);
        $('#imgtipo').attr("src","public/1.jpg");
    }

  

});

init();