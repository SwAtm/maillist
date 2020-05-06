<!--
<!doctype html>
<!called by login/index->
<html>
<head>
<title>Login</title>

<script type="text/javascript" language="JavaScript">
	document.forms['login'].elements['pwdid'].focus();
</script>
-->


<!--/head>

<!--body>-->

<div>
<h6>Admin Login</h6>
Password Please<br><br>
<?php
echo validation_errors();
echo $err;
echo form_open('login/verify');
//<!<form action="login/verify" method="POST">
?>
<input type='password'  name='pwd' autofocus><br><br>
<input type='submit' name='submit' value='Submit'><br><br>
<?php
echo form_close();
echo "Not Admin? Log-in as <a href=".site_url('login/home').">Guest</a>";
?>
<h1 style="color:blue">Login page</h1>
</div>
</body>
</html>

