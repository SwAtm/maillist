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
$pdf->SetAutoPageBreak(true,10);
$pdf->SetFont('Arial','',11);
$pdf->AddPage('L',array(210,30));
$pdf->SetFillColor(200);
$pdf->cell(170,5,'Click here to go home.',0,1,'C',1,site_url('login/home'));
foreach ($report as $key => $value) {
$pdf->AddPage();
$cp=1;;
//$tp=1;
$pdf->cell(170,5,$key. ' - '.Date('d-m-Y',strtotime($stdt)).' to '.Date('d-m-Y',strtotime($endt)),0,1,'C');
$pdf->ln(5);
$pdf->cell(25,5,'Date',1,0,'C');
$pdf->cell(20,5,'Rt No',1,0,'C');
$pdf->cell(50,5,'Donor',1,0,'C');
$pdf->cell(20,5,'Ch No',1,0,'C');
$pdf->cell(25,5,'Tr_Date',1,0,'C');
$pdf->cell(30,5,'Amount',1,1,'C');;

	foreach ($value as $k=>$v){
		if ('total'==$k):
			continue;
		endif;
			foreach ($v as $val){
				$lno=$pdf->NbLines(50,$val['name']);
				if ($pdf->GetY()+(($lno+2)*5)>$pdf->PageBreakTrigger):
					$add=297-15-$pdf->GetY();
					$pdf->ln($add);
					$pdf->Cell(170,5,'Page '.$cp,0,0,'C');
					$pdf->AddPage();
					$cp++;
					//$tp++;	
					$pdf->cell(170,5,$key. ' - '.Date('d-m-Y',strtotime($stdt)).' to '.Date('d-m-Y',strtotime($endt)),0,1,'C');
					$pdf->ln(5);
					$pdf->cell(25,5,'Date',1,0,'C');
					$pdf->cell(20,5,'Rt No',1,0,'C');
					$pdf->cell(50,5,'Donor',1,0,'C');
					$pdf->cell(20,5,'Ch No',1,0,'C');
					$pdf->cell(25,5,'Tr_Date',1,0,'C');
					$pdf->cell(30,5,'Amount',1,1,'C');
				endif;
			
				$pdf->cell(25,5*$lno,date('d-m-Y',strtotime($val['date'])),1,0,'C');
				$pdf->cell(20,5*$lno,$val['series']." - ".$val['no'],1,0,'C');
				$x=$pdf->GetX();
				$y=$pdf->GetY();
				$pdf->Multicell(50,5,$val['name'],1,'C');
				$pdf->SetXY($x+50,$y);
				$pdf->cell(20,5*$lno,$val['ch_no'],1,0,'C');
				if ($val['tr_date']==null || $val['tr_date']==''):
					$pdf->cell(25,5*$lno,'',1,0,'C');
				else:	
					$pdf->cell(25,5*$lno,date('d-m-Y',strtotime($val['tr_date'])),1,0,'C');
				endif;	
				$pdf->cell(30,5*$lno,$val['amount'],1,1,'R');		
			}
		}

$pdf->ln(5);
$pdf->Cell(170,5, 'Total Receips for '.$key.': '.$value['total'],0,1,'R');
$add=297-15-$pdf->GetY();
$pdf->ln($add);
$pdf->Cell(170,5, 'Page '.$cp,0,0,'C');
}
$pdf->output();
?>
