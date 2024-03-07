//Obtener valores del WebSocket
Echo.channel('placadash').listen('NewMessagePlate', (e) => {
    VisualizarDatos(e.data);
})

var valor = 1;

$(document).ready(function () {
    // Código que se ejecutará cuando el DOM esté listo

    if (valor == 1) {
        $('.exito').show();
    } else {
        $('.error').show();
    }

    
});

function mostrarAlerta(data){
    if (data == true) {
        $('.error').hide();
        $('.exito').show();
    } else {
        $('.exito').hide();
        $('.error').show();
    }
}

function VisualizarDatos(data){
    // Accede a los datos del evento e imprímelos en la consola

    if(data.success){
        buscarPlaca(data.plate);
        mostrarAlerta(data.success);
        //console.log('Message:', data.message);
    }else {
        mostrarAlerta(data.success);
        denegarIngreso();
    }
}

function buscarPlaca(placa){
    $.ajax({
        url: '/buscar-placa/'+ placa,
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            //console.log(data);
            // Rellenar los datos en la tabla
            //$('#codigoAlumno').text(data.id); // Cambia data.id por el campo correspondiente en tu respuesta JSON
            //$('#nombreAlumno').text(data.name); // Cambia data.name por el campo correspondiente en tu respuesta JSON
            $('#apoderado').text(data.registro.proxy); // Cambia data.username por el campo correspondiente en tu respuesta JSON
            $('#placa').text(data.registro.plate); // Cambia data.email por el campo correspondiente en tu respuesta JSON

            var imagenSrc = data.registro.image ? '/assets/imagenes/' + data.registro.image : '/assets/img/contenido-no-disponible.jpg';
            $('#fullscreen-img').attr('src', imagenSrc);
           
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los datos:', error);
        }
    });
}

function denegarIngreso(){
    let mensaje = 'SIN RESULTADOS';
    $('#apoderado').text(mensaje); 
    $('#placa').text(mensaje); 
    $('#fullscreen-img').attr('src', '/assets/img/contenido-no-disponible.jpg');
           
}
