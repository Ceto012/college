$(document).ready(function () {
    // Asignar función al evento submit del formulario
    $("#formSubirCSV").submit(enviarFormulario);
    $("#formPlaca").submit(enviarFormularioPlaca);

    $("#table_plate").DataTable({
        dom:
            "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
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
            sSearch: "Buscar:",
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
        ajax: {
            url: "/listar-placas",
            type: "GET",
            dataSrc: "",
        },
        columns: [
            { data: "cod_estudiante" },
            { data: "nombre" },
            { data: "apoderado" },
            { data: "placa" },
            { data: "imagen" },
            {
                data: "created_at",
                render: function (data) {
                    return formatDate(data); // Llama a la función formatDate para formatear la fecha
                },
            },
            {
                // Columna de acciones
                targets: -1, // Aplicar a la última columna
                orderable: false, // No ordenar esta columna
                searchable: false, // No incluir en la búsqueda
                render: function (data, type, row) {
                    // Botones de editar y eliminar
                    return (
                        '<div class="acciones">' +
                        '<a href="#" class="editar" onclick="editarRegistro(\'' +
                        row.cod_estudiante +
                        '\')" data-bs-toggle="tooltip" data-bs-original-title="Editar usuario"><i class="fas fa-user-edit text-secondary mx-3"></i></a>' +
                        '<a href="#" class="eliminar" onclick="confirmarEliminacion(\'' +
                        row.cod_estudiante +
                        '\')" data-bs-toggle="tooltip" data-bs-original-title="Eliminar usuario"><i class="fas fa-trash text-secondary"></i></a>' +
                        "</div>"
                    );
                },
            },
        ],
    });

    // Anular estilos de DataTables Buttons y aplicar estilos de Bootstrap
    $(".dt-buttons").addClass("btn-group");
    $(".buttons-excel").removeClass("dt-button").addClass("btn");
    $(".buttons-pdf").removeClass("dt-button").addClass("btn");
    $(".buttons-print").removeClass("dt-button").addClass("btn");

    /*$.ajax({
        url: "/placadash",
        method: "GET",
        dataType: "JSON",
        success: function (response) {
            console.log(response);
        },
        error: function (error) {
            console.log(error.responseText);
        },
    });*/
});

//Funcion para mandar mi archivo CSV a mi contrador
function enviarFormulario(event) {
    event.preventDefault();

    var formData = new FormData($(this)[0]);

    $.ajax({
        url: "/importar-csv-placa",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function (response) {
            if (response.success) {
                // Mostrar mensaje de éxito con SweetAlert
                Swal.fire({
                    icon: "success",
                    title: "Éxito",
                    text: response.message,
                });
            } else {
                // Mostrar mensaje de error con SweetAlert
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: response.message,
                });
            }
            $("#formSubirCSV")[0].reset();
            $("#modalSubirCSV").modal("hide");
            $(".modal-backdrop").remove();
            $("#table_plate").DataTable().ajax.reload();
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

//Funcion para mandar mis datos de placa
function enviarFormularioPlaca(event) {
    event.preventDefault();

    var formData = new FormData($(this)[0]);

    $.ajax({
        url: "/registrar-placa",
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function (response) {
            console.log(response);
            if (response.success) {
                // Mostrar mensaje de éxito con SweetAlert
                Swal.fire({
                    icon: "success",
                    title: "Éxito",
                    text: response.message,
                });
            } else {
                // Mostrar mensaje de error con SweetAlert
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: response.message,
                });
            }
            $("#formPlaca")[0].reset();
            $("#modalRegistroPlaca").modal("hide");
            $(".modal-backdrop").remove();
            $("#table_plate").DataTable().ajax.reload();
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

// Función para editar un registro
function editarRegistro(codigo) {
    // Aquí puedes agregar la lógica para editar el registro con el ID especificado
    console.log("Editar registro con ID: " + codigo);

    $.ajax({
        url: "/buscar-cod-estudiante/" + codigo,
        method: "GET",
        dataType: "JSON",
        success: function (response) {
            console.log(response);
            // Actualizar el contenido del modal con los datos recibidos
            $("#codigoAlumno").val(response.registro.cod_estudiante);
            $("#nombreAlumno").val(response.registro.nombre);
            $("#apoderado").val(response.registro.apoderado);
            $("#placa").val(response.registro.placa);
            //$("#imagen").attr("src", response.registro.imagen);

            // Mostrar el modal
            $("#modalRegistroPlaca").modal("show");
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function confirmarEliminacion(codigo) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si se confirma la eliminación, hacer la solicitud de eliminación
            eliminarRegistro(codigo);
        }
    });
}

// Función para eliminar un registro
function eliminarRegistro(codigo) {
    // Aquí puedes agregar la lógica para confirmar la eliminación del registro con el ID especificado
    console.log("Eliminar registro con ID: " + codigo);

    $.ajax({
        url: '/eliminar-registro/' + codigo,
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.success) {
                // Mostrar mensaje de éxito con SweetAlert
                Swal.fire({
                    icon: "success",
                    title: "Éxito",
                    text: response.message,
                });
            } else {
                // Mostrar mensaje de error con SweetAlert
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: response.message,
                });
            }
            $("#table_plate").DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
            // Si hubo un error de AJAX, mostrar un mensaje de error
            Swal.fire('Error', 'Hubo un error al procesar la solicitud.', 'error');
        }
    });
}

function abrirModal(idModal) {
    $('#' + idModal).modal('show').find('form')[0].reset();
}

