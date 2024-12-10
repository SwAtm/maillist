<?php
echo validation_errors();
echo form_open('receipts/get_id_no', array('id'=>'getadhar'));
$this->table->set_template(array('table_open'=>'<table border=1 align=center width=50%>'));
$this->table->set_heading(array('data'=>'Enter PAN/Aadhaar Number', 'align'=>'center'));
//echo "<td><input type=text name = id_no value = set_value(id_no)></td></tr>";
$this->table->add_row(form_input(array('name'=>'id_no', 'id'=>'id_no', 'value'=>set_value('id_no'))));
$this->table->add_row(form_submit('continue','Submit'));
echo $this->table->generate();
echo form_close();
?>
<script type="text/javascript" language="JavaScript">
	document.forms['getadhar'].elements['id_no'].focus();
	</script>
<?php

if ($this->session->flashdata('message')):
	Print "<table><tr></tr><tr></tr><tr><td align=center>";
	echo $this->session->flashdata('message');
print "</td></tr></table>";
endif;
?>
