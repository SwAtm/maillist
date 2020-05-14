<?php
tfpdf();
$pdf = new tFPDF('P','mm',array(210,297));
$lm=8;
$font='Arial';
$fs=7.25;
$tm=15;
$pdf->setTopMargin($tm);
$pdf->setLeftMargin($lm);
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->SetFont($font,'',$fs);
$col=0;
foreach ($addresses as $data):

if ($data['pin']==null||$data['pin']==0):
$data['pin']='';
endif;

if ($data['city']==''):
	$data['city']="PIN: ";
else:
	$data['city']=$data['city'].": ";
endif;	
/*
if ($data['add1']==''):
	$data['add1']=$data['add2'];
	$data['add2']='';
endif;

if ($data['add2']==''):
	$data['add2']=$data['add3'];
	$data['add3']='';
endif;

if ($data['add3']==''):
	$data['add3']=$data['add4'];
	$data['add4']='';
endif;

if ($data['add4']==''):
	$data['add4']=$data['city'].$data['pin'];
	$data['city']='';
	$data['pin']='';
endif;
*/
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
		$pdf->AddPage();
		$pdf->SetY(15);
	else:
		$pdf->SetY($y+9.5);
	endif;
endif;
endforeach;


$filename=SAVEPATH.$place."_Labels_".count($addresses)."pdf";
$pdf->Output($filename);





/*
echo "<pre>";
print_r($blore);
echo "</pre>";
echo "<a href=".site_url('login/home').">Go Home</a href>";
*/
?>
