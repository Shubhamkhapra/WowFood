<?php
$all_lines = highlight_file('http://localhost/food-order/admin/manage-admin.php');
foreach ($all_lines as $line_num => $line)
 {
 	echo "Line No.-{$line_num}: " . htmlspecialchars($line) . "\n";
 }
?>