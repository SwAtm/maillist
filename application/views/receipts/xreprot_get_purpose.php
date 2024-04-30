<?php
echo "<table border=1 width=100%>";
echo "<tr><td colspan=2>Pl enter account name against each purpose/mop</td></tr>";
echo "<tr><td>Purpose/MOP</td><td>Account</td></tr>";
echo "<form action=xml_report method=Post>";
$i=0;
foreach ($x_purpose as $pps):

echo "<tr><td><input type=text name=puracc[$i][purpose] value='$pps[purpose]' max_length=50 readonly></td><td><input type=text name=puracc[$i][account] value=''></td></tr>";
$i++;
endforeach;
$i=0;
foreach ($x_mop as $mops):
echo "<tr><td><input type=text name=mopacc[$i][mop] value='$mops[mode_payment]'></td><td><input type=text name=mopacc[$i][account] value=''></td></tr>";
$i++;
endforeach;
echo "<tr><td colspan=2><input type=submit name=generate value='Generate Xml'></td></tr>";
echo "<input type=hidden name=stdt value=$stdt>";
echo "<input type=hidden name=endt value=$endt>";
echo "</table>";
echo "</form>";
?>
