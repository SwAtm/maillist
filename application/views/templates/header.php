<!doctype html>
<html>
<head>

<style type="text/css">
input:focus, select:focus, checkbox:focus {
      //background: #fc9fff;   
      outline:3px solid magenta;
}
</style>
<style>
div {
	 margin: auto;
	 text-align: center;
	}
</style>
<script type = "text/javascript" >
   function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};

    
</script>
</head>
<body>
<?php
echo "<table width=100%  bgcolor=lightblue cellpadding=5>";
echo "<tr><td align=middle><b>Ramakrishna Mission Ashrama, Belgaum</b></td></tr>";
echo "<tr><td align = middle id = time>";
echo "</td></tr>";
//echo "<tr><td align=middle>".date('l jS \of F Y h:i:s A')."</td></tr>";
echo "<tr><td>";
if (null!==$this->session->logged AND $this->session->logged=='admin'):
		echo "Logged in as ".$this->session->logged."<a href=".site_url('login/logout')."> Log Out</a>";
else:
//echo "Logged in as Guest. Log in as <a href=".site_url('login/index')."> Admin</a>";
//echo '';
echo "Logged in as Guest<a href=".site_url('login/logout')."> Log Out</a>";
endif;
echo "</td></tr></table>";

?>
<script type="text/javascript">
function Timer() {
   var dt=new Date();
   document.getElementById('time').innerHTML=dt.getDate()+ '-' + (dt.toLocaleString('default', {month: 'long'}))+ '-'+dt.getFullYear()+'||'+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
   setTimeout("Timer()",1000);
}
Timer();
</script>
</body>
</html>


