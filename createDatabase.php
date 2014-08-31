<?php
$con=mysqli_connect("127.0.0.1","root","password");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
// Create database
$sql="CREATE DATABASE KaffeeStock";
if (mysqli_query($con,$sql)) {
  echo "Database my_db created successfully";
} else {
  echo "Error creating database: " . mysqli_error($con);
}
mysqli_close($con);
?>
