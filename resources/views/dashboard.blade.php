@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid content-inner mt-n4 py-3">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card min-vh-85">
                        <div class="flex-wrap card-header d-flex justify-content-between align-items-center" style="background-color: var(--bs-primary)">
                            <div class="col-10 header-title head-zone" style="color: black">
                                <b> NOTIFICACIONES-ROBO-NIÑOS </b>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!-- Div para alinear a la derecha -->
                                <button id="fullscreenButton" class="btn btn-icon" onclick="toggleFullscreen()">
                                    <span class="btn-inner">
                                        <svg id="fullscreenIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" width="16" height="16" style="color: black">
                                            <path d="M0 180V56c0-13.3 10.7-24 24-24h124c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H64v84c0 6.6-5.4 12-12 12H12c-6.6 0-12-5.4-12-12zM288 44v40c0 6.6 5.4 12 12 12h84v84c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12V56c0-13.3-10.7-24-24-24H300c-6.6 0-12 5.4-12 12zm148 276h-40c-6.6 0-12 5.4-12 12v84h-84c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h124c13.3 0 24-10.7 24-24V332c0-6.6-5.4-12-12-12zM160 468v-40c0-6.6-5.4-12-12-12H64v-84c0-6.6-5.4-12-12-12H12c-6.6 0-12 5.4-12 12v124c0 13.3 10.7 24 24 24h124c6.6 0 12-5.4 12-12z" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-5 mb-4">
                                    <div class="card-header">
                                        <h3 class="mb-0">DATOS DEL ALUMNO</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size: 1.25rem;">Código Alumno:</td>
                                                        <td style="font-size: 1.25rem;" id="codigoAlumno" class="fw-bold">12345</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 1.25rem;">Nombre Alumno:</td>
                                                        <td style="font-size: 1.25rem;" id="nombreAlumno" class="fw-bold">Juan Perez</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 1.25rem;">Apoderado:</td>
                                                        <td style="font-size: 1.25rem;" id="apoderado" class="fw-bold">Maria Lopez</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 1.25rem;">Placa:</td>
                                                        <td style="font-size: 1.25rem;" id="placa" class="fw-bold">ABC123</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7" style="display: flex; flex-direction: column;">
                                    <div style="flex: 1">
                                        <div class="contenedor-grid" style="height: 80%;">
                                            <div class="contenedor-toast" id="contenedor-toast" style="display: flex; flex-direction: column; gap: 20px; align-items: center; justify-content: center; height: 80%">
                                                <div class="toasted exito" style="display: none;">
                                                    <div class="contenido">
                                                        <div class="icono">🎉</div>
                                                        <div>
                                                            <div class="titulo">Éxito</div>
                                                            <div class="texto">Se ha completado la acción con éxito.</div>
                                                        </div>
                                                    </div>
                                                    <button class="btn-cerrar">X</button>
                                                </div>
                                                <div class="toasted error" style="display: none;">
                                                    <div class="contenido">
                                                        <div class="icono">❌</div>
                                                        <div>
                                                            <div class="titulo">Error</div>
                                                            <div class="texto">Ha ocurrido un error al procesar la solicitud.</div>
                                                        </div>
                                                    </div>
                                                    <button class="btn-cerrar">X</button>
                                                </div>
                                                <!-- Agrega más elementos de toast aquí si es necesario -->
                                            </div>
                                        </div>

                                    </div>
                                    <div style="flex: 1; display: flex; justify-content: center; align-items: center;">
                                        <img id="fullscreen-img" src="{{ asset('assets/img/auto.jpeg') }}" alt="Descripción de la imagen" class="img-fluid shadow border-radius-xl">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection