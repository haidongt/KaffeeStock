<?
$con=mysqli_connect("127.0.0.1","root","root","KaffeeStock");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Create table
// $sql="CREATE TABLE series(symbol CHAR(30), time_stamp BIGINT, open_price INT, close_price INT, high INT, low INT, volumn INT, duration INT)";
// 
// Execute query
// if (mysqli_query($con,$sql)) {
//   echo "Table series created successfully";
// } else {
//   echo "Error creating table: " . mysqli_error($con);
// }


$companyName="GOOG";
$url="http://chartapi.finance.yahoo.com/instrument/1.0/$companyName/chartdata;type=quote;range=5d/json";
$curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = serialize(curl_exec ($curl));
    $result=strstr($result, '{ "meta"');
    $result=str_replace(")","",$result);
    $result=substr($result, 0, -2);
    curl_close ($curl);
    $json_result=json_encode($result);    
	$json_array=json_decode($result);
    $dataArrayToInsert=$json_array->series;
    var_dump($dataArrayToInsert[0]);
    foreach ($dataArrayToInsert as $obj){
    	var_dump($obj->Timestamp);
    	$sql="INSERT INTO series (symbol,time_stamp, open_price,close_price, high,low,volumn)
			VALUES ('$companyName','".$obj->Timestamp."',' ".$obj->open."','".$obj->close."','".$obj->high."','".$obj->low."','".$obj->volume."')";
		echo $sql;	
	//Execute query
if (mysqli_query($con,$sql)) {
  echo "Table series insertting successfully";
} else {
  echo "Error inserting: " . mysqli_error($con);
}			
	}
?>