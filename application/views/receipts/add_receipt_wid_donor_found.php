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
        document.forms['donation'].elements['amt'].select();

		$("#mop").change(function() {
			//if ($(this).val() == "ECS") {
			if ($("option:selected", this).text() == "Cash") {
				$('#ch_notohide').hide();
				$('#tr_dttohide').hide();
			} else if ($("option:selected", this).text() == "Cheque") {
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
if(isset($_POST['submit'])):
echo validation_errors();
endif;
echo form_open('receipts/add_receipt_wid_donor_found',array('id'=>'donation'));
echo "<table border=1 align=center>";
echo "<tr><td>ID Name</td><td colspan=3>".form_input(array('name'=>'id_name','value'=>isset($id_name)?$id_name:set_value('id_name'),'maxlength'=>'35', 'id'=>'id_name', 'readonly'=>'true'))."</td></tr>";
echo "<tr><td>ID No</td><td colspan=3>".form_input(array('name'=>'id_no','value'=>isset($id_no)?$id_no:set_value('id_no'),'maxlength'=>'35', 'id'=>'id_no', 'readonly'=>'true'))."</td></tr>";
echo "<tr><td>ID Code</td><td colspan=3>".form_input(array('name'=>'id_code','value'=>isset($id_code)?$id_code:set_value('id_code'),'maxlength'=>'35', 'id'=>'id_code', 'readonly'=>'true'))."</td></tr>";
echo "<tr><td>Name</td><td colspan=3>".form_input(array('name'=>'name','value'=>isset($name)?$name:set_value('name'),'maxlength'=>'35', 'id'=>'name', 'readonly'=>'true'))."</td></tr>";
echo "<tr><td>Address</td><td colspan=3>".form_input(array('name'=>'address','value'=>isset($address)?$address:set_value('address'),'maxlength'=>'150', 'id'=>'address', 'readonly'=>'true'))."</td></tr>";
echo "<tr><td>City_Pin</td><td colspan=3>".form_input(array('name'=>'city_pin','value'=>isset($city_pin)?$city_pin:set_value('city_pin'),'maxlength'=>'35', 'id'=>'city_pin', 'readonly'=>'true'))."</td></tr>";
echo "<tr><td>Phone No</td><td colspan=3>".form_input(array('name'=>'phone','value'=>isset($phone)?$phone:set_value('phone'),'maxlength'=>'30', 'id'=>'phone', 'readonly'=>'true'))."</td></tr>";
echo "<tr><td>Amount</td><td colspan=3>".form_input(array('name'=>'amount', 'value'=>set_value('amount'),'maxlength'=>'13', 'id'=>'amt'))."</td></tr>";
echo "<tr><td>Purpose</td><td colspan=3>".form_dropdown('purpose',$purpose, array('Donation - Durga Pooja Celebrations'))."</td></tr>";
echo "<tr><td>Mode of Payment</td><td>".form_dropdown('mop',$mop,'ECS',array('id'=>'mop'))."</td>";
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




?>



