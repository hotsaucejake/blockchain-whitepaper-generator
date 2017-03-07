<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Facades\Fpdf;

class PDFGeneratorController extends Controller
{

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        //dd(request()->all());
        // echo request('name');
        // echo request('email-address');
        // echo request('protocol');
        // echo request('coin');
        // echo request('title');
        Fpdf::AddPage();
        Fpdf::SetFont('Courier', 'B', 18);
        Fpdf::Cell(50, 25, 'Name: ' . request('name'), 1, 1, 'C');
        Fpdf::Cell(50, 25, 'Email: ' . request('email-address'), 1, 1, 'C');
        Fpdf::Cell(50, 25, 'Protocol: ' . request('protocol'), 1, 1, 'C');
        Fpdf::Cell(50, 25, 'Coin: ' . request('coin'), 1, 1, 'C');
        Fpdf::Cell(50, 25, 'Title: ' . request('title'), 1, 1, 'C');
        Fpdf::Output();


    }

}
