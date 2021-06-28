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
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('admin/pdf/relatoriosPDF', $data);
    
        // return $pdf->download('itsolutionstuff.pdf');
        return $pdf->stream('itsolutionstuff.pdf');
    }
}