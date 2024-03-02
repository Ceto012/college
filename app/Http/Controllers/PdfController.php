<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Placa; // Asegúrate de importar el modelo de Placa
use Illuminate\Http\Request;



class PdfController extends Controller
{
    
    public function generarPdf()
    {
        $placas = Placa::all(); // Suponiendo que tengas un modelo llamado Placa
    
        $pdf = PDF::loadView('pdf.pdf', compact('placas'));
        $pdf->save(storage_path('app/public/placas.pdf'));
        
        return response()->json(['pdf_url' => asset('storage/placas.pdf')]);
    }

    public function generarPdfReporte(Request $request)
    {
        // Obtener el JSON de los datos enviados desde el frontend
        $jsonData = $request->input('data');
        
        // Decodificar el JSON para obtener el array de datos
        $data = json_decode($jsonData, true); // El segundo parámetro true indica que se desea un array asociativo
        
        // Convertir los datos en una colección de Laravel
        $placas = collect($data);
        
        // Generar el PDF del reporte utilizando la vista 'pdf-reporte' y pasando los datos de las placas
        $pdf = PDF::loadView('pdf.pdf-reporte', compact('placas'));
        $pdf->save(storage_path('app/public/reporte.pdf'));
        
        return response()->json(['pdf_url' => asset('storage/reporte.pdf')]);
    }
    
}
