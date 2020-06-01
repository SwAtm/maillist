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
                $("#sub").focus();
            }
        });
            document.forms['gtdt'].elements['dt'].focus();
        
});
</script>

</head>
<?php
echo validation_errors();
echo form_open('receipts/daily_cash_report',array('id'=>'gtdt'));
echo "<table border=1 align=center>";
echo "<tr><td align=center>Daily Cash Report</td></tr>";
echo "<tr><td align=center>Select Date</td></tr>";
echo "<tr><td>".form_input(array('id'=>'dt','name'=>'date'))."</td></tr>";
echo "<tr><td align=center>".form_submit(array('id'=>'sub','name'=>'submit','value'=>'Submit'))."</td></tr>";
echo "</table>";
echo form_close();
?>


