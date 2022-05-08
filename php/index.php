<?php
echo "<h2>Solid Determination Gang</h2><table width = 600px border = 1><tr><th>ID</th><th>Hunter Name</th><th>Premium Course</th></tr>";
$conn = pg_pconnect("host=127.0.0.1 port=5432 dbname=erupe user=samboge password=passwordofurdb");
if (!$conn) {
  echo "An error occurred.\n";
  exit;
}

$result = pg_query($conn, "SELECT id, name, course FROM characters order by id ASC");
if (!$result) {
  echo "An error occurred.\n";
  exit;
}

while ($row = pg_fetch_row($result)) {
  echo "<tr><td> $row[0] </td><td> $row[1] </td><td> $row[2] </td></tr>";
}
echo "</table>";
//echo "<br><button onclick='location.href=http://ec2-3-93-164-247.compute-1.amazonaws.com:8080' type='button'>Back</button>";

?>
