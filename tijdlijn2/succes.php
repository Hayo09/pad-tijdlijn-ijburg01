<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');

$DB = Database::getInstance();


$sql = "SELECT `id`, `url_id` FROM `tijdlijn` ORDER BY id DESC LIMIT 0, 1";
$last_id = $DB->_query($sql);

if ($last_id->num_rows > 0) {
    while($row = $last_id->fetch_assoc()) {
        $last_id2 = $row["id"]; 
    }
}

$createURL = "tijdlijn.php?tid=".$last_id2;

$sql2 = "INSERT INTO `url_tijdlijn` SET tijdlijn_id = '".$last_id2."', url = '".$createURL."'";
$DB->_query($sql2);

$sql3 = "SELECT `id` FROM `url_tijdlijn` ORDER BY id DESC LIMIT 0, 1";
$last_id3 = $DB->_query($sql3);

if ($last_id3->num_rows > 0) {
    while($row2 = $last_id3->fetch_assoc()) {
        $last_id5 = $row2["id"]; 
    }
}


$sql4 = "UPDATE `tijdlijn` SET `url_id` = ".$last_id5." WHERE `id` = '".$last_id2."'";
$DB->_query($sql4);

include ('header.php');

?>
<aside>
       <p> De tijdlijn is met succes aangemaakt! </p>
		<a href="<?php echo $createURL ?>" target="_blank">Klik hier om naar je tijdlijn te gaan.</a>

     </aside>  
      <?php include('footer.php') ?>