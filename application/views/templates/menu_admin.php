<html>
<?php
Print "<table border=1 width=100% cellpadding=5 cellspacing=0>";
Print "<tr bgcolor=magenta><td width=25% valign=middle align=center>";
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
<!--<option value="mlist/check_length"> Check List
<!--<option value="opd/get_id_edit"> Edit
<option value="opd/get_id_print"> Print OPD Slip
<option value="opd/get_date_view"> View A day's Table
<option value="opd/search"> Search Patient-->
</select>
</form>
<?php
Print "</td>";
Print "<td  width=25% valign=middle align=center>";
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
<option value="mlist/labels_blore">Bangalore City
<option value="mlist/labels_bgm">Belgaum City
<option value="mlist/labels_kar_wo_blore_bgm">Karnataka w/o Blore and Belgaum Cities
<option value="mlist/labels_northkarn">North Karnataka
<option value="mlist/labels_kar_wo_northkarn">Karnataka w/o North Karnataka
<option value="mlist/labels_ind_wo_karnataka">India w/o Karnataka
<option value="mlist/labels_bgm_dist">Belgaum District
<option value="mlist/labels_kar">Karnataka
<option value="mlist/labels_ind">India

</select>
</form>
<?php
Print "</td>";
Print "<td  width=25% valign=middle align=center>";
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
<option value="idtype/midtype">IDs and Codes
</select>
</form>
<?php
Print "</td>";


Print "<td  width=25% valign=middle align=center>";
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
<option value="receipts/daily_cash_report">Daily Cash Report
<option value="receipts/monthly_report">Monthly Report	
<option value="receipts/receipt_report">Receipts' Report	
<option value="receipts/xml_report">Xml Report	
</select>
</form>


<?php
Print "</td></tr></table>";
if ($this->session->flashdata('message')):
	echo $this->session->flashdata('message');
endif;

?>
</body>
</html>
	

