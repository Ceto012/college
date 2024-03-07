<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\AsteriskHelper;
use App\Models\Placa;
use App\Models\Registro;
use Exception;
use Illuminate\Support\Carbon;
use App\Events\NewMessagePlate;
use App\Models\Plate;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

class RequestController extends Controller
{

    public function recibirMensaje(Request $request)
    {
        $mensaje = $request->json()->all();

        // Envía el mensaje a través de WebSocket
        WebSocketsRouter::broadcast([
            'action' => 'recibirMensaje',
            'mensaje' => $mensaje,
        ]);

        return response()->json(['status' => 'success']);
    }


    public function getPlate(Request $request)
    {
        try {
            $plateNumber = $this->getPlateNumber(json_decode($request->getContent(), true));

            if (!$plateNumber) {
                return response()->json(['error' => 'No se pudo obtener el número de placa del webhook'], 400);
            }

            $placa = $this->buscarPlacaBD($plateNumber);

            if (!$placa) {
                return $this->respuestaPlacaNoEncontrada();
            }

            $this->registrarPlaca($plateNumber);
            $this->vistainicial();
            //event(new NewMessagePlate('Nuevo mensaje'));
        } catch (\Exception $e) {
            Log::error('Error en la función getPlate: ' . $e->getMessage());
            return response()->json(['error' => 'Ha ocurrido un error en el servidor', 'Message' => $e->getMessage()], 500);
        }
    }

    public function vistainicial()
    {
        $ultimoRegistro = Registro::orderBy('id', 'desc')->first();
        $plate = collect([$ultimoRegistro]);
        return view('dashboard', ['plate' => $plate]);
    }
    private function getPlateNumber($data)
    {
        return $data[0]['data']['platesFound'][0]['plateNumber'] ?? null;
    }
    private function buscarPlacaBD(string $plateNumber)
    {
        return Plate::where('plate', $plateNumber)->first();
    }
    private function registrarPlaca($plateNumber)
    {
        $fechaActual = Carbon::now();
        Registro::create(['plate' => $plateNumber, 'fecha' => $fechaActual ]);
    }
    private function llamarAsterisk($mensaje, $numero)
    {
        return AsteriskHelper::llamar($mensaje, $numero);
    }
    private function respuestaPlacaNoEncontrada()
    {
        return response()->json(['message' => 'La placa no se encontro en la base de datos'], 404);
    }
}
