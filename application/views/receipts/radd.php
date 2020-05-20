<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="<?php echo base_url('application/jquery-ui/external/jquery/jquery.js')?>"></script>
<script src="<?php echo base_url('application/jquery-ui/jquery-ui.js')?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('application/jquery-ui/jquery-ui.css')?>"/>
<script type="text/javascript">
$(document).ready(function() {
        $('input[id$=tr_date]').datepicker({
            dateFormat:"yy-mm-dd",
            onClose: function(dateText, inst) {
                $("#pmt_details").focus();
            }
        });
        
        document.forms['donation'].elements['amt'].focus();


		$("#mop").change(function() {
			if ($(this).val() == "Cash") {
				$('#ch_notohide').hide();
				$('#tr_dttohide').hide();
			} else if ($(this).val()=="Cheque") {
				$('#ch_notohide').show();
				$('#tr_dttohide').show();
    
			} else {
				$('#ch_notohide').hide();
				$('#tr_dttohide').show();
			}
		});
  
		$("#mop").trigger("change");
});
</script>

</head>



<?php
//called by receipts/radd

echo validation_errors();
echo form_open('receipts/radd',array('id'=>'donation'),$donor);
echo "<table border=1 align=center>";
echo "<tr><td>Name</td><td colspan=3>".$donor['name']."</td></tr>";
echo "<tr><td>Address</td><td colspan=3>".$donor['address']."</td></tr>";
echo "<tr><td>Amount</td><td colspan=3>".form_input(array('name'=>'amount','value'=>'0.00','maxlength'=>'13', 'id'=>'amt'))."</td></tr>";
echo "<tr><td>Purpose</td><td colspan=3>".form_dropdown('purpose',$purpose)."</td></tr>";
echo "<tr><td>Mode of Payment</td><td>".form_dropdown('mode_payment',$mop,'',array('id'=>'mop'))."</td>";
echo "<td style='border: none'>";
?>
<div id="ch_notohide"><label for="ch_no">Ch_No </label><input type="text" name="ch_no" value="" id="ch_no" maxlength=6 size=6></div>
<?php echo "</td><td style='border: none'>";?>
<div id="tr_dttohide"><label for="tr_date">Tr_Dt </label><input type="text" name="tr_date" value="" id="tr_date"></div>
<?php
echo "</td></tr><tr><td>Details</td><td colspan=3>".form_input(array('name'=>'pmt_details', 'value'=>'','maxlength'=>'35', 'size'=>'35','id'=>'pmt_details'))."</td></tr>";
echo "<tr><td colspan=4 align=center>".form_submit('submit','Submit')."</td></tr>";
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



