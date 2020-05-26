<?php
tfpdf();
$pdf = new tFPDF('P', 'mm', array(220,140));
$lm=14;
$tm=10;
$pdf->setLeftMargin($lm);
$pdf->setTopMargin($tm);
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Arial','',12.5);
$pdf->AddPage('L',array(140,30));
$pdf->SetFillColor(200);
$pdf->cell(112,6,'Click here to go home.',0,1,'C',1,site_url('login/home'));
$pdf->Cell(112,5, 'Pl print page no 2 for Thanking Letter',0,1,'C');
$pdf->Cell(112,6, 'Pl print page no 3 for envelope',0,1,'C');
$tm=50;
$pdf->setTopMargin($tm);
$pdf->AddPage();
$pdf->Cell(112,6,date('F d, Y',strtotime($det['date'])),0,1,'R');
$pdf->ln(5);
$pdf->Cell(112,6,$det['name1'],0,1,'L');
$pdf->ln(5);
$pdf->Cell(112,6,$det['greetings'],0,1,'L');
$pdf->ln(5);
$pdf->MultiCell(112,6,$det['message'],0);
$pdf->ln(5);
$pdf->MultiCell(112,6,$det['message1'],0);
$pdf->ln(5);
$pdf->MultiCell(112,6,$det['message2'],0);
$pdf->ln(5);
$pdf->Cell(112,6,$det['closing1'],0,1,'L');
$pdf->ln(15);
$pdf->Cell(112,6,"Swami Atmapranananda",0,1,'L');
$pdf->cell(13,6,'',0,0);
$pdf->Cell(99,6,"Secretary",0,1,'L');
//$pdf->SetY(210);
//$pdf->Cell(112,5,'...',0,0,'C','',site_url('login/home'));

$lm=60;
$tm=20;
$pdf->setLeftMargin($lm);
$pdf->setTopMargin($tm);
$pdf->AddPage('L',array(180,105));
$pdf->Cell(100,6,'To',0,1,'L');
$pdf->Cell(100,6,$det['name'],0,1,'L');
$pdf->MultiCell(100,6,$det['address'],0,'L');
$pdf->Cell(100,6,$det['city_pin'],0,1,'L');
if ($det['phone']!==''):
$pdf->Cell(100,6,'Phone - '.$det['phone'],0,1,'L');
endif;

$pdf->Output()


?>

