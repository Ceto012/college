$(document).ready(function () {
    // Asignar función al evento submit del formulario
    $("#formSubirCSV").submit(enviarFormulario);
});

//Funcion para mandar mi archivo CSV a mi contrador
function enviarFormulario(event) {
    event.preventDefault(); 

    var formData = new FormData($(this)[0]);

    /*$.ajax({
        url: '{{ route("upload.csv") }}',
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success) {
                alert("El archivo CSV se ha cargado correctamente.");
            } else {
                alert("Hubo un error al cargar el archivo CSV.");
            }
        },
        error: function () {
            alert("Hubo un error al procesar la solicitud.");
        },
    });*/
}
