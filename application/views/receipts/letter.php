<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="<?php echo base_url('application/jquery-ui/external/jquery/jquery.js')?>"></script>
<script src="<?php echo base_url('application/jquery-ui/jquery-ui.js')?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('application/jquery-ui/jquery-ui.css')?>"/>
<script type="text/javascript">
$(document).ready(function() {
        $('input[id$=dt]').datepicker({
            dateFormat:"yy-mm-dd",
            onClose: function(dateText, inst) {
                $("#name").focus();
            }
        });
        
        document.forms['letter'].elements['dt'].focus();

		
});
</script>

</head>





<?php
$ntw = new \NTWIndia\NTWIndia();
$amt = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $det['amount']);
echo form_open('receipts/letter_print',array('id'=>'letter'),$det);
echo "<table border=1 align=center>";
echo "<tr><td>".form_input(array('id'=>'dt','name'=>'date','value'=>''))."</td></tr>";

//adding 'Dear' to name, this should not change value of name.
echo "<tr><td>".form_input(array('id'=>'name','name'=>'name1','value'=>"Dear ".ucwords(strtolower($det['name'])),'size'=>'50','maxlength'=>'50'))."</td></tr>";

echo "<tr><td>".form_input(array('name'=>'greetings','value'=>"Namaskars.",'size'=>'50','maxlength'=>'50'))."</td></tr>";

//echo "<tr><td>".form_textarea(array('name'=>'message','value'=>"Please find enclosed receipt for your kind donation of Rs. ".$amt." (Rs. ".$ntw->numToWord($det['amount'])." Only)"." through ".$det['mode_payment'].($det['ch_no']==''?'':" No: ".$det['ch_no']).($det['tr_date']==''?'':" Dt: ".$det['tr_date'])." towards ".$det['purpose'].".",'size'=>'200','maxlength'=>'200','rows'=>'3','cols'=>'60'))."</td></tr>";

echo "<tr><td>".form_textarea(array('name'=>'message','value'=>"Please find enclosed receipt for your kind donation of Rs. ".$amt." (Rs. ".$ntw->numToWord($det['amount'])." Only)"." through ".(strstr($det['mode_payment'], 'Bank')?"Bank Transfer":$det['mode_payment']).($det['ch_no']==''?'':" No: ".$det['ch_no']).($det['tr_date']==''?'':" Dt: ".$det['tr_date'])." towards ".$det['purpose'].".",'size'=>'200','maxlength'=>'200','rows'=>'3','cols'=>'60'))."</td></tr>";


echo "<tr><td>".form_textarea(array('name'=>'message1','value'=>"Many thanks for your kind support. The activities of the Ashrama are going on well.",'size'=>'250','maxlength'=>'250','rows'=>'3','cols'=>'60'))."</td></tr>";

echo "<tr><td>".form_textarea(array('name'=>'message2','value'=>"May Bhagawan Sri Ramakrishna, Sri Sharada Devi and Swami Vivekananda shower their choicest blessings on you and your family is our earnest prayer.",'maxlength'=>'200', 'size'=>'200', 'rows'=>'5', 'cols'=>'60'))."</td></tr>";

echo "<tr><td>".form_input(array('name'=>'closing1','value'=>"Yours in the Lord,",'size'=>'50','maxlength'=>'50'))."</td></tr>";


echo "<tr><td colspan=2 align=center>".form_submit('submit','Generate PDF')."</td></tr>";
echo "</table>";
echo form_close();
?>
