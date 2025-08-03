<html>
<style>
table.table1 {
        border-collapse: separate;
        border-spacing: 0 15px;
        margin: 15px;
        align: center
      }
</style>
<body>


<table class = "table1" border = "1" align="center">
<?php
echo form_open('mlist/getid/'.$this->session->id);
echo validation_errors();?>
<tr><td><label for "idno">PAN or Adhaar</label></td>
<td><input type = "text" id = "idno" name = "idno" value = "<?php echo set_value('idno')?>" size = "35" maxlength = "12" autofocus></td>
<td align = "center"><input type = "submit" value = "Submit"></td>
</tr>
</table>
<?php
if ($this->session->flashdata('message')):
	echo $this->session->flashdata('message');
endif;
?>
</html>
