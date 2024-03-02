<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Plate;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function generarReporte(Request $request)
    {
        try {
            $tipoBusqueda = $request->input('tipo-busqueda');
            $fInicio = $request->input('f-inicio');
            $fFinal = $request->input('f-final');
            $placa = $request->input('placa');
            //$codigo = $request->input('codigo');

            switch ($tipoBusqueda) {
                case 'placa':
                    // Realizar la búsqueda por placa
                    $resultados = Registro::where('plate', $placa)
                        ->whereBetween('fecha', [$fInicio, $fFinal])
                        ->get();

                    // Obtener el apoderado correspondiente a la placa
                    $apoderado = Plate::where('plate', $placa)->value('proxy');
                    //dd($apoderado);
                    break;
                default:
                    // Tipo de búsqueda no válido
                    return response()->json(['success' => false, 'message' => 'Tipo de búsqueda no válido'], 400);
            }

            if ($resultados->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Sin resultados']);
            }

            // Agregar el apoderado a cada resultado
            foreach ($resultados as $resultado) {
                $resultado->proxy = $apoderado;
            }

            // Retornar los resultados
            
            return response()->json(['success' => true, 'resultados' => $resultados]);
            
        } catch (\Exception $e) {
            // Manejar el error y devolver una respuesta de error
            return response()->json(['success' => false, 'message' => 'Error al generar el reporte: ' . $e->getMessage()], 500);
        }
    }

    /*public function listen()
    {
        // Establecer cabeceras SSE
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');

        // Enviar evento
        echo "data: {\"message\": \"Mensaje!\"}\n\n";
        flush();

        // Lógica para enviar más eventos...
    }*/

    /*public function listen()
    {
        // Establecer cabeceras SSE
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');

        // Verificar si se ha recibido un POST
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Obtener datos del POST
            $postData = file_get_contents('php://input');
            $postData = json_decode($postData, true);

            // Verificar si los datos contienen un mensaje
            if (isset($postData['mensaje'])) {
                // Enviar evento con el mensaje recibido
                echo "data: {\"message\": \"" . $postData['mensaje'] . "\"}\n\n";
                flush();
            }
        }

        // Lógica para enviar más eventos...
    }*/
}
