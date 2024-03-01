var valor = 1;

$(document).ready(function () {
    // Código que se ejecutará cuando el DOM esté listo

    if (valor == 1) {
        $('.exito').show();
    } else {
        $('.error').show();
    }
});

$(document).ready(function () {
    $.ajax({
        url: 'https://jsonplaceholder.typicode.com/users/1',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Rellenar los datos en la tabla
            $('#codigoAlumno').text(data.id); // Cambia data.id por el campo correspondiente en tu respuesta JSON
            $('#nombreAlumno').text(data.name); // Cambia data.name por el campo correspondiente en tu respuesta JSON
            $('#apoderado').text(data.username); // Cambia data.username por el campo correspondiente en tu respuesta JSON
            $('#placa').text(data.email); // Cambia data.email por el campo correspondiente en tu respuesta JSON
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los datos:', error);
        }
    });
});

