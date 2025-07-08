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
//echo $pan."<br>";
//echo $name."<br>";
//print_r($_POST);
echo form_open('mlist/mlistaddpan1');
echo validation_errors();?>
<tr><td><label for "pan">PAN</label></td>
<td><input type = "text" id = "pan" name = "pan" value = "<?php echo $pan?>" size = "35" maxlength = "10" readonly></td>
<td><input type = "text" id = "name" name = "name" value = "<?php echo $name?>" size = "50"  readonly></td>
<?php
if ($name!='Error fetching name'):
?>
<td align = "center"><input type = "submit" value = "Submit" autofocus></td>
<?php
endif;
?>
</tr>
</table>
</html>
