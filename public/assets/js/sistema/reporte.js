$(document).ready(function () {
    // Asignar función al evento submit del formulario
    $("#form-reporte").submit(enviarFormulario);

    $("#table_reporte").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-10'i><'col-sm-12 col-md-2'p>>",
        buttons: [
            {
                extend: "excel",
                className: "btn bg-secondary text-white",
                text: '<i class="fa fa-file-excel"></i> Exportar Excel',
            },
            {
                extend: "pdf",
                className: "btn bg-secondary text-white",
                text: '<i class="fa fa-file-pdf"></i> Exportar PDF',
            },
        ],
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty:
                "Mostrando registros del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix: "",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oAria: {
                sSortAscending:
                    ": Activar para ordenar la columna de manera ascendente",
                sSortDescending:
                    ": Activar para ordenar la columna de manera descendente",
            },
        },
    });

    // Anular estilos de DataTables Buttons y aplicar estilos de Bootstrap
    $(".dt-buttons").addClass("btn-group");
    $(".buttons-excel").removeClass("dt-button").addClass("btn");
    $(".buttons-pdf").removeClass("dt-button").addClass("btn");
    $(".buttons-print").removeClass("dt-button").addClass("btn");


});

//Funcion para mandar mi archivo CSV a mi contrador
function enviarFormulario(event) {
    event.preventDefault();

    var formData = new FormData($(this)[0]);

    $.ajax({
        url: "/busqueda-reporte",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function (response) {
            //console.log(response);
            if (response.success) {
                // Mostrar mensaje de éxito con SweetAlert
                /*Swal.fire({
                    icon: "success",
                    title: "Éxito",
                    text: response.message,
                });*/

                // Limpia la tabla antes de agregar nuevos datos
                $("#table_reporte").DataTable().clear().draw();

                // Itera sobre los resultados y agrégalos a la tabla
                response.resultados.forEach(function (resultado) {
                    $("#table_reporte")
                        .DataTable()
                        .row.add([
                            resultado.id,
                            resultado.placa,
                            resultado.fecha,
                            //resultado.created_at,
                            //resultado.updated_at,
                            // Agrega más columnas según sea necesario
                        ])
                        .draw();
                });
            } else {
                // Mostrar mensaje de error con SweetAlert
                Swal.fire({
                    icon: "warning",
                    title: "",
                    text: response.message,
                });

                // Limpia la tabla antes de agregar nuevos datos
                $("#table_reporte").DataTable().clear().draw();
            }
            $("#form-reporte")[0].reset();
            //$("#table_reporte").DataTable().ajax.reload();
        },
        error: function (error) {
            response = JSON.parse(error.responseText);
            Swal.fire({
                icon: "error",
                title: "Error",
                text: response.message,
            });
        },
    });
}

// Función para convertir fecha de formato ISO8601 a 'dd/mm/yyyy'
function formatDate(dateString) {
    var fecha = new Date(dateString);
    var dia = fecha.getDate();
    var mes = fecha.getMonth() + 1; // Los meses en JavaScript comienzan desde 0
    var anio = fecha.getFullYear();
    return (
        (dia < 10 ? "0" : "") +
        dia +
        "/" +
        (mes < 10 ? "0" : "") +
        mes +
        "/" +
        anio
    );
}
