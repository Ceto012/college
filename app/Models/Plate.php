<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Plate extends Model
{
    use HasFactory;

    protected $table = 'plate'; // Nombre de la tabla

    //protected $fillable = ['cod_estudiante', 'nombre', 'apoderado', 'placa', 'imagen'];
    protected $fillable = ['cod_student', 'name', 'proxy', 'plate', 'image'];

    public $timestamps = true; // Indica que Eloquent gestionará automáticamente los campos created_at y updated_at


    
    public static function importarDesdeCSV(UploadedFile $archivo)
    {
        $datos = array_map('str_getcsv', file($archivo->getPathName()));
        $cabeceras = array_shift($datos);

        foreach ($datos as $fila) {
            $cod_estudiante = $fila[0]; //Orden de 'cod_estudiante'

            $registro = self::where('cod_student', $cod_estudiante)->first();

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
        return static::where('cod_student', $codigo)->first();
    }

    public static function registrarOActualizarPlaca($request)
    {
        // Validar si la placa ya existe en la base de datos
        $placaExistente = self::buscarPorCodigo($request->codigoAlumno);

        if ($placaExistente) {
            // Si la placa ya existe, actualizar los datos

            // Lógica para manejar la imagen si se proporciona una nueva imagen
            $nombreImagen = $placaExistente->image;
            if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
                $imagen = $request->file('imagen');
                $nombreImagen = $imagen->getClientOriginalName();
                //$imagen->storeAs('public/imagenes', $nombreImagen);
                $imagen->move(public_path('assets/imagenes'), $nombreImagen);
            }

            // Actualizar los campos de la placa
            $placaExistente->update([
                'name' => $request->nombreAlumno,
                'proxy' => $request->apoderado,
                'plate' => $request->placa,
                'image' => $nombreImagen,
                // Otros campos si es necesario
            ]);

            return $placaExistente;
        } else {
            // Si la placa no existe, crear un nuevo registro

            // Lógica para manejar la imagen si se proporciona una nueva imagen
            $nombreImagen = null;
            if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
                $imagen = $request->file('imagen');
                $nombreImagen = $imagen->getClientOriginalName();
                //$imagen->storeAs('public/imagenes', $nombreImagen);
                $imagen->move(public_path('assets/imagenes'), $nombreImagen);
            }

            // Crear una nueva placa
            $placaNueva = self::create([
                'cod_student' => $request->codigoAlumno,
                'name' => $request->nombreAlumno,
                'proxy' => $request->apoderado,
                'plate' => $request->placa,
                'image' => $nombreImagen,
                // Otros campos si es necesario
            ]);

            return $placaNueva;
        }
    }

    public static function eliminarPorCodigo($codigo)
    {
        $placa = self::where('cod_student', $codigo)->first();
        if ($placa) {
            $placa->delete();
            return true;
        }
        return false;
    }
}
