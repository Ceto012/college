$(document).ready(function () {
    // Asignar función al evento submit del formulario
    $("#formSubirCSV").submit(enviarFormulario);

    $('#table_plate').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-12 col-md-10'i><'col-sm-12 col-md-2'p>>",
        buttons: [
            {
                extend: 'excel',
                className: 'btn bg-secondary text-white',
                text: '<i class="fa fa-file-excel"></i> Exportar Excel'
            },
            {
                extend: 'pdf',
                className: 'btn bg-secondary text-white',
                text: '<i class="fa fa-file-pdf"></i> Exportar PDF'
            }
        ],
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    // Anular estilos de DataTables Buttons y aplicar estilos de Bootstrap
    $('.dt-buttons').addClass('btn-group');
    $('.buttons-excel').removeClass('dt-button').addClass('btn');
    $('.buttons-pdf').removeClass('dt-button').addClass('btn');
    $('.buttons-print').removeClass('dt-button').addClass('btn');
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
