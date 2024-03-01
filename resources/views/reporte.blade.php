@extends('layouts.user_type.auth')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div></div>
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card p-4">
                        <div class="card-header pb-0 px-3">
                            <h4 class="mb-0">Reporte de Placas Vehiculares</h4>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <form action="/user-profile" method="POST" role="form text-left">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="tipo-placa" class="form-control-label">Tipo de Busqueda</label>
                                            <select class="form-select" id="tipo-placa">
                                                <option value="placa">Placa</option>
                                                <option value="codigo">Código</option>
                                                <option value="dni">DNI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="user-name" class="form-control-label">Fecha Inicio</label>
                                            <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                                <input class="form-control" value="" type="date" id="user-name"
                                                    name="name">
                                                @error('name')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="user-email" class="form-control-label">Fecha Fin</label>
                                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                                <input class="form-control" type="date" id="user-email" name="email">
                                                @error('email')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="placa-input">
                                        <div class="form-group">
                                            <label for="user-email" class="form-control-label">Placa</label>
                                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                                <input class="form-control" maxlength="6" type="text" id="user-email"
                                                    name="placa">
                                                @error('email')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="codigo-input" style="display: none;">
                                        <div class="form-group">
                                            <label for="codigo" class="form-control-label">Código</label>
                                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                                <input class="form-control" type="text" id="codigo" name="codigo">
                                                @error('email')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="dni-input" style="display: none;">
                                        <div class="form-group">
                                            <label for="dni" class="form-control-label">DNI</label>
                                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                                <input class="form-control" type="text" id="dni" name="dni">
                                                @error('email')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit"
                                        class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Generar Reporte' }}</button>
                                </div>
                            </form>

                            <script>
                                document.getElementById('tipo-placa').addEventListener('change', function() {
                                    var selectedValue = this.value;
                                    if (selectedValue === 'placa') {
                                        document.getElementById('placa-input').style.display = 'block';
                                        document.getElementById('codigo-input').style.display = 'none';
                                        document.getElementById('dni-input').style.display = 'none';
                                    } else if (selectedValue === 'codigo') {
                                        document.getElementById('placa-input').style.display = 'none';
                                        document.getElementById('codigo-input').style.display = 'block';
                                        document.getElementById('dni-input').style.display = 'none';
                                    } else if (selectedValue === 'dni') {
                                        document.getElementById('placa-input').style.display = 'none';
                                        document.getElementById('codigo-input').style.display = 'none';
                                        document.getElementById('dni-input').style.display = 'block';
                                    }
                                });
                            </script>


                        </div>
                    </div>
                </div>
                <br>
                <div class="col-12">
                    <div class="card mb-4 p-4">
                        <div class="card-header pb-0">
                            <div class="d-flex flex-row justify-content-between">
                            </div>
                        </div>
                        <div class="card-body px-0 pt-4 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Codigo Alumno
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Alumno
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Apoderado
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Placa
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Imagen
                                            </th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Fecha de Ingreso
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
                                                <p class="text-xs font-weight-bold mb-0">ICKKZK4</p>
                                            </td>
                                            <td class="text-center">
                                                <div>
                                                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-secondary text-xs font-weight-bold">16/06/18</span>
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
    </main>
@endsection
