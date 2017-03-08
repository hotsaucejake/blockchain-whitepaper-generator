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

        if (empty(request('name'))) {
           $name = 'Anonymous';
        } else {
           $name = request('name');
        }

        if (empty(request('title'))) {
           // NULL title handler
           $title = 'Globally Secured Processes by Immutable Audit Trails on a Pseudo-Anonymous Privacy-Centric Open-Source Next-Generation Data Preservation Smart Contract Prediction Market Network and a Decentralized Peer-to-Peer Electronic Federated Application Platform Model for a Generalized Internet-Level Database Transaction Ledger System by Consensus Protocol';
        } else {
           $title = request('title');
        }

        $pdf = new BlockchainPDF();
        $pdf->setTitle(request('protocol'));
        $pdf->AddPage();

        $pdf->CoverPage($name, request('email'), request('protocol'), $title);

        $pdf->SetFont('Times', '', 12);
        $pdf->MultiCell(0, 6, $title . '.  ' . $title . '.  ' . $title . '.', 0, 'J');
        $pdf->MultiCell(0, 6, $title . '.  ' . $title . '.  ' . $title . '.', 0, 'J');
        $pdf->MultiCell(0, 6, $title . '.  ' . $title . '.  ' . $title . '.', 0, 'J');
        $pdf->MultiCell(0, 6, $title . '.  ' . $title . '.  ' . $title . '.', 0, 'J');

        $pdf->Output();

    }

}
