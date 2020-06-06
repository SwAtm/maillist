<?php
tfpdf();
class nltFPDF extends tFPDF {
public function __construct()
{
parent::__construct();
}

function NbLines($w,$txt) { //Computes the number of lines a MultiCell of width w will take 
	$cw=&$this->CurrentFont['cw']; if($w==0) $w=$this->w-$this->rMargin-$this->x; $wmax=($w-2*$this->cMargin)*1000/$this->FontSize; $s=str_replace("\r",'',$txt); $nb=strlen($s); if($nb>0 and $s[$nb-1]=="\n") $nb--; $sep=-1; $i=0; $j=0; $l=0; $nl=1; while($i<$nb) { $c=$s[$i]; if($c=="\n") { $i++; $sep=-1; $j=$i; $l=0; $nl++; continue; } if($c==' ') $sep=$i; $l+=$cw[$c]; if($l>$wmax) { if($sep==-1) { if($i==$j) $i++; } else $i=$sep+1; $sep=-1; $j=$i; $l=0; $nl++; } else $i++; } return $nl; }
}

$pdf = new nltFPDF('P', 'mm', array(210,297));


$lm=20;
$tm=10;
$pdf->setLeftMargin($lm);
$pdf->setTopMargin($tm);
$pdf->SetAutoPageBreak(true);
$pdf->SetFont('Arial','',11);


$pdf->AddPage('L',array(210,30));
$pdf->SetFillColor(200);
$pdf->cell(170,6,'Click here to go home.',0,1,'C',1,site_url('login/home'));

foreach ($report as $key => $value) {
$pdf->AddPage();
$pdf->cell(170,5,$key,0,1,'C');
$pdf->cell(25,5,'Date',1,0,'C');
$pdf->cell(20,5,'Rt No',1,0,'C');
$pdf->cell(50,5,'Donor',1,0,'C');
$pdf->cell(20,5,'Ch No',1,0,'C');
$pdf->cell(25,5,'Date',1,0,'C');
$pdf->cell(30,5,'Amount',1,1,'C');
	foreach ($value as $k=>$v){
		if ('total'==$k):
			continue;
		endif;
			foreach ($v as $val){
				$lno=$pdf->NbLines(50,$val['name']);
				$pdf->cell(25,5*$lno,$val['date'],1,0,'C');
				$pdf->cell(20,5*$lno,$val['sub_series']." - ".$val['no'],1,0,'C');
				$x=$pdf->GetX();
				$y=$pdf->GetY();
				$pdf->Multicell(50,5,$val['name'],1,'C');
				$pdf->SetXY($x+50,$y);
				$pdf->cell(20,5*$lno,$val['ch_no'],1,0,'C');
				$pdf->cell(25,5*$lno,$val['date'],1,0,'C');
				$pdf->cell(30,5*$lno,$val['amount'],1,1,'C');		
			}
		}
}
$pdf->output();
?>
