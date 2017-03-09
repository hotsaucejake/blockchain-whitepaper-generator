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
        $whitepaper = include(app_path().'/Whitepapers/template.php');
        
        if(request('bitcoin')){
           $bitcoin = include(app_path().'/Whitepapers/bitcoin.php');
           $whitepaper = array_merge_recursive($whitepaper, $bitcoin);
        }
        if(request('ethereum')){
           $ethereum = include(app_path().'/Whitepapers/ethereum.php');
           $whitepaper = array_merge_recursive($whitepaper, $ethereum);
        }
        
        
        $name = request('name');
        if (empty(request('name'))) { $name = 'Anonymous'; }

        $title = $this->titleGenerator($request);
        

        $pdf = new BlockchainPDF();
        $pdf->setTitle(request('protocol'));
        $pdf->AddPage();

        $pdf->CoverPage($name, request('email'), request('protocol'), $title);

        $pdf->SetFont('Times', '', 12);
        
        foreach($whitepaper as $section => $content){
           $pdf->Ln(6); // add spacing above section titles
           $pdf->SetFont('Times', 'B', 14); // make the font bigger and bold
           if(!empty($content)){ $pdf->Cell(0, 6, $section, 0, 1, 'L'); } // print section title, ignore sections without content
           $pdf->SetFont('Times', '', 12); // change font back to normal
           
           foreach($content as $paragraphs => $paragraph){
             if(is_array($paragraph)){ // paragraph is code or img
                if(isset($paragraph['img'])){ // it's an image
                   $pdf->Image(getcwd().$paragraph['img']);
                }
                // if(isset($paragraph['code'])){ } // if code is set
             } else {
                $pdf->MultiCell(0, 6, $paragraph, 0, 'J'); // print the paragraph
             }
          }
        }
        
             
        

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
         $words = array("Scalable Off-Chain ", "Instant ");
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
