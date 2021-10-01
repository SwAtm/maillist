<?php
//called by receipts/rprint
tfpdf();
$amt = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $det['amount']);
$ntw = new \NTWIndia\NTWIndia();
$pdf = new tFPDF('L', 'mm', array(210,148));
$pdf->setLeftMargin(25);
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Image(base_url(IMGPATH.'logo.jpg'),25,10,15,'');
$pdf->setXY(25,10);
$pdf->Cell(180,5,NAMER,0,1,'C');
$pdf->SetFont('Arial','',14);
$pdf->Cell(180,5,ADD1,0,1,'C');
$pdf->Cell(180,5,ADD2,0,1,'C');
$pdf->ln(2);
$pdf->cell(180,0,'',1,1);
$pdf->ln(5);
$pdf->SetFont('Arial','B',14);
$pdf->cell(180,5,'RECEIPT',0,1,'C');
$pdf->SetFont('Arial','',14);
$pdf->cell(90,5,'Receipt No: '.$det['series']."-".$det['sub_series']."-".$det['no'],0,0,'L');
$pdf->cell(90,5,'Date: '.date('d-m-Y',strtotime($det['date'])),0,1,'R');
$pdf->ln(3);
$pdf->SetFont('Arial','I',13);
$pdf->cell(57,5,'Received with thanks from:',0,0,'L');
$pdf->SetFont('Times','',13);
$pdf->Cell(123,5,$det['name'],0,1,'L');
$pdf->Multicell(180,6,ucwords(strtolower($det['address'])),0,'L');
$pdf->Cell(90,5,$det['city_pin'],0,0,'L');
$pdf->Cell(90,5,($det['id_name']!=='NOT AVAILABLE'?$det['id_name'].': '.$det['id_no']:''),0,1,'R');
$pdf->ln(3);
$pdf->SetFont('Arial','I',13);
$pdf->cell(180,5,'A sum of Rupees:',0,1,'L');
$pdf->ln(1);
$pdf->SetFont('Times','',13);
$pdf->Multicell(180,5,$ntw->numToWord($det['amount']).' Only',0,'L');
$pdf->ln(3);
$pdf->SetFont('Arial','I',13);
$pdf->cell(20,5,"Towards: ", 0,0,'L');
$pdf->SetFont('Times','',13);
$pdf->cell(160,5,$det['purpose'],0,1,'L');
$pdf->ln(3);
$pdf->SetFont('Arial','',13);
$pdf->cell(12,5,"Vide: ",0,0,'L');
$pdf->SetFont('Times','',13);
$pdf->Multicell(168,5,($det['mode_payment']=="Cash"?$det['mode_payment']:$det['mode_payment']. ": ").($det['ch_no']!==''?"No: ".$det['ch_no']:'')." ".($det['tr_date']!==''?'Dt: '.$det['tr_date']:'')." ".$det['pmt_details'],0,'L');
//$pdf->Multicell(180,5,"Vide: ".($det['mode_payment']=="Cash"?$det['mode_payment']:$det['mode_payment']. ": ").($det['ch_no']!==''?"No: ".$det['ch_no']:'')." ".($det['tr_date']!==''?'Dt: '.$det['tr_date']:'')." ".$det['pmt_details'],0,'L');
$pdf->Image(base_url(IMGPATH.'Signature.jpg'), 170,103);
$pdf->Image(base_url(IMGPATH.'rupee.png'),25,110,5,'');
$pdf->SetFont('Arial','',14);
$pdf->setXY(30,110);
$pdf->cell(70,5,$amt,0,0,'L');
$pdf->SetFont('Arial','',12);
$pdf->cell(78,5,'Collected By',0,0,'L');
$pdf->cell(27,5,DESIGN,0,1,'L');
$pdf->ln(1);
$pdf->cell(180,0,'',1,1);
//if ($det['amount']>2000 AND $det['mode_payment']=="Cash"):
/*
if ($det['pan']=='' OR $det['mode_payment']=="Cash"):
$mess="Our PAN: AAAAR1077P. Under Schedule I, Article 53, Exemption (b) of the Indian Stamp Act, Charitable Institutions are not required to issue any stamped receipt for amounts received by them.";
elseif (strtotime($det['date'])<strtotime('01-06-2021')):
$mess="Donations are exempt from Income Tax u/s 80G(5)(vi) of the IT Act 1961, vide order no DIT(E)/848/8E/109/69-70, dated 12-01-2009 which has been further extended in perpetuity by letter no DIT(E)/109/69-70 dated 26-09-2011. Our PAN: AAAAR1077P. Under Schedule I, Article 53, Exemption (b) of the Indian Stamp Act, Charitable Institutions are not required to issue any stamped receipt for amounts received by them.";
else:
$mess="Donations are exempt from Income Tax u/s 80G(5)(vi) of the IT Act 1961, vide Provisional Approval No. AAAAR1077PF20214, dated 28-05-2021. Our PAN: AAAAR1077P. Under Schedule I, Article 53, Exemption (b) of the Indian Stamp Act, Charitable Institutions are not required to issue any stamped receipt for amounts received by them.";
*/


	if ($det['section_code']=='80G'):
		if (strtotime($det['date'])<strtotime('01-06-2021')):
			$mess="Donations are exempt from Income Tax u/s 80G(5)(vi) of the IT Act 1961, vide order no DIT(E)/848/8E/109/69-70, dated 12-01-2009 which has been further extended in perpetuity by letter no DIT(E)/109/69-70 dated 26-09-2011. Our PAN: AAAAR1077P. Under Schedule I, Article 53, Exemption (b) of the Indian Stamp Act, Charitable Institutions are not required to issue any stamped receipt for amounts received by them.";
		else:
			$mess="Donations are exempt from Income Tax u/s 80G(5)(vi) of the IT Act 1961, vide Provisional Approval No. AAAAR1077PF20214, dated 28-05-2021. Our PAN: AAAAR1077P. Under Schedule I, Article 53, Exemption (b) of the Indian Stamp Act, Charitable Institutions are not required to issue any stamped receipt for amounts received by them.";
		endif;
	else:
		$mess="Our PAN: AAAAR1077P. Under Schedule I, Article 53, Exemption (b) of the Indian Stamp Act, Charitable Institutions are not required to issue any stamped receipt for amounts received by them.";
	endif;


$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Multicell(180,5,$mess,0,'L');
//$pdf->cell(180,5,"...",0,0,'C','',site_url('login/home'));
$pdf->Image(base_url(IMGPATH.'home.png'),105,140,5,'','',site_url('login/home'));
$pdf->Image(base_url(IMGPATH.'pen.jpeg'),115,140,5,'','',site_url('receipts/letter/'.$det['id']));
$filename="receipt_".$det['series']."-".$det['sub_series']."-".$det['no'].".pdf";
$pdf->Output($filename,'I');
//redirect (site_url('login/home','refresh'));
//$pdf->close();
//copy($filename,'http://192.168.1.244/home/freak/Public/receipt.pdf');
?>





