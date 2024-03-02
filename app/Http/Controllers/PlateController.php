<?php

namespace App\Http\Controllers;

use App\Models\Plate;
use App\Http\Requests\PlacaRequest;
use Illuminate\Http\Request;


class PlateController extends Controller
{
    protected $placa;

    public function __construct(Plate $placa)
    {
        $this->placa = $placa::all();
    }

    public function index()
    {
        return view('placas.index', ['placas' => $this->placa]);
    }

    public function obtenerDatos()
    {
        $placas = Plate::all();
        return response()->json($placas);
    }

    public function buscarRegistro($codigo)
    {
        //$registro = Placa::buscarPorCodigo($codigo);
        $registro = Plate::buscarPorCodigo($codigo);

        if ($registro) {
            return response()->json(['success' => true, 'message' => 'Registro encontrado', 'registro' => $registro]);
        } else {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado'], 404);
        }
    }

    public function registrarPlaca(Request $request)
    {
        try {
            // Llamar al método del modelo para registrar o actualizar la placa
            $placa = Plate::registrarOActualizarPlaca($request);

            // Determinar si se ha actualizado o creado la placa
            $accion = $placa->wasRecentlyCreated ? 'creada' : 'actualizada';

            // Retornar una respuesta exitosa
            return response()->json(['success' => true, 'message' => 'Placa ' . $accion . ' correctamente', 'placa' => $placa]);
        } catch (\Exception $e) {
            // Manejar el error y devolver una respuesta de error
            return response()->json(['success' => false, 'message' => 'Error al registrar o actualizar la placa: ' . $e->getMessage()], 500);
        }
    }

    public function eliminarRegistro($codigo)
    {

        $registro = Plate::eliminarPorCodigo($codigo);

        if ($registro) {
            return response()->json(['success' => true, 'message' => 'Placa eliminada correctamente']);
        } else {
            return response()->json(['success' => false, 'message' => 'No se encontró ninguna placa con ese código'], 404);
        }
    }

    public function importarCSV(PlacaRequest $request)
    {
        try {

            //Validacion de Request
            $validated = $request->safe();

            $email = $validated['archivo'];

            Plate::importarDesdeCSV($email);

            return response()->json(['success' => true, 'message' => 'Archivo CSV importado correctamente']);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => 'Error al cargar el archivo CSV: ' . $e->getMessage()], 400);
        }
    }
}
