<?php
//called by receipts/radd
echo validation_errors();
echo form_open('receipts/radd',array('id'=>'donation'),$donor);
echo "<table border=1 align=center>";
echo "<tr><td>Name</td><td>".$donor['name']."</td></tr>";
echo "<tr><td>Address</td><td>".$donor['address']."</td></tr>";
echo "<tr><td>Amount</td><td>".form_input(array('name'=>'amount','value'=>'0.00','maxlength'=>'13', 'id'=>'amt'))."</td></tr>";
echo "<tr><td>Purpose</td><td>".form_dropdown('purpose',$purpose)."</td></tr>";
echo "<tr><td>Mode of Payment</td><td>".form_dropdown('mode_payment',$mop)."</td></tr>";
echo "<tr><td>Details</td><td>".form_input(array('name'=>'pmt_details', 'value'=>'','maxlength'=>'50', 'size'=>'50'))."</td></tr>";
echo "<tr><td colspan=2 align=center>".form_submit('submit','Submit')."</td></tr>";


echo "</table>";
echo form_close();

/*
print_r($donor)."<br>";
print_r($amount)."<br>";
print_r($purpose1)."<br>";
print_r($mop1)."<br>";
print $pmt_details."<br>";
print $pan."<br>";
echo "<br>";*/
//echo "<a href=".site_url('login/home').">Go Home</a>";
?>
<script type="text/javascript" language="JavaScript">
	document.forms['donation'].elements['amt'].focus();
	</script>
