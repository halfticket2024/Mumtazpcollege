<?php
echo "<h2>Saved Admissions</h2>";
echo "<table border='1' cellpadding='10'>";
if (($handle = fopen("admissions.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle)) !== FALSE) {
    echo "<tr>";
    foreach ($data as $value) {
      echo "<td>$value</td>";
    }
    echo "</tr>";
  }
  fclose($handle);
}
echo "</table>";
?>