<?php
$dom=new DOMDocument('1.0', 'utf-8');
$root= $dom->createElement('ENVELOPE');

$header=$dom->createElement('HEADER');
$ver=$dom->createElement('VERSION','1');
$req=$dom->createElement('TALLYREQUEST','Import');
$type=$dom->createElement('TYPE', 'Data');
$id=$dom->createElement('ID','Vouchers');

$header->appendChild($ver);
$header->appendChild($req);
$header->appendChild($type);
$header->appendChild($id);
$root->appendChild($header);

$body=$dom->createElement('BODY');
$desc=$dom->createElement('DESC');
$body->appendChild($desc);

$data=$dom->createElement('DATA');
$body->appendChild($data);

$tm=$dom->createElement('TALLYMESSAGE');
$data->appendChild($tm);
foreach ($finalarr as $fn):
$fn=str_replace('&', '&amp;', $fn);
$vr=$dom->createElement('VOUCHER');
$dt=$dom->createElement('DATE', str_replace('-','',$fn['date']));
$nrrn=$dom->createElement('NARRATION', $fn['narration']);
$vt=$dom->createElement('VOUCHERTYPENAME', 'Receipt1');
$vn=$dom->createElement('VOUCHERNUMBER', $fn['vnumber']);
$ed=$dom->createElement('EFFECTIVEDATE', str_replace('-','',$fn['edate']));
$vr->appendChild($dt);
$vr->appendChild($nrrn);
$vr->appendChild($vt);
$vr->appendChild($vn);
$vr->appendChild($ed);

$ledlist=$dom->createElement('ALLLEDGERENTRIES.LIST');
$ledname=$dom->createElement('LEDGERNAME',$fn['cracc']);
$posneg=$dom->createElement('ISDEEMEDPOSITIVE', 'No');
$amount=$dom->createElement('AMOUNT',$fn['amount']);

$ledlist->appendChild($ledname);
$ledlist->appendChild($posneg);
$ledlist->appendChild($amount);
$vr->appendChild($ledlist);

$ledlist=$dom->createElement('ALLLEDGERENTRIES.LIST');
$ledname=$dom->createElement('LEDGERNAME',$fn['dracc']);
$posneg=$dom->createElement('ISDEEMEDPOSITIVE', 'Yes');
$amount=$dom->createElement('AMOUNT',0-$fn['amount']);

$ledlist->appendChild($ledname);
$ledlist->appendChild($posneg);
$ledlist->appendChild($amount);
$vr->appendChild($ledlist);



//voucher should be child of tallymessage or data?
$tm->appendChild($vr);
endforeach;


$root->appendChild($body);
$dom->appendChild($root);
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->save(SAVEPATH.'tally1.xml');
?>
