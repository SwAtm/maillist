<html>
<style>
table.table1 {
        border-collapse: separate;
        border-spacing: 0 15px;
        margin: 15px
      }
</style>
<body>

<script>
var cityindia = <?php echo json_encode($city_india);?>;
var citynonindia = <?php echo json_encode($city_non_india);?>;
</script>


<table class = "table1" border = "1">
<!--<form action = "mlistadd" method = "post">-->


<?php
echo form_open('mlist/mlistadd');
echo validation_errors()?>
<tr><fieldset>
	<legend align = "center" style = "color:blue"><b>Address and Contact</b></legend>
<td><label for "hon">Hon.</label></td>
<td><input type = "text" id = "hon" name = "hon" value = "<?php echo set_value('hon')?>" size = "35" maxlength = "4" autofocus></td>
<td><label for "name">Name</label></td>
<td><input type = "text" id = "name" name = "name" value = "<?php echo set_value('name')?>" size = "45" maxlength = "30" required ></td>
<td><label for "add1">Add 1</label></td>
<td><input type = "text" id = "add1" name = "add1" value = "<?php echo set_value('add1')?>" size = "45" maxlength = "35"></td>
</tr>
<tr>
<td><label for "add2">Add 2</label></td>
<td><input type = "text" id = "add2" name = "add2" value = "<?php echo set_value('add2')?>" size = "35" maxlength = "35"></td>
<td><label for "add3">Add 3</label></td>
<td><input type = "text" id = "add3" name = "add3" value = "<?php echo set_value('add3')?>" size = "45" maxlength = "35"></td>
<td><label for "add4">Add 4</label></td>
<td><input type = "text" id = "add4" name = "add4" value = "<?php echo set_value('add4')?>" size = "45" maxlength = "35"></td>
</tr>
<tr>
<td><label for "pin">PIN</label></td>
<td><input type = "number" id = "pin" name = "pin" value = "<?php echo set_value('pin')?>" size = "6" max = "999999"></td>
<td><label for "dist">District</label></td>
<td><input type = "text" id = "dist" name = "dist" value = "<?php echo set_value('dist')?>" size = "45" maxlength = "25" required ></td>
<td><label for "state">State</label></td>
<td><input type = "text" id = "state" name = "state" value = "<?php echo set_value('state')?>" size = "45" maxlength = "25" required ></td>
</tr>
<tr>
<td><label for "country">Country</label></td>
<td><input type = "text" id = "country" name = "country" value = "<?php echo set_value('country')?>" size = "35" maxlength = "25" required ></td>
<td><label for "city">City</label></td>
<!--<td><input type = "text" id = "city" name = "city" value = "<?//php echo set_value('city')?>" size = "25" maxlength = "25"  ></td>-->
<!--<td><div id = "mydiv"><select id = "city" name = "city"></select></div></td>-->
<td><input type = "text" id = "city" name = "city" list = "mycity" size = "45"required>	
<datalist id = "mycity"></datalist></td>	
<td><label for "phone1">Phone 1</label></td>
<td><input type = "number" id = "phone1" name = "phone1" value = "<?php echo set_value('phone1')?>" size = "45" max = "9999999999" maxlength = "10"></td>
</tr>
<tr>
<td><label for "phone2">Phone 2</label></td>
<td><input type = "text" id = "phone2" name = "phone2" value = "<?php echo set_value('phone2')?>" size = "35" maxlength = "30"></td>
<td width = "25px"><label for "email1">Email 1</label></td>
<td><input type = "text" id = "email1" name = "email1" value = "<?php echo set_value('email1')?>" size = "45" maxlength = "50"></td>
<td><label for "email2">Email 2</label></td>
<td><input type = "text" id = "email2" name = "email2" value = "<?php echo set_value('email2')?>" size = "45" maxlength = "50"></td>
</tr>
</fieldset>
</table>
<table class = "table1" border = "1" width = "98%">
<tr><fieldset>
	<legend align = "center" style = "color:blue"><b>Unique ID Details</b></legend>
<td width = "30%">Please Select One of the Two</td>
<td width = "15%"><label for "panno">PAN</label></td>
<td width = "15%"><input type = "text" id = "panno" name = "panno" value = "<?php echo set_value('panno')?>" size = "35" maxlength = "15"></td>
<td width = "15%"><?php echo form_dropdown('id_name',$idtype)?></td>
<td width = "15%"><input type = "text" id = "id_no" name = "id_no" value = "<?php echo set_value('id_no')?>" size = "25" maxlength = "15"></td>
</tr>
</fieldset>
</table>
<table class = "table1" border = "1" width = "98%">
<tr><fieldset>
	<legend align = "center" style = "color:blue"><b>Other Details</b></legend>
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
var city = document.querySelector('#city');
pin.onblur = function(){ 
fetch('https://api.postalpincode.in/pincode/'+pin.value)
  .then(response => response.json())
  .then(function(data1) {
	  if (data1[0]['Status'] == "Success"){
        dist.value = data1[0]['PostOffice'][0]['District'];
        state.value = data1[0]['PostOffice'][0]['State'];
		country.value = data1[0]['PostOffice'][0]['Country'];
		
      } else {
        dist.value = '';
        state.value = '';
        country.value = '';
        }
	city.focus();	
  });
}


city.onfocus = function(){
var listhandle = document.querySelector('#mycity');
var country1 = document.querySelector('#country');
//country1 = country.value.trim().toLowerCase()
//console.log(country1);
if ( country1.value.trim().toLowerCase() == 'india'){
var cityuse = cityindia;
}else{
var cityuse = citynonindia;
}
console.log(country.value);
/*
if (listhandle.options.length>1){
	for (i=listhandle.options.length-1; i>=0; i--){
		listhandle[i].remove();
	}
}
*/
for (i=0; i<=cityuse.length-1; i++){
var option = document.createElement('option');
//option.textContent = cityuse[i];
option.value = cityuse[i];
listhandle.appendChild(option);
//console.log(cityuse[i]);

}

}

/*
city.onblur = function(){
var listhandle = document.querySelector('#mycity');
console.log(listhandle.options.length);
if (listhandle.options.length>1){
	for (i=listhandle.options.length-1; i>0; i--){
		listhandle.remove(i);
	}
	
}
}
*/
/*
function chgtotext(){
divhandle = document.querySelector('#mydiv');
divhandle.innerHTML = "<input type = 'text' id = 'city' name = 'city' required>"
cityhandle = document.querySelector('#city');
cityhandle.focus();
}
*/




</script>
</body>
</html>
