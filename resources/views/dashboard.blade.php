@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid content-inner mt-n4 py-3">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="flex-wrap card-header d-flex justify-content-between align-items-center"
                            style="background-color: var(--bs-primary)">
                            <div class="col-10 header-title head-zone" style="color: black">
                                <b> NOTIFICACIONES-ROBO-NIÑOS </b>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!-- Div para alinear a la derecha -->
                                <button id="fullscreenButton" class="btn btn-icon">
                                    <span class="btn-inner">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-fullscreen" viewBox="0 0 16 16" style="color: black">
                                            <path
                                                d="M1.5 1a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4A1.5 1.5 0 0 1 1.5 0h4a.5.5 0 0 1 0 1zM10 .5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 16 1.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5M.5 10a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 0 14.5v-4a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v4a1.5 1.5 0 0 1-1.5 1.5h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection