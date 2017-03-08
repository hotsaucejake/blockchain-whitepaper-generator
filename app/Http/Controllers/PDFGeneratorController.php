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
        $name = request('name');
        if (empty(request('name'))) { $name = 'Anonymous'; }

        $title = $this->titleGenerator($request);



        $pdf = new BlockchainPDF();
        $pdf->setTitle(request('protocol'));
        $pdf->AddPage();

        $pdf->CoverPage($name, request('email'), request('protocol'), $title);

        $pdf->SetFont('Times', '', 12);
        $pdf->MultiCell(0, 6, $title . '.  ' . $title . '.  ' . $title . '.', 0, 'J');

        $pdf->Output();

    }
    
    protected function titleGenerator(Request $request){
      $defaultTitle = 'Secure Untrusted Anonymous Decentralised Generalised One-time Ring Signature Peer-to-Peer Scalable Off-Chain Untraceable Electronic Instant Cash System and MimbleWimble Transaction Ledger Consensus Algorithm Payment Hub';
      
      if(empty(request('bitcoin'))){
         $words = array("Peer-to-Peer ", "Electronic ", "Cash ", "System ");
         $defaultTitle = str_replace($words, "", $defaultTitle);
      }
      if(empty(request('ripple'))){
         $words = array("Consensus ", "Algorithm ");
         $defaultTitle = str_replace($words, "", $defaultTitle);
      }
      if(empty(request('ethereum'))){
         $words = array("Secure ", "Decentralised ", "Generalised ", "Transaction ", "Ledger ");
         $defaultTitle = str_replace($words, "", $defaultTitle);
      }
      if(empty(request('cryptonote'))){
         $words = array("Untraceable ", "One-time Ring Signature ");
         $defaultTitle = str_replace($words, "", $defaultTitle);
      }
      if(empty(request('mimblewimble'))){
         $defaultTitle = str_replace("MimbleWimble ", "", $defaultTitle);
      }
      if(empty(request('lightning'))){
         $words = array("Scalable Off-Chain", "Instant ");
         $defaultTitle = str_replace($words, "", $defaultTitle);
      }
      if(empty(request('tumblebit'))){
         $words = array("Untrusted Anonymous ", "Payment Hub");
         $defaultTitle = str_replace($words, "", $defaultTitle);
      }

      if(empty(request('ripple')) && empty(request('tumblebit')) && empty(request('mimblewimble')) && empty(request('ethereum'))){
         $defaultTitle = str_replace(" and", "", $defaultTitle);
      }
      if(empty(request('bitcoin')) && 
         empty(request('ripple')) && 
         empty(request('cryptonote')) && 
         empty(request('tumblebit')) && 
         empty(request('lightning')) && 
         empty(request('mimblewimble')) && 
         empty(request('ethereum'))){
         $defaultTitle = 'This paper contains my complete knowledge of the Blockchain';
      }
      
      return $defaultTitle;
   }

}
