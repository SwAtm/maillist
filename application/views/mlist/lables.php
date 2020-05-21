<?php
tfpdf();
$pdf = new tFPDF('L','mm',array(210,30));
$lm=8;
$font='Arial';
$fs=14;
$tm=15;
$pdf->setTopMargin($tm);
$pdf->setLeftMargin($lm);
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->SetFont($font,'',$fs);
$col=0;
$pdf->SetFillColor(200);
$pdf->cell(180,5,'Click here to go Home. Pl print page 2 onwards',0,1,'C',1,site_url('login/home'));
$pdf->AddPage('P',array(210,297));
$fs=7.25;
$pdf->SetFont($font,'',$fs);
foreach ($addresses as $data):

if ($data['pin']==null||$data['pin']==0):
	$data['pin']='';
else:
	if ($data['city']==''):
		$data['city']="PIN: ";
	else:
		$data['city']=$data['city'].": ";
	endif;	
endif;

$y=$pdf->getY();
$pdf->Cell(60,4,$data['id'],0,1,'L');
$pdf->Cell(60,4,$data['hon']. ' '.$data['name'],0,1,'L');
$pdf->Cell(60,4,$data['add1'],0,1,'L');
$pdf->Cell(60,4,$data['add2'],0,1,'L');
$pdf->Cell(60,4,$data['add3'],0,1,'L');
$pdf->Cell(60,4,$data['add4'],0,1,'L');
$pdf->Cell(60,4,$data['city'].$data['pin'],0,0,'L');

if ($col<2):
$col++;
$x = $lm+$col*65+$col*2;
$pdf->SetLeftMargin($x);
$pdf->SetX($x);
$pdf->SetY($y);
else:
$y=$pdf->getY();
$col=0;
$pdf->SetX($lm);
$pdf->SetLeftMargin($lm);
	if (297-$y<43):
		$pdf->AddPage('P',array(210,297));
		$pdf->SetY(15);
	else:
		$pdf->SetY($y+9.5);
	endif;
endif;
endforeach;


$filename=$place."_Labels_".count($addresses)."pdf";
$pdf->Output($filename,'I');

?>
