<html>
<?php
Print "<table border=1 width=100% cellpadding=5 cellspacing=0>";
Print "<tr bgcolor=magenta>";
Print "<td  valign=centre align=middle>";
?>
<button onclick="window.location='<?php echo site_url();?>/mlist/list_guest'">Search Maillist and pass receipt</button>
<?php
Print "</td>";
Print "<td  valign=centre align=middle>";
?>
<button onclick="window.location='<?php echo site_url();?>/receipts/get_id_no'">Add receipt With ID</button>
<?php
Print "</td>";
Print "<td  valign=centre align=middle>";
?>
<button onclick="window.location='<?php echo site_url();?>/receipts/add_receipt_woid'">Add receipt W/O ID</button>
<?php
print "</td>";
Print "<td  valign=centre align=middle>";
?>
<button onclick="window.location='<?php echo site_url();?>/receipts/rlist'">List receipts</button>
<?php
print "</td>";
Print "<td  valign=centre align=middle>";
?>
<button onclick="window.location='<?php echo site_url();?>/receipts/monthly_report'">Report</button>
<?php
Print "</td></tr></table>";
?>
</body>
</html>

