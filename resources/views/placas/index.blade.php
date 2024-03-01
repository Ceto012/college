@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Registro de Placas</h5>
                        </div>
                        <div>
                            <a href="#" class="btn bg-secondary btn-sm mb-0" style="color: white" onclick="abrirModal('modalSubirCSV')" type="button">+ Subir CSV</a>
                            <a href="#" class="btn bg-primary btn-sm mb-0" style="color: white" onclick="abrirModal('modalRegistroPlaca')" type="button">+ Registrar Placa</a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modalRegistroPlaca" tabindex="-1" aria-labelledby="registroPlacaModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="registroPlacaModalLabel">Registrar Placa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="formPlaca">
                                        <div class="modal-body">
                                            <!-- Aquí puedes agregar los campos del formulario para registrar la placa -->

                                            <div class="mb-3">
                                                <label for="codigoAlumno" class="form-label">Código Alumno</label>
                                                <input type="text" class="form-control upper" id="codigoAlumno" name="codigoAlumno" required minlength="6" maxlength="8" placeholder="Ingrese el código del alumno">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nombreAlumno" class="form-label">Nombre Alumno</label>
                                                <input type="text" class="form-control" id="nombreAlumno" name="nombreAlumno" maxlength="100" required placeholder="Ingrese el nombre del alumno">
                                            </div>
                                            <div class="mb-3">
                                                <label for="apoderado" class="form-label">Apoderado</label>
                                                <input type="text" class="form-control" id="apoderado" name="apoderado" maxlength="100" required placeholder="Ingrese el nombre del apoderado">
                                            </div>
                                            <div class="mb-3">
                                                <label for="placa" class="form-label">Placa</label>
                                                <input type="text" class="form-control upper" id="placa" name="placa" required placeholder="Ingrese la placa del vehículo sin guión">
                                            </div>
                                            <div class="mb-3">
                                                <label for="imagen" class="form-label">Imagen</label>
                                                <input type="file" class="form-control" id="imagen" name="imagen" accept=".jpg, .jpeg, .png">
                                            </div>
                                            <!-- Agrega los demás campos necesarios -->

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary" id="submitFormPlaca">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modalSubirCSV" tabindex="-1" aria-labelledby="modalSubirCSVLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog modal-dialog-centered ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalSubirCSVLabel">Subir archivo CSV</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="formSubirCSV" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <!-- Formulario para subir archivo CSV -->

                                            @csrf
                                            <div class="mb-3">
                                                <label for="archivoCSV" class="form-label">Seleccionar archivo CSV:</label>
                                                <input class="form-control" type="file" id="archivo" name="archivo" accept=".csv" required>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary" id="submitForm">Subir CSV</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                    </div>
                </div>
                <div class="card-body px-0 pt-5 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table_plate">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Codigo Alumno
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nombre Alumno
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Apoderado
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Placa
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Imagen
                                    </th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Fecha
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Accion
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- @foreach ($placas as $placa)
                                <tr>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $placa->cod_estudiante }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $placa->nombre }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $placa->apoderado }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $placa->placa }}</p>
                                    </td>
                                    <td class="text-center">
                                        <div>
                                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">16/06/18</span>
                                    </td>

                                    <td class="text-center">
                                        <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection