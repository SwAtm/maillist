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
<tr><td><label for "pan">PAN</label></td>
<td><input type = "text" id = "pan" name = "pan" value = "<?php echo set_value('pan')?>" size = "35" maxlength = "10" autofocus></td>
<td align = "center"><input type = "submit" value = "Submit"></td>
</tr>
</table>
</html>
