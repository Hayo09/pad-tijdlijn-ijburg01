<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');

$DB = Database::getInstance();

$titel = '';
$element_id = '';
$sql3 = "SELECT `id` , `aantal_elementen` FROM `tijdlijn` ORDER BY id DESC LIMIT 0, 1";
$last_id = $DB->_query($sql3);

if ($last_id->num_rows > 0) {
    while($row = $last_id->fetch_assoc()) {
        $last_id2 = $row["id"]; 
        $aantal_elementen3 = $row["aantal_elementen"];
    }
}

$sql4 = "SELECT * FROM `elementen` WHERE `tijdlijn_id` = ".$last_id2."";

$sql5 = "SELECT `id` FROM `elementen` WHERE `tijdlijn_id` = ".$last_id2." ORDER BY id ASC LIMIT 0,1";

$sql6 = "SELECT `id` FROM `elementen` WHERE `tijdlijn_id` = ".$last_id2." ORDER BY id DESC LIMIT 0,1";

$sql7 = "SELECT `id` FROM `elementen` WHERE `tijdlijn_id` = ".$last_id2." ORDER BY id ASC";
            
$last_id3 = $DB->_query($sql4);

$min_id = $DB->_query($sql5);
$min_id = mysqli_fetch_assoc($min_id);
$min_id = $min_id['id'];

$max_id = $DB->_query($sql6);
$max_id = mysqli_fetch_assoc($max_id);
$max_id = $max_id['id'];

$dingid[] = $DB->_query($sql7);

echo $min_id."</br>";
echo $max_id."</br>";
$current_id = $min_id;

for ($x = $min_id; $x < $max_id; $x++){
        for ($i = 0; $i < count($_POST['titel']); $i++){
            echo $_POST['titel'][$i];
            echo "<br>".$x;
         }
    } ?>