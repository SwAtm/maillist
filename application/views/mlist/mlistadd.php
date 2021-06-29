<html>
<style>

</style>
<body>



<table border = "1">
<!--<form action = "mlistadd" method = "post">-->
<?php
echo form_open('mlist/mlistadd');
echo validation_errors()?>
<tr><fieldset>
	<legend align = "center"><b>Address and Contact</b></legend>
<td><label for "hon">Hon.</label></td>
<td><input type = "text" id = "hon" name = "hon" value = "<?php echo set_value('hon')?>" size = "4" maxlength = "4" autofocus></td>
<td><label for "name">Name</label></td>
<td><input type = "text" id = "name" name = "name" value = "<?php echo set_value('name')?>" size = "30" maxlength = "30" ></td>
<td><label for "add1">Add 1</label></td>
<td><input type = "text" id = "add1" name = "add1" value = "<?php echo set_value('add1')?>" size = "35" maxlength = "35"></td>
</tr>
<tr>
<td><label for "add2">Add 2</label></td>
<td><input type = "text" id = "add2" name = "add2" value = "<?php echo set_value('add2')?>" size = "35" maxlength = "35"></td>
<td><label for "add3">Add 3</label></td>
<td><input type = "text" id = "add3" name = "add3" value = "<?php echo set_value('add3')?>" size = "35" maxlength = "35"></td>
<td><label for "add4">Add 4</label></td>
<td><input type = "text" id = "add4" name = "add4" value = "<?php echo set_value('add4')?>" size = "35" maxlength = "35"></td>
</tr>
<tr>
<td><label for "pin">PIN</label></td>
<td><input type = "number" id = "pin" name = "pin" value = "<?php echo set_value('pin')?>" size = "6" max = "999999"></td>
<td><label for "country">Country</label></td>
<td><input type = "text" id = "country" name = "country" value = "<?php echo set_value('country')?>" size = "25" maxlength = "25" required ></td>
<td><label for "state">State</label></td>
<td><input type = "text" id = "state" name = "state" value = "<?php echo set_value('state')?>" size = "25" maxlength = "25" required ></td>
</tr>
<tr>
<td><label for "dist">District</label></td>
<td><input type = "text" id = "dist" name = "dist" value = "<?php echo set_value('dist')?>" size = "25" maxlength = "25" required ></td>
<td><label for "city">City</label></td>
<!--<td><input type = "text" id = "city" name = "city" value = "<?php echo set_value('city')?>" size = "25" maxlength = "25"  ></td>-->
<td><?php echo form_dropdown('city',$city,'BANGALORE',array('id'=>'city'))?></td>
<td><label for "phone1">Phone 1</label></td>
<td><input type = "text" id = "phone1" name = "phone1" value = "<?php echo set_value('phone1')?>" size = "30" maxlength = "30"></td>
</tr>
<tr>
<td><label for "phone2">Phone 2</label></td>
<td><input type = "text" id = "phone2" name = "phone2" value = "<?php echo set_value('phone2')?>" size = "30" maxlength = "30"></td>
<td><label for "email1">Email 1</label></td>
<td><input type = "text" id = "email1" name = "email1" value = "<?php echo set_value('email1')?>" size = "45" maxlength = "50"></td>
<td><label for "email2">Email 2</label></td>
<td><input type = "text" id = "email2" name = "email2" value = "<?php echo set_value('email2')?>" size = "45" maxlength = "50"></td>
</tr>
</fieldset>
</table>
<table border = "1" width = "100%">
<tr><fieldset>
	<legend align = "center"><b>Unique ID Details</b></legend>
<td>Please Select One of the Two</td>
<td><label for "panno">PAN</label></td>
<td><input type = "text" id = "panno" name = "panno" value = "<?php echo set_value('panno')?>" size = "15" maxlength = "15"></td>
<td><?php echo form_dropdown('id_name',$idtype)?></td>
<td><input type = "text" id = "id_no" name = "id_no" value = "<?php echo set_value('id_no')?>" size = "15" maxlength = "15"></td>
</tr>
</fieldset>
</table>
<table border = "1" width = "100%">
<tr><fieldset>
	<legend align = "center"><b>Other Details</b></legend>
	<td><label for "deleted">Deleted?</label></td>
	<td><?php echo form_dropdown('deleted',$yesno,'N')?></td>
	<td><label for "send">Send?</label></td>
	<td><?php echo form_dropdown('send',$yesno)?></td>
	<td><label for "lang">Language</label></td>
	<td><select id = "lang" name = "lang">
	<option value = "K">Kannada</option>
	<option value = "E">English</option>
	</select></td>	
		
	<td><label for "initiated">Initiated</label></td>
	<td><?php echo form_dropdown('initiated',$yesno,'N')?></td>
	<td><label for "japayajna">Japayajna</label></td>
	<td><?php echo form_dropdown('japayajna',$yesno,'N')?></td>
	</tr>
<tr><td><label for "ref">Reference</label></td>
<td colspan = "9"><input type = "text" id = "ref" name = "ref" size = "100" maxlength = "100" ></td></tr></fieldset>
<tr>
<td colspan = "10" align = "center"><input type = "submit" value = "Submit"></td>
</tr>
</form>
</table>
<?php
?>
<script>
//window.onload = function(){
var pin = document.querySelector('#pin');
var dist = document.querySelector('#dist');
var state = document.querySelector('#state');
var country = document.querySelector('#country');
pin.onchange = function(){ 
fetch('https://api.postalpincode.in/pincode/'+pin.value)
  .then(response => response.json())
  .then(function(data1) {
	  if (data1[0]['Status'] == "Success"){
        dist.value = data1[0]['PostOffice'][0]['District'];
        state.value = data1[0]['PostOffice'][0]['State'];
		country.value = data1[0]['PostOffice'][0]['Country'];
		document.querySelector('#city').focus();	
      } else {
        dist.value = 'Invalid';
        state.value = 'Invalid';
        country.value = 'Invalid';
        }
  });
}
country.onchange= function(){
//fetch ('http://localhost/maillist/index.php/mlistdata/country/'+country.value)
fetch ('/mlistdata/country/'+country.value)
.then(response=>response.json())
.then(function(data){
console.log(data);
});
}

</script>
</body>
</html>
