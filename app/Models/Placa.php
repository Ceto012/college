<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Placa extends Model
{
    use HasFactory;

    protected $table = 'placa'; // Nombre de la tabla

    protected $fillable = ['cod_estudiante', 'nombre', 'apoderado', 'placa', 'imagen'];

    public $timestamps = true; // Indica que Eloquent gestionará automáticamente los campos created_at y updated_at


    
    public static function importarDesdeCSV(UploadedFile $archivo)
    {
        $datos = array_map('str_getcsv', file($archivo->getPathName()));
        $cabeceras = array_shift($datos);

        foreach ($datos as $fila) {
            $cod_estudiante = $fila[0]; //Orden de 'cod_estudiante'

            $registro = self::where('cod_estudiante', $cod_estudiante)->first();

            if ($registro) {
                // Si el registro existe, lo actualizamos
                $registro->update(array_combine($cabeceras, $fila));
            } else {
                // Si el registro no existe, lo creamos
                self::create(array_combine($cabeceras, $fila));
            }
        }
    }

    public static function buscarPorCodigo($codigo)
    {
        return static::where('cod_estudiante', $codigo)->first();
    }

    public static function eliminarPorCodigo($codigo)
    {
        $placa = self::where('cod_estudiante', $codigo)->first();
        if ($placa) {
            $placa->delete();
            return true;
        }
        return false;
    }
}
