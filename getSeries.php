<?php
$symbol = htmlspecialchars($_GET["symbol"]);
$start = htmlspecialchars($_GET["start"]);
$end = htmlspecialchars($_GET["end"]);
$interval = htmlspecialchars($_GET["interval"]);

$con=mysqli_connect("127.0.0.1","root","password","KaffeeStock");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM series WHERE "
. "symbol = \"" . $symbol . "\""
. " AND time_stamp > " . $start
. " AND time_stamp < " . $end;


$result = mysqli_query($con, $sql);
$json = array();
while($row = mysqli_fetch_array($result)) {
  $json[] = array(
  $row['time_stamp'],
  $row['open_price'],
  $row['close_price'],
  $row['high'],
  $row['low'],
  $row['volumn'],
  $row['duration']
  );
}
echo json_encode($json);
mysqli_close($con);
?>