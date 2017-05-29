<?php

$servername = "localhost";
        $username         = 'u6488d13571_tijdlijn';
        $password       = 'PADijburg01';
        $dbname       = 'u6488d13571_tijdlijnww';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


//fetch table rows from mysql db
$sql = "select * from tijdlijnww";
$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));



$arrayName = array("events" => array());

while($row =mysqli_fetch_assoc($result))
{

/*
//Als $row null teruggeeft verander in lege string

if (empty($row["start_year"])) {
  $row["start_year"] = " ";
} 

if (empty($row["start_month"])) {
  $row["start_month"] = " ";
} 

if (empty($row["start_day"])) {
  $row["start_date"] = " ";
} 
if (empty($row["end_year"])) {
  $row["end_year"] = " ";
} 
if (empty($row["end_month"])) {
  $row["end_month"] = " ";
} 
if (empty($row["end_day"])) {
  $row["end_day"] = " ";
} 
if (empty($row["bg_url"])) {
  $row["bg_url"] = " ";
} 
if (empty($row["media_caption"])) {
  $row["media_caption"] = " ";
} 
if (empty($row["media_url"])) {
  $row["media_url"] = " ";
} 
if (empty($row["text_headline"])) {
  $row["text_headline"] = " ";
} 
if (empty($row["text_text"])) {
  $row["text_text"] = " ";
} 
*/

  $data = array(

    'start_date'    =>    array(      
      'year'    =>    $row["start_year"],
      'month'    =>   $row["start_month"] ,
      'day'    =>    $row["start_day"]
      ),
    'end_date'    =>    array(      
      'year'    =>    $row["end_year"],
      'month'    =>    $row["end_month"],
      'day'    =>    $row["end_day"]
      ),

    'background'    =>    array( 
      'opacity'    =>    "50",
      'url'    =>       $row["bg_url"]
      ),

    'media'    =>    array( 
      'caption'    =>    " " //$row["media_caption"]
      ,
      'url'    =>     " "  //$row["media_url"]
      ),

    'text'       =>    array(
      'headline'    =>    $row["text_headline"],
      'text'    =>    $row["text_text"]
      )
    );
  array_push($arrayName["events"], $data);

}





//echo json_encode($arrayName);

    //write to json file
    $fp = fopen('empdata.json', 'w');
    fwrite($fp, json_encode($arrayName));
    fclose($fp);




?>