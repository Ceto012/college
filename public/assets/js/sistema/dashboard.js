var valor = 1;

$(document).ready(function() {
    // Código que se ejecutará cuando el DOM esté listo

    if(valor == 1){
        $('.exito').show();
    }else {
        $('.error').show();
    }
});