<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Codedge\Fpdf\Facades\Fpdf;
use App\Classes\BlockchainPDF;

class PDFGeneratorController extends Controller
{

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        //dd(request()->all());
        // if(request('bitcoin')){ dd(request()->all()); }

        $pdf = new BlockchainPDF();

        $pdf->AddPage();
        $pdf->CoverPage(request('name'), request('email'), request('protocol'), request('title'));
        $pdf->Output();

    }

}
