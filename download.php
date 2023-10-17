<?php
session_start();
require("fpdf/fpdf.php");
if(isset($_POST["logout"])){
    session_destroy();
    header("Location: admin.php");
}
if(isset($_POST["download"])){
    $pun=$_SESSION["som"];
    $pdf= new FPDF('L','mm','A4');
    $pdf-> AddPage();
    $pdf->SetFont("Arial","B",9);
    $head=["Faculty name","Subject","punctuality","communication","discipline","discussion","industrial exp","teaching aid","innovative","syllabus"];
    foreach($head as $h){
    $pdf->Cell(28,10,$h,1,0,"C");
    }
    $pdf->Ln();
    for($i=0;$i<count($pun);$i++){
        foreach($pun[$i] as $a){
            $pdf->Cell(28,10,$a,1,0,"C");
        }
        $pdf->Ln();
    }
    // $pdf->Ln(5);
    // $pdf->Cell(100,10,"hello world",1,0,"C");
    $pdf->output();


}
?>