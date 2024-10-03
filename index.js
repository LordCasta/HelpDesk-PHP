function init(){
}

console.log("Hola Estebitan")


$(document).ready(function() {
    $('#tick_descrip').summernote({
        height:150
    });

    $.post("../controller/categoria.php?op=combo", function(data, status){
        $('#cat_id').html(data);
    });
});

function startGoogleSignIn(){
    //TODO: Obtener la instancia de autenticación de Google
    const auth = gapi.auth2.getAuthInstance();
     //TODO: Iniciar sesión con Google
     auth.signIn();
}

function handleCredentialResponse(response){
    if(response && response.credential){
        const credentialToken = response.credential;
        //TODO: Decodificar el token manualmente para obtener datos del usuario
        const decodedToken = JSON.parse(atob(credentialToken.split('.')[1]));
        //TODO: Imprimir en la consola los datos del usuario
        console.log(decodedToken);

        $.ajax({
            url:'controller/usuario.php?op=accesogoogle',
            type:'post',
            data:{usu_correo:decodedToken.email},
            success: function(data){
                console.log(data);
                if(data === "0"){
                    swal("Advertencia!", "Usuario no Registrado", "warning");
                }else if (data==="1"){
                    window.location.href = 'view/Home/'
                }
            }
        });
    }
}

init();