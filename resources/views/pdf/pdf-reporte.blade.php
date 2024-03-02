<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Placas</title>
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
            text-align: center; /* Alineación centrada para todas las celdas */
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
    <h2>Reporte de Placas</h2>
    <table>
        <thead>
            <tr>
                <th>Apoderado</th>
                <th>Placa</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($placas as $placa)
            <tr>
                <td>{{ $placa[0] }}</td>
                <td>{{ $placa[1] }}</td>
                <td>{{ $placa[2] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
