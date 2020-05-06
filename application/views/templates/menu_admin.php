<?php
Print "<table border=1 width=100% cellpadding=5 cellspacing=0>";
Print "<tr bgcolor=magenta><td valign=center align=middle>";
?>

<script language="JavaScript">
function pulldown_mlist()
{
var url=document.mlist.selectname.options[document.mlist.selectname.selectedIndex].value
var site_url='<?php echo site_url();?>';
url=site_url+"/"+url
window.location.href=url
}
</script>

<form name="mlist">
<select name="selectname" size="1" onChange="pulldown_mlist()">
<option value="">LIST</option>
<option value="mlist/list_admin"> View List
<!--<option value="mlist/check_length"> Check List-->
<!--<option value="opd/get_id_edit"> Edit
<option value="opd/get_id_print"> Print OPD Slip
<option value="opd/get_date_view"> View A day's Table
<option value="opd/search"> Search Patient-->
</select>
</form>
<?php
Print "</td>";
Print "<td  valign=centre align=middle>";
?>


<script language="JavaScript">
function pulldown_labels()
{
var url=document.labels.selectname.options[document.labels.selectname.selectedIndex].value
var site_url='<?php echo site_url();?>';
url=site_url+"/"+url
window.location.href=url
}
</script>

<form name="labels">
<select name="selectname" size="1" onChange="pulldown_labels()">
<option value=""> Labels</option>
<!--<option value="mlist/labels_blore">Bangalore
<option value="mlist/labels_bgm">Belgaum Dist-->
</select>
</form>
<?php
Print "</td>";
Print "<td  valign=centre align=middle>";
?>

<script language="JavaScript">
function pulldown_tables()
{
var url=document.tables.selectname.options[document.tables.selectname.selectedIndex].value
var site_url='<?php echo site_url();?>';
url=site_url+"/"+url
window.location.href=url
}
</script>
<form name="tables">
<select name="selectname" size="1" onChange="pulldown_tables()">
<option value=""> Tables</option>
<option value="city/mcity">City
<option value="district/mdistrict">District
<option value="state/mstate">State
<option value="country/mcountry">Country
<option value="daccount/mdaccount">Donation Accounts
<option value="pmode/mpmode">Mode of Payment
<option value="receipts/rlist">Receipts
</select>
</form>
<?php
Print "</td>";


Print "<td  valign=centre align=middle>";
?>
<script language="JavaScript">
function pulldown_misc()
{
var url=document.misc.selectname.options[document.misc.selectname.selectedIndex].value
var site_url='<?php echo site_url();?>';
url=site_url+"/"+url
window.location.href=url
}
</script>
<form name="misc">
<select name="selectname" size="1" onChange="pulldown_misc()">
<option value=""> Miscellaneous</option>
<option value="misc/mlistcsv">Maillist CSV
<option value="misc/backup">Take a backup
</select>
</form>


<?php
Print "</td></tr></table>";
?>
</body>
</html>
	

