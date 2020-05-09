<?php
//called by receipts/rprint
tfpdf();
//$f = new NumberFormatter("en_IN", NumberFormatter::CURRENCY);
$amt = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $det['amount']);
//require_once base_url('application/third_party/ntw/src/NTWIndia.php');
//require_once base_url('application/third_party/ntw/src/Exception/NTWIndiaInvalidNumber.php');
//require_once base_url('application/third_party/ntw/src/Exception/NTWIndiaNumberOverflow.php');
//setlocale(LC_MONETARY, 'en_IN.UTF-8');
$ntw = new \NTWIndia\NTWIndia();
$pdf = new tFPDF('L', 'mm', array(210,148));
//$pdf->AddFont('Rupee_Foradian','','Rupee_Foradian.ttf','true');
$pdf->setLeftMargin(20);
$pdf->SetAutoPageBreak(true,10);
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
//$pdf->Image(base_url('application/logo.jpg'),20,10,15,'');
//$pdf->Image(base_url('../web_images/logo.jpg'),20,10,15,'');
$pdf->Image(base_url(IMGPATH.'logo.jpg'),20,10,15,'');
$pdf->setXY(20,10);
$pdf->Cell(180,5,'Ramakrishna Mission Ashrama',0,1,'R');
$pdf->SetFont('Arial','',14);
$pdf->Cell(180,5,'Fort, Belgaum, Karnataka 590016',0,1,'R');
$pdf->Cell(180,5,'Ph: 0831 243 2789:: email: belgaum@rkmm.org',0,1,'R');
$pdf->ln(2);
$pdf->cell(180,0,'',1,1);
$pdf->ln(5);
$pdf->SetFont('Arial','B',14);
$pdf->cell(180,5,'RECEIPT',0,1,'C');
$pdf->SetFont('Arial','',14);
$pdf->cell(90,5,'Receipt No: '.$det['series']."-".$det['no'],0,0,'L');
$pdf->cell(90,5,'Date: '.date('d-m-Y',strtotime($det['date'])),0,1,'R');
$pdf->ln(2);
$pdf->SetFont('Arial','I',13);
$pdf->cell(180,5,'Received with thanks from:',0,1,'L');
$pdf->SetFont('Arial','',13);
$pdf->ln(1);
$pdf->Multicell(180,5,$det['name'].', '.$det['address'].' PAN: '.$det['pan'],0,'L');
//$pdf->ln(1);
//$pdf->Multicell(180,5,$det['address'],0,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','I',13);
$pdf->cell(180,5,'A sum of Rupees:',0,1,'L');
$pdf->ln(1);
//$pdf->cell(15,5,"Rs: ", 0,0,'L');
$pdf->SetFont('Arial','',13);
$pdf->Multicell(180,5,$ntw->numToWord($det['amount']).' Only',0,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','I',13);
$pdf->cell(20,5,"Towards: ", 0,0,'L');
$pdf->SetFont('Arial','',13);
$pdf->cell(160,5,$det['purpose'],0,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','I',13);
$pdf->cell(20,5,"Vide: ", 0,0,'L');
$pdf->SetFont('Arial','',13);
$pdf->cell(160,5,$det['mode_payment']. ": ".$det['pmt_details'],0,1,'L');
//$pdf->ln(1);
//$pdf->Image(base_url('../web_images/Signature.jpg'), 140,98);
$pdf->Image(base_url(IMGPATH.'Signature.jpg'), 140,98);
//$pdf->SetFont('Arial','I',14);
//$pdf->cell(10,5,"Rs: ", 0,0,'L');
$pdf->SetFont('Arial','',14);
//$pdf->SetFont('Rupee_Foradian','',14);
//$pdf->cell(10,5,chr(236),0,0,'L');
//$pdf->Image(base_url('application/rupee.png'),20,105,5,'');
//$pdf->Image(base_url('../web_images/rupee.png'),20,105,5,'');
$pdf->Image(base_url(IMGPATH.'rupee.png'),20,105,5,'');
$pdf->setXY(25,105);
//$pdf->cell(60,5,$f->formatCurrency($det['amount'],'INR'),0,0,'L');
$pdf->cell(60,5,$amt,0,0,'L');
$pdf->SetFont('Arial','',12);
$pdf->cell(60,5,'Collected By',0,0,'L');
$pdf->cell(50,5,'Secretary',0,1,'L');
$pdf->ln(1);
$pdf->cell(180,0,'',1,1);
if ($det['amount']>2000 AND $det['mode_payment']=="Cash"):
$mess="";
else:
$mess="Donations are exempt from Income Tax u/s 80G(5)(vi) of the IT Act 1961, vide order no DIT(E)/848/8E/109/69-70, dated 12-01-2009 which has been further extended in perpetuity by letter no DIT(E)/109/69-70 dated 26-09-2011. Our PAN: AAAAR1077P. Under Schedule I, Article 53, Exemption (b) of the Indian Stamp Act, Charitable Institutions are not required to issue any stamped receipt for amounts received by them.";
endif;
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Multicell(180,5,$mess,0,'L');
$filename=SAVEPATH."receipt_".$det['series']."-".$det['no']."pdf";
//$pdf->SetFont('Arial','',8);
//$pdf->cell(180,5,'Home',0,1,'C','',site_url('login/home'));

//$filename="receipt_".$det['series']."-".$det['no']."pdf";
//$pdf->Output($filename);
$pdf->Output($filename);
//$pdf->close();
//redirect ('login/home');
//$this->load->view('templates/header');

//echo "Receipts print";
//print_r($det);
//echo "<a href=".site_url('receipts/rlist').">Go to Receipts List</a><br>";
//echo "<a href=".site_url('login/home').">Go Home</a><br>";


?>





