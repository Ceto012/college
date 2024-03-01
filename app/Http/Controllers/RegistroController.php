<?php

namespace App\Http\Controllers;
use App\Models\Registro;
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
            $codigo = $request->input('codigo');

            switch ($tipoBusqueda) {
                case 'placa':
                    // Realizar la búsqueda por placa
                    $resultados = Registro::where('placa', $placa)
                        ->whereBetween('fecha', [$fInicio, $fFinal])
                        ->get();
                    break;
                case 'codigo':
                    // Realizar la búsqueda por código
                    /*$resultados = Registro::where('codigo', $codigo)
                        ->whereBetween('fecha', [$fInicio, $fFinal])
                        ->get();*/
                    break;
                default:
                    // Tipo de búsqueda no válido
                    return response()->json(['success' => false, 'message' => 'Tipo de búsqueda no válido'], 400);
            }

            if ($resultados->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Sin resultados']);
            }
    
            // Retornar los resultados
            return response()->json(['success' => true, 'resultados' => $resultados]);
        } catch (\Exception $e) {
            // Manejar el error y devolver una respuesta de error
            return response()->json(['success' => false, 'message' => 'Error al generar el reporte: ' . $e->getMessage()], 500);
        }
    }
}
