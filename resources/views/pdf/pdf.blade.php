<!DOCTYPE html>
<html>
<head>
    <title>Placas</title>
    <style>
        /* Estilos para el PDF */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
        }
        th {
            background-color: #217aaa; /* Color de encabezado */
            color: white; /* Texto en color blanco */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Fondo de fila para filas pares */
        }
        tr:nth-child(odd) {
            background-color: #dddddd; /* Fondo de fila para filas impares */
        }
        h2 {
            text-align: center; /* Centrar el título */
        }
    </style>
</head>
<body>
    <h2>Placas Registradas</h2>
    <table>
        <thead>
            <tr>
                <th>Codigo Alumno</th>
                <th>Nombre Alumno</th> 
                <th>Apoderado</th>
                <th>Placa</th>
                <!-- Agregar más columnas si es necesario -->
            </tr>
        </thead>
        <tbody>
            @foreach ($placas as $placa)
            <tr>
                <td>{{ $placa->cod_student }}</td>
                <td>{{ $placa->name }}</td> 
                <td>{{ $placa->proxy }}</td>
                <td>{{ $placa->plate }}</td>
                <!-- Agregar más columnas si es necesario -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
