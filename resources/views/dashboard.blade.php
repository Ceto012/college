@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid content-inner mt-n4 py-3">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card min-vh-85">
                            <div class="flex-wrap card-header d-flex justify-content-between align-items-center"
                                style="background-color: var(--bs-primary)">
                                <div class="col-10 header-title head-zone" style="color: black">
                                    <b> NOTIFICACIONES-ROBO-NIÑOS </b>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <!-- Div para alinear a la derecha -->
                                    <button id="fullscreenButton" class="btn btn-icon" onclick="toggleFullscreen()">
                                        <span class="btn-inner">
                                            <svg id="fullscreenIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" width="16" height="16" style="color: black">
                                                <path
                                                    d="M0 180V56c0-13.3 10.7-24 24-24h124c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H64v84c0 6.6-5.4 12-12 12H12c-6.6 0-12-5.4-12-12zM288 44v40c0 6.6 5.4 12 12 12h84v84c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12V56c0-13.3-10.7-24-24-24H300c-6.6 0-12 5.4-12 12zm148 276h-40c-6.6 0-12 5.4-12 12v84h-84c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h124c13.3 0 24-10.7 24-24V332c0-6.6-5.4-12-12-12zM160 468v-40c0-6.6-5.4-12-12-12H64v-84c0-6.6-5.4-12-12-12H12c-6.6 0-12 5.4-12 12v124c0 13.3 10.7 24 24 24h124c6.6 0 12-5.4 12-12z" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5" style="height: 80vh; padding: 20px;">
                                        <form>
                                            <div class="mb-3">
                                                <label for="codigoAlumno"   style="font-size: 25px" class="form-label">Código Alumno: </label>
                                                <label id="codigoAlumno" style="font-size: 25px" class="" readonly>12345</label>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nombreAlumno" class="form-label">Nombre Alumno</label>
                                                <label id="nombreAlumno" class="form-control custom-input" readonly>Juan Perez</label>
                                            </div>
                                            <div class="mb-3">
                                                <label for="apoderado" class="form-label">Apoderado</label>
                                                <label id="apoderado" class="form-control custom-input" readonly>Maria Lopez</label>
                                            </div>
                                            <div class="mb-3">
                                                <label for="placa" class="form-label">Placa</label>
                                                <label id="placa" class="form-control custom-input" readonly>ABC123</label>
                                            </div>
                                            <!-- Agrega los demás campos necesarios -->
                                        </form>
                                    </div>
                                    <div class="col-lg-7" style="display: flex; flex-direction: column;">
                                        <div style="flex: 1">
                                            <div class="contenedor-grid">
                                                <div class="contenedor-toast" id="contenedor-toast" style="display: flex; flex-direction: column; gap: 20px;">
                                                    <div class="toasted exito">
                                                        <div class="contenido">
                                                            <div class="icono">🎉</div>
                                                            <div>
                                                                <div class="titulo">Éxito</div>
                                                                <div class="texto">Se ha completado la acción con éxito.</div>
                                                            </div>
                                                        </div>
                                                        <button class="btn-cerrar">X</button>
                                                    </div>
                                                    <div class="toasted error">
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
                                        <div style="flex: 1; background-color: #4b6d72; display: flex; justify-content: center; align-items: center;">
                                            <img src="ruta/de/la/imagen.jpg" alt="Descripción de la imagen">
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