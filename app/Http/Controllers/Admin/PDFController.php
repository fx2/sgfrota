<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to sgfrotas.com.br',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('admin/pdf/relatoriosPDF', $data);

        // return $pdf->download('sgfrotas.pdf');
        return $pdf->stream('sgfrotas.pdf');
    }
}
