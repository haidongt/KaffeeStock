<?php
$con=mysqli_connect("127.0.0.1","root","password","KaffeeStock");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Create table
$sql="CREATE TABLE series(symbol CHAR(30), time_stamp BIGINT, open_price INT, close_price INT, high INT, low INT, volumn INT, duration INT)";

// Execute query
if (mysqli_query($con,$sql)) {
  echo "Table series created successfully";
} else {
  echo "Error creating table: " . mysqli_error($con);
}
?>