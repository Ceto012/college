@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4 p-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Registro de Anexos</h5>
                            </div>
                            <a href="" class="btn bg-primary btn-sm mb-0" data-bs-toggle="modal"
                                data-bs-target="#modalRegistroPlaca" style="color: white" type="button">+&nbsp; Registrar
                                Anexo</a>
                            <div class="modal fade" id="modalRegistroPlaca" tabindex="-1"
                                aria-labelledby="registroPlacaModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="registroPlacaModalLabel">Registro de Anexos</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Aquí puedes agregar los campos del formulario para registrar la placa -->
                                            <form>
                                                <div class="mb-3">
                                                    <label for="nombreAlumno" class="form-label">Nombre del Anexo</label>
                                                    <input type="text" class="form-control" id="nombreAlumno" placeholder="Ingrese el nombre del anexo">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="apoderado" class="form-label">Número del Anexo</label>
                                                    <input type="text" class="form-control" id="apoderado" placeholder="Ingrese el número de anexo">
                                                </div>
                                                <!-- Agrega los demás campos necesarios -->
                                            </form>                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nombre de Anexo
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Numero de Anexo
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Accion
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">1</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Pepito</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Thor</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="mx-3" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <span>
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
