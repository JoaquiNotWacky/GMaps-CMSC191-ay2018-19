<?php


function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

$dbServername = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = "gmaps";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

$sql = "SELECT * from markers";
$result = $conn->query($sql);

$markers = array();

header("Content-type: text/xml");
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo '<marker ';
      echo 'id="' . $row['id'] . '" ';
      echo 'name="' . parseToXML($row['name']) . '" ';
      echo 'address="' . parseToXML($row['address']) . '" ';
      echo 'lat="' . $row['lat'] . '" ';
      echo 'lng="' . $row['lng'] . '" ';
      echo 'type="' . $row['type'] . '" ';
      echo '/>';
      $ind = $ind + 1;
    
    }

    echo '</markers>';
}
$conn->close();
