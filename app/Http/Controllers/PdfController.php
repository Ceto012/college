<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Placa; // Asegúrate de importar el modelo de Placa



class PdfController extends Controller
{
    
    public function generarPdf()
    {
        $placas = Placa::all(); // Suponiendo que tengas un modelo llamado Placa
    
        $pdf = PDF::loadView('placas.pdf', compact('placas'));
        $pdf->save(storage_path('app/public/placas.pdf'));
        
        return response()->json(['pdf_url' => asset('storage/placas.pdf')]);
    }
    
}
