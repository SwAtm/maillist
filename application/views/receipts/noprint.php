<?php
echo "<table border=1 align=center>";
echo "<tr><td>Receipt</td><td>".$noprint['series']." ".$noprint['sub_series']." ".$noprint['no']." ".$noprint['date']."</td></tr>";
echo "<tr><td>Name</td><td>".$noprint['name']."</td></tr>";
echo "<tr><td>Address</td><td>".$noprint['address']."</td></tr>";
echo "<tr><td>Amount</td><td>".$noprint['amount']."</td></tr>";
echo "<tr><td colspan=2 align=center>Receipt already Deleted. Cannot print</td></tr>";
echo "</table>";
?>
