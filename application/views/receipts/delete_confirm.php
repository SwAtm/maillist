<?php
echo form_open('receipts/rdelete','',array('id'=>$det['id']));
echo "<table border=1 align=center>";
echo "<tr><td>Receipt</td><td>".$det['series']." ".$det['no']." ".$det['date']."</td></tr>";
echo "<tr><td>Name</td><td>".$det['name']."</td></tr>";
echo "<tr><td>Address</td><td>".$det['address']."</td></tr>";
echo "<tr><td>Amount</td><td>".$det['amount']."</td></tr>";
if ($det['deleted']=='Y'):
echo "<tr><td colspan=2 align=center>Receipt already Deleted</td></tr>";
else:
echo "<tr><td colspan=2 align=center>".form_submit('submit','Delete')."</td></tr>";
endif;
echo "</table>";
echo form_close();
?>

