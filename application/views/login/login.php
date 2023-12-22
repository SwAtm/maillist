<html>
<head>
<title>Login</title>

<script type="text/javascript" language="JavaScript">
	document.forms['login'].elements['pwdid'].focus();
</script>

<div>
<h6>Login</h6>
Credentials Please<br><br>
<?php
echo validation_errors();
echo $err;
echo "<br>";
echo form_open('login/verify');
?>
<input type='text'  name='user' autofocus><br><br>
<input type='password'  name='pwd' ><br><br>
<input type='submit' name='submit' value='Submit'><br><br>
<?php
echo form_close();
?>
</div>
</body>
</html>

