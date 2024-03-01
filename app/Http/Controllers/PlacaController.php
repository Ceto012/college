<?php

namespace App\Http\Controllers;

use App\Models\Placa;
use App\Http\Requests\PlacaRequest;
use Illuminate\Http\Request;


class PlacaController extends Controller
{
    protected $placa;

    public function __construct(Placa $placa)
    {
        $this->placa = $placa::all();
    }

    public function index()
    {
        return view('placas.index', ['placas' => $this->placa]);
    }

    public function obtenerDatos()
    {
        $placas = Placa::all();
        return response()->json($placas);
    }

    public function buscarRegistro($codigo)
    {
        $registro = Placa::buscarPorCodigo($codigo);

        if ($registro) {
            return response()->json(['success' => true, 'message' => 'Registro encontrado', 'registro' => $registro]);
        } else {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado'], 404);
        }
    }

    public function eliminarRegistro($codigo)
    {
      
        $registro = Placa::eliminarPorCodigo($codigo);

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

            Placa::importarDesdeCSV($email);

            return response()->json(['success' => true, 'message' => 'Archivo CSV importado correctamente']);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => 'Error al cargar el archivo CSV: ' . $e->getMessage()], 400);
        }
    }
}
